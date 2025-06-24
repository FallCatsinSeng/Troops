<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_is_verified extends CI_Migration {
    public function up() {
        $fields = array(
            'is_verified' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'after' => 'role'
            )
        );
        
        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'is_verified');
    }
} 