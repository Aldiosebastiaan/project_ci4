<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class ProductCategory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'       => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'=> false,
            ],
            'model' => [
                'type'    => 'VARCHAR',
                'constraint' =>255,
                'null'    => false,
            ],
            'deskripsi'=> [
                'type'=>'TEXT',
                'null'=>false,
            ],
            'created_at'=>[
                'type' => 'DATETIME',
                'null' =>true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('product_category');
    }

    public function down()
    {
        $this->forge->dropTable('product_category');
    }
}
