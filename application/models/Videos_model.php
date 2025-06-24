<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_videos()
    {
        return $this->db->order_by('created_at', 'DESC')->get('videos')->result();
    }
}
