<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_address_fields extends CI_Migration {
    public function up() {
        $fields = array(
            'provinsi' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'kabupaten' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'kecamatan' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'desa' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'kode_pos' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => TRUE
            )
        );

        $this->dbforge->add_column('customers', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('customers', 'provinsi');
        $this->dbforge->drop_column('customers', 'kabupaten');
        $this->dbforge->drop_column('customers', 'kecamatan');
        $this->dbforge->drop_column('customers', 'desa');
        $this->dbforge->drop_column('customers', 'kode_pos');
    }
} 