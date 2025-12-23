<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateScanHistoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'barcode' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'product_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'sugars' => [
                'type'    => 'FLOAT',
                'default' => 0,
            ],
            'calories' => [
                'type'    => 'FLOAT',
                'default' => 0,
            ],
            'scanned_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
                'default' => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id');

        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('scan_history');
    }

    public function down()
    {
        $this->forge->dropTable('scan_history');
    }
}
