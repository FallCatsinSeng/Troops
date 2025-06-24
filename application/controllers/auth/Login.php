<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->library(['form_validation', 'encryption', 'email']);
        $this->load->model('auth/Login_model', 'login');
    }

    public function index()
    {
        $params['flash_message'] = $this->session->flashdata('login_flash');
        $params['old_username'] = $this->session->flashdata('old_username');
        
        $params['redirection'] = $this->input->get('redir_to');
        $this->session->set_userdata('redirection', $params['redirection']);

        $this->load->view('auth/login', $params);
    }

    public function do_login()
    {
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[16]', [
            'min_length' => 'Username minimal 4 karakter',
            'max_length' => 'Username maksimal 16 karakter',
            'required' => 'Silahkan masukkan Username untuk login'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Silahkan masukkan Password akun'
        ]);

        if ($this->form_validation->run() === FALSE)
        {
            $this->index();
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('remember_me');

            $this->login->login($username, $password);

            if ($this->login->is_user_exist())
            {
                $user_password = $this->login->get_password();

                if (password_verify($password, $user_password))
                {
                    $login_data = [
                        'is_login' => TRUE,
                        'user_id' => $this->login->logged_user_id(),
                        'login_at' => time(),
                        'remember_me' => ($remember_me == 1) ? TRUE : FALSE
                    ];

                    $login_data = json_encode($login_data);
                    $login_session = $this->encryption->encrypt($login_data);

                    $redirection = $this->session->userdata('redirection');
                    if ($redirection)
                    {
                        $redir_to = base64_decode($redirection);
                        $this->session->unset_userdata('redirection');
                    }
                    else
                    {
                        $role = $this->login->get_role();
                        $redir_to = ($role == 'admin') ? 'admin' : 'customer';
                    }
                    
                    if ($remember_me == 1)
                    {
                        $this->input->set_cookie('__ACTIVE_SESSION_DATA', $login_session, 172800); //48 jam
                    }
                    else
                    {
                        $this->session->set_userdata('__ACTIVE_SESSION_DATA', $login_session);
                    }

                    redirect($redir_to);
                }
                else
                {
                    $this->session->set_flashdata('login_flash', 'Password salah!');
                    $this->session->set_flashdata('old_username', $username);

                    redirect('/auth/login');
                }
            }
            else
            {
                $this->session->set_flashdata('login_flash', 'User dengan username <b>'. $username .'</b> tidak terdaftar');
                redirect('/auth/login');
            }
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
            <p>Jika Anda tidak merasa login di sistem kami, abaikan email ini.</p>
        ";
        
        $this->email->message($message);
        return $this->email->send();
    }

    public function verify_otp()
    {
        if (!$this->session->userdata('login_verification')) {
            redirect('auth/login');
            return;
        }

        if ($this->input->post('otp')) {
            $verify_data = $this->session->userdata('login_verification');
            $input_otp = $this->input->post('otp');
            
            // Check if OTP is expired (15 minutes)
            if (time() - $verify_data['otp_created'] > 900) {
                $this->session->set_flashdata('login_flash', 'Kode OTP sudah kadaluarsa. Silakan login kembali.');
                $this->session->unset_userdata('login_verification');
                redirect('auth/login');
                return;
            }
            
            if (strcmp($input_otp, $verify_data['otp']) === 0) {
                // OTP valid, verify account and proceed with login
                $this->login->verify_user($verify_data['user_id']);
                
                $login_data = [
                    'is_login' => TRUE,
                    'user_id' => $verify_data['user_id'],
                    'login_at' => time(),
                    'remember_me' => $verify_data['remember_me']
                ];

                $login_data = json_encode($login_data);
                $login_session = $this->encryption->encrypt($login_data);

                if ($verify_data['remember_me'] == 1) {
                    $this->input->set_cookie('__ACTIVE_SESSION_DATA', $login_session, 172800);
                } else {
                    $this->session->set_userdata('__ACTIVE_SESSION_DATA', $login_session);
                }

                $this->session->unset_userdata('login_verification');
                
                // Set username first before getting role
                $this->login->login($verify_data['username']);
                $role = $this->login->get_role();
                $redir_to = ($role == 'admin') ? 'admin' : 'customer/customer';

                // Show success page before redirecting
                $data['message'] = 'Login berhasil! Anda akan dialihkan ke halaman utama.';
                $data['redirect_url'] = site_url($redir_to);
                $this->load->view('auth/verification_success', $data);
                return;
            } else {
                $this->session->set_flashdata('otp_error', 'Kode OTP tidak valid.');
                $this->load->view('auth/verify_otp_login');
            }
        } else {
            $this->load->view('auth/verify_otp_login');
        }
    }

    public function resend_otp()
    {
        if (!$this->session->userdata('login_verification')) {
            redirect('auth/login');
            return;
        }

        $verify_data = $this->session->userdata('login_verification');
        
        // Generate new OTP
        $new_otp = sprintf("%06d", mt_rand(1, 999999));
        
        // Update session data with new OTP
        $verify_data['otp'] = $new_otp;
        $verify_data['otp_created'] = time();
        $this->session->set_userdata('login_verification', $verify_data);
        
        // Send new OTP
        if ($this->send_otp_email($verify_data['email'], $new_otp)) {
            $this->session->set_flashdata('otp_message', 'Kode OTP baru telah dikirim ke email Anda.');
        } else {
            $this->session->set_flashdata('otp_error', 'Gagal mengirim kode OTP baru.');
        }
        
        redirect('auth/login/verify_otp');
    }
}