<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * AnnouncementSeeder
 * Populates the announcements table with sample data
 *
 * File location: app/Database/Seeds/AnnouncementSeeder.php
 * Run with: php spark db:seed AnnouncementSeeder
 */
class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        // Sample announcement data
        $data = [
            [
                'title'      => 'Welcome to the New Academic Year 2024-2025',
                'content'    => 'We are excited to welcome all students, faculty, and staff to the new academic year. This year promises to bring new opportunities for learning, growth, and collaboration. Please check your class schedules and make sure to attend the orientation sessions scheduled for next week. We look forward to a successful year ahead!',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title'      => 'Midterm Examination Schedule Released',
                'content'    => 'The midterm examination schedule has been officially posted on the student portal. Examinations will begin on November 15, 2024, and continue through November 22, 2024. Students are advised to prepare accordingly and review the examination guidelines available in the student handbook. For any concerns or conflicts, please contact your respective department offices immediately.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'title'      => 'Library Hours Extended During Finals Week',
                'content'    => 'To support student learning and preparation during the finals period, the university library will be extending its operating hours. Starting December 1st, the library will be open from 7:00 AM to 11:00 PM, Monday through Sunday. Additional study rooms and computer labs will also be available for booking. Please reserve your study spaces in advance through the library portal.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
        ];

        // Insert data into announcements table
        foreach ($data as $announcement) {
            $this->db->table('announcements')->insert($announcement);
        }

        // Display success message
        echo "✓ Successfully seeded 3 announcements\n";
    }
}