<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: CreateAnnouncementsTable
 * Creates the announcements table for storing system announcements
 *
 * File location: app/Database/Migrations/YYYY-MM-DD-HHMMSS_CreateAnnouncementsTable.php
 * Run with: php spark migrate
 */
class CreateAnnouncementsTable extends Migration
{
    public function up()
    {
        // Define announcements table structure
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Set id as primary key
        $this->forge->addKey('id', true);

        // Create the announcements table
        $this->forge->createTable('announcements');
    }

    public function down()
    {
        // Drop announcements table if rolling back
        $this->forge->dropTable('announcements');
    }
}