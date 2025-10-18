<?php

namespace App\Controllers;

/**
 * Admin Controller
 * Handles administrator-specific functionality
 *
 * File location: app/Controllers/Admin.php
 */
class Admin extends BaseController
{
    /**
     * Admin Dashboard
     * Route: /admin/dashboard
     * Method: GET
     *
     * Displays the main dashboard for administrators
     * Only accessible to users with 'admin' role
     *
     * @return string Admin dashboard view or redirect if not authorized
     */
    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login first.');
            return redirect()->to('/login');
        }

        // Check if user has admin role
        if (session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to('/announcements');
        }

        // Prepare data for the view
        $data = [
            'username' => session()->get('username'),
            'email'    => session()->get('email'),
            'role'     => session()->get('role'),
            'title'    => 'Admin Dashboard',
        ];

        // Load the admin dashboard view
        return view('admin_dashboard', $data);
    }

    /**
     * Manage Users (optional enhancement)
     * Route: /admin/users
     * Method: GET
     *
     * @return string User management view
     */
    public function users()
    {
        // Check authorization
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to('/announcements');
        }

        // TODO: Fetch all users from database
        $data = [
            'username' => session()->get('username'),
            'role'     => session()->get('role'),
            'title'    => 'User Management',
        ];

        return view('admin_users', $data);
    }

    /**
     * System Settings (optional enhancement)
     * Route: /admin/settings
     * Method: GET
     *
     * @return string Settings view
     */
    public function settings()
    {
        // Check authorization
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to('/announcements');
        }

        $data = [
            'username' => session()->get('username'),
            'role'     => session()->get('role'),
            'title'    => 'System Settings',
        ];

        return view('admin_settings', $data);
    }
}