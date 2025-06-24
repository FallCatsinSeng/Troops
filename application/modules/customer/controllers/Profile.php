<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('customer');

        $this->load->model(array(
            'profile_model' => 'profile'
        ));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = $this->profile->get_profile();

        $params['title'] = $data->name;
        $user['user'] = $data;
        $user['flash'] = $this->session->flashdata('profile');

        $this->load->view('header', $params);
        $this->load->view('profile', $user);
        $this->load->view('footer');
    }

    public function edit_name()
    {
        $this->form_validation->set_rules('name', 'Nama lengkap', 'required|max_length[32]|min_length[4]');
        $this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
        $this->form_validation->set_rules('desa', 'Desa', 'required');
        $this->form_validation->set_rules('address', 'Alamat Lengkap', 'required');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|numeric|max_length[5]');

        if ($this->form_validation->run() === FALSE)
        {
            $this->index();
        }
        else
        {
            $data = new stdClass();

            $data->name = $this->input->post('name');
            $data->phone_number = $this->input->post('phone_number');
            $data->provinsi = $this->input->post('provinsi');
            $data->kabupaten = $this->input->post('kabupaten');
            $data->kecamatan = $this->input->post('kecamatan');
            $data->desa = $this->input->post('desa');
            $data->address = $this->input->post('address');
            $data->kode_pos = $this->input->post('kode_pos');

            $profile = $this->profile->get_profile();
            $old_profile = $profile->profile_picture;

            if (isset($_FILES) && @$_FILES['file']['error'] == '0') {
                $config['upload_path'] = './assets/uploads/users/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                $config['max_size'] = 2048;
                
                $this->load->library('upload', $config);

                // Debug information
                log_message('debug', 'Upload Path: ' . $config['upload_path']);
                log_message('debug', 'File Data: ' . print_r($_FILES, true));

                if ($this->upload->do_upload('file'))
                {
                    if ($old_profile)
                    {
                        if(file_exists('./assets/uploads/users/'. $old_profile)) {
                            unlink('./assets/uploads/users/'. $old_profile);
                        }
                    }

                    $file_data = $this->upload->data();
                    $data->profile_picture = $file_data['file_name'];
                    
                    // Debug successful upload
                    log_message('debug', 'File uploaded successfully: ' . $file_data['file_name']);
                }
                else
                {
                    $errors = $this->upload->display_errors();
                    log_message('error', 'Upload Error: ' . $errors);
                    
                    $errors .= '<p>';
                    $errors .= anchor('profile', '&laquo; Kembali');
                    $errors .= '</p>';

                    show_error($errors);
                }
            }

            // Debug data before update
            log_message('debug', 'Data to be updated: ' . print_r($data, true));
            
            $flash_message = ($this->profile->update($data)) ? 'Profil berhasil diperbarui!' : 'Terjadi kesalahan';
            
            $this->session->set_flashdata('profile', $flash_message);
            redirect('customer/profile');
        }
    }

    public function edit_account()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|max_length[16]|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'min_length[4]');

        if ($this->form_validation->run() === FALSE)
        {
            $this->index();
        }
        else
        {
            $data = new stdClass();
            $profile = $this->profile->get_profile();

            $get_password = $this->input->post('password');

            if ( empty($get_password)) {
                $password = $profile->password;
            }
            else {
                $password = password_hash($get_password, PASSWORD_BCRYPT);
            }

            $data->username = $this->input->post('username');
            $data->password = $password;

            $flash_message = ($this->profile->update_account($data)) ? 'Akun berhasil diperbarui' : 'Terjadi kesalahan';
            
            $this->session->set_flashdata('profile', $flash_message);
            $this->session->set_flashdata('show_tab', 'akun');

            redirect('customer/profile');
        }
    }

    public function edit_email()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[32]|min_length[10]');

        if ($this->form_validation->run() === FALSE)
        {
            $this->index();
        }
        else
        {
            $data = new stdClass();

            $data->email = $this->input->post('email');
            
            $flash_message = ($this->profile->update_account($data)) ? 'Email berhasil diperbarui' : 'Terjadi kesalahan';
            
            $this->session->set_flashdata('profile', $flash_message);
            $this->session->set_flashdata('show_tab', 'email');

            redirect('customer/profile');
        }
    }

    public function check_address()
    {
        if (!is_login()) {
            $response = array('has_address' => false);
            echo json_encode($response);
            return;
        }

        $this->load->model('Profile_model');
        $user_id = get_current_user_id();
        $profile = $this->Profile_model->get_profile($user_id);
        
        // Check if all address fields are filled
        $has_address = !empty($profile->provinsi) && 
                      !empty($profile->kabupaten) && 
                      !empty($profile->kecamatan) && 
                      !empty($profile->desa) && 
                      !empty($profile->address) && 
                      !empty($profile->kode_pos);
        
        $response = array('has_address' => $has_address);
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}