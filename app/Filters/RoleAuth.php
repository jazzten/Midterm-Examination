<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * RoleAuth Filter
 * Implements role-based authorization for route protection
 *
 * File location: app/Filters/RoleAuth.php
 *
 * This filter checks user roles and restricts access to routes:
 * - Admin: Can access /admin/* routes
 * - Teacher: Can access /teacher/* routes
 * - Student: Can access /student/* and /announcements routes
 */
class RoleAuth implements FilterInterface
{
    /**
     * Check authorization before controller execution
     *
     * @param RequestInterface $request
     * @param mixed $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get session instance
        $session = session();

        // Check if user is logged in
        if (!$session->get('isLoggedIn')) {
            $session->setFlashdata('error', 'Please login first.');
            return redirect()->to('/login');
        }

        // Get user role from session
        $role = $session->get('role');

        // Get current URI path
        $uri = $request->getUri()->getPath();

        // Role-based access control logic

        // Admin routes: Only admins can access /admin/*
        if (strpos($uri, '/admin') === 0) {
            if ($role !== 'admin') {
                $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to('/announcements');
            }
        }

        // Teacher routes: Only teachers can access /teacher/*
        elseif (strpos($uri, '/teacher') === 0) {
            if ($role !== 'teacher') {
                $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to('/announcements');
            }
        }

        // Student routes: Only students can access /student/*
        elseif (strpos($uri, '/student') === 0) {
            if ($role !== 'student') {
                $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to('/announcements');
            }
        }

        // Announcements route is accessible to all logged-in users
        // No additional restrictions needed for /announcements

        // Allow request to proceed
        return $request;
    }

    /**
     * Perform actions after controller execution
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param mixed $arguments
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No actions needed after controller execution
    }
}