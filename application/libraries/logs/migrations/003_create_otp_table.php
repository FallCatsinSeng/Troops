<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_otp_table extends CI_Migration {
    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'otp_code' => [
                'type' => 'VARCHAR',
                'constraint' => 6
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'expired_at' => [
                'type' => 'DATETIME'
            ],
            'is_used' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ]
        ]);
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('otp');
    }

    public function down() {
        $this->dbforge->drop_table('otp');
    }
} 