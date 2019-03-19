<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_post extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'post_id' => array(
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ),
            'post_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ),
            'post_description' => array(
                'type' => 'text',
                'null' => true,
                'constraint' => '5000',
            ),
            'post_image_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ),
            'post_thumb_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ),
            'image_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'post_status' => array(
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => 0,
            ),
            'post_date' => array(
                'type' => 'DATE',
                'null' => true,
            ),
        ));

        $this->dbforge->add_field("`created_by` int NOT NULL");
        $this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("`modified_by` int  NULL");
        $this->dbforge->add_field("`modified_on` timestamp  NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("`deleted_by` int  NULL");
        $this->dbforge->add_field("`deleted` tinyint NOT NULL DEFAULT 0");
        $this->dbforge->add_field("`deleted_on` timestamp NULL DEFAULT NULL");
        $this->dbforge->add_key('post_id', true);
        $this->dbforge->create_table('post');
    }

    public function down()
    {
        $this->dbforge->drop_table('post');
    }
}