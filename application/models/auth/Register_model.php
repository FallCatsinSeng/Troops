<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function register_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function register_customer($data)
    {
        $this->db->insert('customers', $data);
        return $this->db->insert_id();
    }

    public function save_otp($data)
    {
        return $this->db->insert('otp', $data);
    }

    public function verify_otp($email, $otp)
    {
        $now = date('Y-m-d H:i:s');
        
        $result = $this->db->where('email', $email)
                          ->where('otp_code', $otp)
                          ->where('is_used', 0)
                          ->where('expired_at >', $now)
                          ->get('otp')
                          ->row();
        
        if ($result) {
            // Mark OTP as used
            $this->db->where('id', $result->id)
                    ->update('otp', ['is_used' => 1]);
            return true;
        }
        
        return false;
    }

    public function get_user_by_verification_code($code)
    {
        return $this->db->where('verification_code', $code)
                        ->where('is_verified', 0)
                        ->get('users')
                        ->row();
    }

    public function verify_user($user_id)
    {
        return $this->db->where('id', $user_id)
                        ->update('users', array(
                            'is_verified' => 1,
                            'verification_code' => NULL
                        ));
    }
}