<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cli extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_columns()
    {
        if (!$this->input->is_cli_request()) {
            echo "This script can only be accessed via CLI";
            return;
        }

        // Check if courier column exists
        if (!$this->db->field_exists('courier', 'orders')) {
            $this->db->query("ALTER TABLE orders ADD COLUMN courier VARCHAR(50) NULL AFTER order_status");
            echo "Added courier column\n";
        }

        // Check if tracking_number column exists
        if (!$this->db->field_exists('tracking_number', 'orders')) {
            $this->db->query("ALTER TABLE orders ADD COLUMN tracking_number VARCHAR(100) NULL AFTER courier");
            echo "Added tracking_number column\n";
        }

        echo "Done!\n";
    }
} 