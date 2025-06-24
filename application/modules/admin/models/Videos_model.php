<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos_model extends CI_Model {
    protected $table = 'videos';

    public function __construct()
    {
        parent::__construct();
    }

    public function count_all_videos()
    {
        return $this->db->get($this->table)->num_rows();
    }

    public function get_all_videos($limit = null, $start = null)
    {
        if ($limit !== null && $start !== null) {
            $this->db->limit($limit, $start);
        }
        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result();
    }

    public function insert_video($data)
    {
        // Pastikan data yang diperlukan ada
        if (!isset($data['title']) || !isset($data['url'])) {
            return false;
        }

        // Bersihkan data
        $insert_data = [
            'title' => htmlspecialchars($data['title']),
            'url' => htmlspecialchars($data['url'])
        ];

        // Insert ke database
        $this->db->insert($this->table, $insert_data);
        
        // Return true jika berhasil
        return ($this->db->affected_rows() > 0);
    }

    public function delete_video($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }
}
