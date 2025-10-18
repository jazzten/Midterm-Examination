<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * UserSeeder
 * Populates the users table with sample accounts
 *
 * File location: app/Database/Seeds/UserSeeder.php
 * Run with: php spark db:seed UserSeeder
 */
class UserSeeder extends Seeder
{
    public function run()
    {
        // Sample user data with different roles
        $data = [
            // Admin Account
            [
                'username'   => 'admin',
                'email'      => 'admin@university.edu',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],

            // Teacher Accounts
            [
                'username'   => 'teacher1',
                'email'      => 'teacher1@university.edu',
                'password'   => password_hash('teacher123', PASSWORD_DEFAULT),
                'role'       => 'teacher',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'prof_jazz',
                'email'      => 'jazz@university.edu',
                'password'   => password_hash('teacher123', PASSWORD_DEFAULT),
                'role'       => 'teacher',
                'created_at' => date('Y-m-d H:i:s'),
            ],

            // Student Accounts
            [
                'username'   => 'student1',
                'email'      => 'student1@university.edu',
                'password'   => password_hash('student123', PASSWORD_DEFAULT),
                'role'       => 'student',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'oscar_wig',
                'email'      => 'oscar.wig@university.edu',
                'password'   => password_hash('student123', PASSWORD_DEFAULT),
                'role'       => 'student',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'tata_smith',
                'email'      => 'tata.smith@university.edu',
                'password'   => password_hash('student123', PASSWORD_DEFAULT),
                'role'       => 'student',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data into users table
        foreach ($data as $user) {
            $this->db->table('users')->insert($user);
        }

        // Display success message with account details
        echo "\n✓ Successfully seeded 6 user accounts:\n";
        echo "  - 1 Admin (admin/admin123)\n";
        echo "  - 2 Teachers (teacher1/teacher123, prof_smith/teacher123)\n";
        echo "  - 3 Students (student1/student123, john_doe/student123, jane_smith/student123)\n\n";
    }
}