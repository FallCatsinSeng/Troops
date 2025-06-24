<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['cookie', 'url']);
    }

    public function index()
    {
        // Debug: Log session data before logout
        log_message('debug', 'Session data before logout: ' . print_r($_SESSION, true));
        
        // 1. Delete the remember me cookie if exists
        if (get_cookie('__ACTIVE_SESSION_DATA')) {
            delete_cookie('__ACTIVE_SESSION_DATA');
            log_message('debug', 'Deleted remember me cookie');
        }

        // 2. Unset all session data
        $this->session->unset_userdata('__ACTIVE_SESSION_DATA');
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('is_login');
        
        // 3. Destroy the session
        $this->session->sess_destroy();
        
        // Debug: Log session data after logout
        log_message('debug', 'Session data after logout: ' . print_r($_SESSION, true));

        // 4. Delete CI session cookie
        delete_cookie('ci_session');
        
        // 5. Clear all output buffers
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        // 6. Set flash message
        $this->session->set_flashdata('login_flash', 'Berhasil logout!');
        
        // 7. Redirect with no-cache headers
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        
        redirect('auth/login', 'refresh');
        exit();
    }
}