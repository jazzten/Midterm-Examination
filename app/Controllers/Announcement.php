<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;

/**
 * Announcement Controller
 * Handles announcement display and management
 *
 * File location: app/Controllers/Announcement.php
 */
class Announcement extends BaseController
{
    /**
     * Display all announcements
     * Route: /announcements
     * Method: GET
     *
     * This method fetches all announcements from the database
     * and displays them ordered by created_at (newest first)
     *
     * @return string View with announcements data
     */
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to view announcements.');
            return redirect()->to('/login');
        }

        // Initialize AnnouncementModel
        $announcementModel = new AnnouncementModel();

        // Fetch all announcements ordered by created_at DESC (newest first)
        $announcements = $announcementModel->getAnnouncementsOrdered();

        // Prepare data for the view
        $data = [
            'announcements' => $announcements,
            'username'      => session()->get('username'),
            'role'          => session()->get('role'),
            'title'         => 'Announcements',
        ];

        // Load the announcements view
        return view('announcements', $data);
    }

    /**
     * Display single announcement (optional enhancement)
     * Route: /announcements/view/{id}
     * Method: GET
     *
     * @param int $id Announcement ID
     * @return string View with single announcement
     */
    public function view($id)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login first.');
            return redirect()->to('/login');
        }

        // Initialize AnnouncementModel
        $announcementModel = new AnnouncementModel();

        // Fetch specific announcement
        $announcement = $announcementModel->find($id);

        // Check if announcement exists
        if (!$announcement) {
            session()->setFlashdata('error', 'Announcement not found.');
            return redirect()->to('/announcements');
        }

        // Prepare data for the view
        $data = [
            'announcement' => $announcement,
            'username'     => session()->get('username'),
            'role'         => session()->get('role'),
            'title'        => $announcement['title'],
        ];

        // Load single announcement view
        return view('announcement_single', $data);
    }
}