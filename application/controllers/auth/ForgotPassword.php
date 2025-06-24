<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ForgotPassword extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['form_validation', 'email', 'session']);
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
        $this->load->view('auth/forgot_password');
    }

    public function send_otp()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/forgot_password');
            return;
        }

        $email = $this->input->post('email');
        $user = $this->User_model->getUserByEmail($email);

        if (!$user) {
            $this->session->set_flashdata('error', 'Email tidak ditemukan dalam sistem.');
            redirect('auth/forgotpassword');
            return;
        }

        // Generate OTP
        $otp = sprintf("%06d", mt_rand(0, 999999));
        $expires = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        // Save OTP to database
        $this->User_model->saveResetToken($user['id'], $otp, $expires);

        // Send OTP email
        $this->email->from('noreply@troops.com', 'Troops System');
        $this->email->to($email);
        $this->email->subject('Reset Password OTP');
        
        $message = "
            <h2>Reset Password</h2>
            <p>Berikut adalah kode OTP untuk reset password Anda:</p>
            <h1 style='font-size: 36px; letter-spacing: 5px; background: #f4f4f4; padding: 10px; text-align: center;'>{$otp}</h1>
            <p>Kode ini akan kadaluarsa dalam 15 menit.</p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        ";
        
        $this->email->message($message);
        $this->email->set_mailtype('html');

        if ($this->email->send()) {
            // Store email in session for verification
            $this->session->set_userdata('reset_email', $email);
            redirect('auth/forgotpassword/verify');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim kode OTP.');
            redirect('auth/forgotpassword');
        }
    }

    public function verify()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth/forgotpassword');
        }
        
        $this->load->view('auth/verify_reset_password');
    }

    public function verify_otp()
    {
        $this->form_validation->set_rules('otp', 'OTP', 'required|exact_length[6]|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/verify_reset_password');
            return;
        }

        $email = $this->session->userdata('reset_email');
        $otp = $this->input->post('otp');
        
        $user = $this->User_model->getUserByEmail($email);
        
        if (!$user || $user['reset_token'] !== $otp || strtotime($user['reset_expires']) < time()) {
            $this->session->set_flashdata('error', 'Kode OTP tidak valid atau sudah kadaluarsa.');
            redirect('auth/forgotpassword/verify');
            return;
        }

        // OTP valid, allow password reset
        $this->session->set_userdata('can_reset_password', true);
        redirect('auth/forgotpassword/reset');
    }

    public function reset()
    {
        if (!$this->session->userdata('can_reset_password')) {
            redirect('auth/forgotpassword');
        }

        $this->load->view('auth/reset_password');
    }

    public function update_password()
    {
        if (!$this->session->userdata('can_reset_password')) {
            redirect('auth/forgotpassword');
            return;
        }

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/reset_password');
            return;
        }

        $password = $this->input->post('password');
        $email = $this->session->userdata('reset_email');

        // Update password in database
        $this->load->model('auth/User_model');
        $user = $this->User_model->getUserByEmail($email);
        
        if ($this->User_model->updatePassword($user['id'], password_hash($password, PASSWORD_DEFAULT))) {
            // Clear reset token and session data
            $this->User_model->clearResetToken($user['id']);
            $this->session->unset_userdata('reset_email');
            $this->session->unset_userdata('reset_token');
            
            // Load success view with 3 second redirect
            $data['message'] = 'Password Anda telah berhasil diperbarui.';
            $data['redirect_url'] = site_url('auth/login');
            $this->load->view('auth/verification_success', $data);
        } else {
            $this->session->set_flashdata('error', 'Gagal mengubah password.');
            $this->load->view('auth/reset_password');
        }
    }

    public function resend_otp()
    {
        $email = $this->session->userdata('reset_email');
        
        if (!$email) {
            redirect('auth/forgotpassword');
            return;
        }

        $user = $this->User_model->getUserByEmail($email);

        // Generate new OTP
        $otp = sprintf("%06d", mt_rand(0, 999999));
        $expires = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        // Save new OTP
        $this->User_model->saveResetToken($user['id'], $otp, $expires);

        // Send email
        $this->email->from('noreply@troops.com', 'Troops System');
        $this->email->to($email);
        $this->email->subject('Reset Password OTP');
        
        $message = "
            <h2>Reset Password</h2>
            <p>Berikut adalah kode OTP baru untuk reset password Anda:</p>
            <h1 style='font-size: 36px; letter-spacing: 5px; background: #f4f4f4; padding: 10px; text-align: center;'>{$otp}</h1>
            <p>Kode ini akan kadaluarsa dalam 15 menit.</p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        ";
        
        $this->email->message($message);
        $this->email->set_mailtype('html');

        if ($this->email->send()) {
            $this->session->set_flashdata('success', 'Kode OTP baru telah dikirim.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim kode OTP baru.');
        }

        redirect('auth/forgotpassword/verify');
    }
} 