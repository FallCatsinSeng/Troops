<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_product_dimensions extends CI_Migration {
    public function up() {
        // Add columns for product dimensions and weight
        $fields = array(
            'length' => array(
                'type' => 'INT',
                'constraint' => 10,
                'default' => 20,
                'after' => 'product_unit'
            ),
            'width' => array(
                'type' => 'INT',
                'constraint' => 10,
                'default' => 20,
                'after' => 'length'
            ),
            'height' => array(
                'type' => 'INT',
                'constraint' => 10,
                'default' => 10,
                'after' => 'width'
            ),
            'weight' => array(
                'type' => 'INT',
                'constraint' => 10,
                'default' => 200,
                'after' => 'height'
            )
        );

        $this->dbforge->add_column('products', $fields);
    }

    public function down() {
        // Remove the columns if rolling back
        $this->dbforge->drop_column('products', 'length');
        $this->dbforge->drop_column('products', 'width');
        $this->dbforge->drop_column('products', 'height');
        $this->dbforge->drop_column('products', 'weight');
    }
} 