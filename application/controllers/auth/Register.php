<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->library(['form_validation', 'encryption', 'email']);
        $this->load->model('auth/Register_model', 'register');
    }

    public function index()
    {
        $this->load->view('auth/register');
    }

    public function verify()
    {
        $this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[16]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        $this->form_validation->set_rules('name', 'Nama lengkap', 'required');
        $this->form_validation->set_rules('phone_number', 'No. HP', 'required|min_length[9]|max_length[16]|is_unique[customers.phone_number]');
        $this->form_validation->set_rules('email', 'Email', 'required|min_length[10]|valid_email');
        $this->form_validation->set_rules('address', 'Alamat', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->index();
        }
        else
        {
            $email = $this->input->post('email');
            
            // Generate OTP
            $otp = sprintf("%06d", mt_rand(1, 999999));
            
            // Save registration data and OTP to session
            $this->session->set_userdata('temp_registration', array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'name' => $this->input->post('name'),
                'phone_number' => $this->input->post('phone_number'),
                'email' => $email,
                'address' => $this->input->post('address'),
                'otp' => $otp,
                'otp_created' => time()
            ));
            
            // Send OTP via email
            $this->send_otp_email($email, $otp);
            
            redirect('auth/register/verify_otp');
        }
    }

    private function send_otp_email($email, $otp)
    {
        $this->email->from('yugu780@gmail.com', 'Troops System');
        $this->email->to($email);
        $this->email->subject('Kode OTP Verifikasi Email');
        
        $message = "
            <h2>Verifikasi Email Anda</h2>
            <p>Berikut adalah kode OTP untuk verifikasi email Anda:</p>
            <h1 style='font-size: 40px; letter-spacing: 5px;'>{$otp}</h1>
            <p>Kode OTP ini akan kadaluarsa dalam 15 menit.</p>
            <p>Jika Anda tidak merasa mendaftar di sistem kami, abaikan email ini.</p>
        ";
        
        $this->email->message($message);
        return $this->email->send();
    }

    public function verify_otp()
    {
        if (!$this->session->userdata('temp_registration')) {
            redirect('auth/register');
            return;
        }

        if ($this->input->post('otp')) {
            $temp_data = $this->session->userdata('temp_registration');
            $input_otp = $this->input->post('otp');
            
            // Check if OTP is expired (15 minutes)
            if (time() - $temp_data['otp_created'] > 900) {
                $this->session->set_flashdata('otp_error', 'Kode OTP sudah kadaluarsa. Silakan daftar ulang.');
                $this->session->unset_userdata('temp_registration');
                redirect('auth/register');
                return;
            }
            
            if (strcmp($input_otp, $temp_data['otp']) === 0) {
                // OTP valid, proceed with registration
                $user_data = array(
                    'email' => $temp_data['email'],
                    'username' => $temp_data['username'],
                    'password' => password_hash($temp_data['password'], PASSWORD_BCRYPT),
                'role' => 'customer',
                    'register_date' => date('Y-m-d H:i:s'),
                    'email_verified_at' => date('Y-m-d H:i:s')
            );
            
                $user_id = $this->register->register_user($user_data);

            $customer_data = array(
                    'user_id' => $user_id,
                    'name' => $temp_data['name'],
                    'phone_number' => $temp_data['phone_number'],
                    'address' => $temp_data['address']
            );

            $this->register->register_customer($customer_data);

                // Clear temporary data
                $this->session->unset_userdata('temp_registration');
                
                // Set login session data
                $login_data = [
                    'is_login' => TRUE,
                    'user_id' => $user_id,
                    'login_at' => time(),
                    'remember_me' => FALSE
                ];

                $login_data = json_encode($login_data);
                $login_session = $this->encryption->encrypt($login_data);
                $this->session->set_userdata('__ACTIVE_SESSION_DATA', $login_session);

                // Show success page before redirecting to customer dashboard
                $data['message'] = 'Pendaftaran akun berhasil! Anda akan dialihkan ke halaman utama.';
                $data['redirect_url'] = site_url('customer/customer');
                $this->load->view('auth/verification_success', $data);
                return;
            } else {
                $this->session->set_flashdata('otp_error', 'Kode OTP tidak valid.');
                $this->load->view('auth/verify_otp_register');
            }
        } else {
            $this->load->view('auth/verify_otp_register');
        }
    }

    public function resend_otp()
    {
        if (!$this->session->userdata('temp_registration')) {
            redirect('auth/register');
            return;
        }

        $temp_data = $this->session->userdata('temp_registration');
        
        // Generate new OTP
        $new_otp = sprintf("%06d", mt_rand(1, 999999));
        
        // Update session data with new OTP
        $temp_data['otp'] = $new_otp;
        $temp_data['otp_created'] = time();
        $this->session->set_userdata('temp_registration', $temp_data);
        
        // Send new OTP
        if ($this->send_otp_email($temp_data['email'], $new_otp)) {
            $this->session->set_flashdata('otp_message', 'Kode OTP baru telah dikirim ke email Anda.');
        } else {
            $this->session->set_flashdata('otp_error', 'Gagal mengirim kode OTP baru.');
        }

        redirect('auth/register/verify_otp');
    }
}