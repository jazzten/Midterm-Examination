<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: CreateUsersTable
 * Creates the users table for authentication system
 *
 * File location: app/Database/Migrations/YYYY-MM-DD-HHMMSS_CreateUsersTable.php
 * Run with: php spark migrate
 */
class CreateUsersTable extends Migration
{
    public function up()
    {
        // Define users table structure
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
                'null'       => false,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['student', 'teacher', 'admin'],
                'default'    => 'student',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Set id as primary key
        $this->forge->addKey('id', true);

        // Create the users table
        $this->forge->createTable('users');
    }

    public function down()
    {
        // Drop users table if rolling back
        $this->forge->dropTable('users');
    }
}