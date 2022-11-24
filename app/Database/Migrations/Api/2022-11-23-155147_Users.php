<?php

namespace App\Database\Migrations\Api;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'auto_increment' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
            'deleted_at' => [
                'type' => 'DATETIME'
            ],
            'last_login' => [
                'type' => 'DATETIME'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
