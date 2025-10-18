<?php

namespace App\Controllers;

/**
 * Student Controller
 * Handles student-specific functionality
 *
 * File location: app/Controllers/Student.php
 */
class Student extends BaseController
{
    /**
     * Student Dashboard (optional)
     * Route: /student/dashboard
     * Method: GET
     *
     * Displays the main dashboard for students
     * Only accessible to users with 'student' role
     *
     * @return string Student dashboard view or redirect if not authorized
     */
    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login first.');
            return redirect()->to('/login');
        }

        // Check if user has student role
        if (session()->get('role') !== 'student') {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to('/announcements');
        }

        // Prepare data for the view
        $data = [
            'username' => session()->get('username'),
            'email'    => session()->get('email'),
            'role'     => session()->get('role'),
            'title'    => 'Student Dashboard',
        ];
        // Load the student dashboard view
        return view('student_dashboard', $data);
    }

    /**
     * View Grades (optional enhancement)
     * Route: /student/grades
     * Method: GET
     *
     * @return string Grades view
     */
    public function grades()
    {
        // Check authorization
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'student') {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to('/announcements');
        }

        // TODO: Fetch student's grades from database
        $data = [
            'username' => session()->get('username'),
            'role'     => session()->get('role'),
            'title'    => 'My Grades',
        ];

        return view('student_grades', $data);
    }

    /**
     * View Courses (optional enhancement)
     * Route: /student/courses
     * Method: GET
     *
     * @return string Courses view
     */
    public function courses()
    {
        // Check authorization
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'student') {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to('/announcements');
        }

        $data = [
            'username' => session()->get('username'),
            'role'     => session()->get('role'),
            'title'    => 'My Courses',
        ];

        return view('student_courses', $data);
    }
}