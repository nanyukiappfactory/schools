<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_school_images extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'school_image_id' => array(
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ),

            'school_image_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ),
             'school_thumb_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ),
            'school_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => false,
            ),
            'school_image_status' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => false,
            ),

        ));

        $this->dbforge->add_field("`created_by` int  NULL ");
        $this->dbforge->add_field("`created_on` datetime  NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("`modified_by` int NULL ");
        $this->dbforge->add_field("`modified_on` timestamp  NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("`deleted_by` int  NULL");
        $this->dbforge->add_field("`deleted` tinyint  NULL DEFAULT 0");
        $this->dbforge->add_field("`deleted_on` timestamp NULL ");
        $this->dbforge->add_key('school_image_id', true);
        $this->dbforge->create_table('school_images');
        
      }

    public function down()
    {
        $this->dbforge->drop_table('school_images');
    }
}
