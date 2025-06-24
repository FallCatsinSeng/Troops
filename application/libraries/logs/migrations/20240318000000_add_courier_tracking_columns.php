<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_courier_tracking_columns extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        // First check if columns already exist
        $fields = $this->db->field_data('orders');
        $existing_fields = array_column($fields, 'name');
        
        $new_fields = array();
        
        if (!in_array('courier', $existing_fields)) {
            $new_fields['courier'] = array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE
            );
        }
        
        if (!in_array('tracking_number', $existing_fields)) {
            $new_fields['tracking_number'] = array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            );
        }
        
        if (!empty($new_fields)) {
            $this->dbforge->add_column('orders', $new_fields);
        }
    }

    public function down()
    {
        $this->dbforge->drop_column('orders', 'courier');
        $this->dbforge->drop_column('orders', 'tracking_number');
    }
} 