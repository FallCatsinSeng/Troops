<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_reset_password_columns extends CI_Migration {
    public function up() {
        $fields = array(
            'reset_token' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => TRUE,
                'after' => 'password'
            ),
            'reset_expires' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
                'after' => 'reset_token'
            )
        );

        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'reset_token');
        $this->dbforge->drop_column('users', 'reset_expires');
    }
} 