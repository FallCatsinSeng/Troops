<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_email_verification extends CI_Migration {
    public function up()
    {
        // Add verification fields to users table
        $fields = array(
            'is_verified' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'after' => 'role'
            ),
            'verification_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => TRUE,
                'after' => 'is_verified'
            )
        );
        
        $this->dbforge->add_column('users', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('users', 'is_verified');
        $this->dbforge->drop_column('users', 'verification_code');
    }
} 