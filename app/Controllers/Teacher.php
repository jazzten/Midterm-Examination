<?php

namespace App\Controllers;

/**
 * Teacher Controller
 * Handles teacher-specific functionality
 *
 * File location: app/Controllers/Teacher.php
 */
class Teacher extends BaseController
{
    /**
     * Teacher Dashboard
     * Route: /teacher/dashboard
     * Method: GET
     *
     * Displays the main dashboard for teachers
     * Only accessible to users with 'teacher' role
     *
     * @return string Teacher dashboard view or redirect if not authorized
     */
    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login first.');
            return redirect()->to('/login');
        }

        // Check if user has teacher role
        if (session()->get('role') !== 'teacher') {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to('/announcements');
        }

        // Prepare data for the view
        $data = [
            'username' => session()->get('username'),
            'email'    => session()->get('email'),
            'role'     => session()->get('role'),
            'title'    => 'Teacher Dashboard',
        ];

        // Load the teacher dashboard view
        return view('teacher_dashboard', $data);
    }

    /**
     * Manage Courses (optional enhancement)
     * Route: /teacher/courses
     * Method: GET
     *
     * @return string Course management view
     */
    public function courses()
    {
        // Check authorization
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'teacher') {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to('/announcements');
        }

        // TODO: Fetch teacher's courses from database
        $data = [
            'username' => session()->get('username'),
            'role'     => session()->get('role'),
            'title'    => 'My Courses',
        ];

        return view('teacher_courses', $data);
    }

    /**
     * Manage Grades (optional enhancement)
     * Route: /teacher/grades
     * Method: GET
     *
     * @return string Grade management view
     */
    public function grades()
    {
        // Check authorization
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'teacher') {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to('/announcements');
        }

        $data = [
            'username' => session()->get('username'),
            'role'     => session()->get('role'),
            'title'    => 'Grade Management',
        ];

        return view('teacher_grades', $data);
    }
}