<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->user_id = get_current_user_id();
    }

    public function get_profile()
    {
        $id = $this->user_id;

        $data = $this->db->query("
            SELECT u.id, u.username, u.email, 
                   c.name, c.phone_number, c.address, c.profile_picture, 
                   c.provinsi, c.kabupaten, c.kecamatan, c.desa, c.kode_pos,
                   u.password
            FROM users u
            JOIN customers c
                ON c.user_id = u.id
            WHERE u.id = '$id'
        ");

        return $data->row();
    }

    public function update($data)
    {
        // Debug update process
        log_message('debug', 'Updating profile for user_id: ' . $this->user_id);
        log_message('debug', 'Update data: ' . print_r($data, true));
        
        $result = $this->db->where('user_id', $this->user_id)->update('customers', $data);
        
        // Debug update result
        log_message('debug', 'Update result: ' . ($result ? 'success' : 'failed'));
        log_message('debug', 'Last query: ' . $this->db->last_query());
        
        return $result;
    }

    public function update_account($data)
    {
        return $this->db->where('id', $this->user_id)->update('users', $data);
    }
}