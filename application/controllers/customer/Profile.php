<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
    }

    public function index()
    {
        // Get user data from encrypted session
        $encrypted_session = $this->session->userdata('__ACTIVE_SESSION_DATA');
        if (!$encrypted_session) {
            redirect('auth/login');
        }

        $decrypted_data = $this->encryption->decrypt($encrypted_session);
        $session_data = json_decode($decrypted_data, true);
        
        if (!$session_data || !isset($session_data['user_id'])) {
            redirect('auth/login');
        }

        $user_id = $session_data['user_id'];
        
        // Get user data from both tables
        $user = $this->db->get_where('users', ['id' => $user_id])->row();
        $customer = $this->db->get_where('customers', ['user_id' => $user_id])->row();
        
        // If customer record doesn't exist, create it
        if (!$customer) {
            $this->db->insert('customers', [
                'user_id' => $user_id,
                'name' => $user->name
            ]);
            $customer = $this->db->get_where('customers', ['user_id' => $user_id])->row();
        }

        $data['user'] = $user;
        $data['customer'] = $customer;

        if ($this->input->post()) {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name', 'Nama', 'required');
            $this->form_validation->set_rules('phone_number', 'No. HP', 'required');
            $this->form_validation->set_rules('address', 'Alamat', 'required');
            $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|numeric|exact_length[5]');
            
            if ($this->form_validation->run()) {
                // Update users table
                $this->db->where('id', $user_id);
                $this->db->update('users', [
                    'name' => $this->input->post('name')
                ]);
                
                // Update customers table
                $this->db->where('user_id', $user_id);
                $this->db->update('customers', [
                    'name' => $this->input->post('name'),
                    'phone_number' => $this->input->post('phone_number'),
                    'address' => $this->input->post('address'),
                    'kode_pos' => $this->input->post('kode_pos')
                ]);
                
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui');
                redirect('customer/profile');
            }
        }

        get_header('Profil Saya');
        get_template_part('customer/profile', $data);
        get_footer();
    }
} 