<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function register($data) {
        return $this->db->insert('users', $data);
    }

    public function login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    public function verifyEmail($email) {
        $this->db->where('email', $email);
        return $this->db->update('users', ['email_verified_at' => date('Y-m-d H:i:s'), 'is_verified' => 1]);
    }

    public function checkUsername($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function checkEmail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function getUserByEmail($email)
    {
        $query = $this->db->where('email', $email)
                         ->get('users');
        
        return $query->row_array();
    }

    public function updatePassword($user_id, $password)
    {
        return $this->db->where('id', $user_id)
                       ->update('users', ['password' => $password]);
    }

    public function saveResetToken($user_id, $token, $expires)
    {
        $data = [
            'reset_token' => $token,
            'reset_expires' => $expires
        ];
        
        return $this->db->where('id', $user_id)
                       ->update('users', $data);
    }

    public function getResetToken($token)
    {
        $query = $this->db->select('id as user_id, reset_token, reset_expires')
                         ->where('reset_token', $token)
                         ->get('users');
        
        return $query->row_array();
    }

    public function clearResetToken($user_id)
    {
        return $this->db->where('id', $user_id)
                       ->update('users', [
                           'reset_token' => NULL,
                           'reset_expires' => NULL
                       ]);
    }
} 