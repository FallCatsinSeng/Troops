<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    protected $username;
    protected $password;

    public function __construct()
    {
        parent::__construct();
    }

    public function login($username = '', $password = '')
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function is_user_exist()
    {
        $username = $this->username;

        $check = $this->db
            ->where('username', $username)
            ->get('users')
            ->num_rows();

        return ($check > 0) ? TRUE : FALSE;
    }

    protected function _get($row = '')
    {
        $username = $this->username;

        $field = $this->db
            ->select($row)
            ->where('username', $username)
            ->get('users')
            ->row()
            ->$row;

        return $field;
    }

    public function get_role()
    {
        return $this->_get('role');
    }

    public function get_password()
    {
        return $this->_get('password');
    }

    public function logged_user_id()
    {
        return $this->_get('id');
    }

    public function is_verified()
    {
        return $this->_get('is_verified');
    }

    public function get_email()
    {
        return $this->_get('email');
    }

    public function verify_user($user_id)
    {
        return $this->db->where('id', $user_id)
                        ->update('users', [
                            'email_verified_at' => date('Y-m-d H:i:s'),
                            'is_verified' => 1
                        ]);
    }
}