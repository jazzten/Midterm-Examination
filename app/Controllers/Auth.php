<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * Auth Controller
 * Handles user authentication with role-based redirection
 *
 * File location: app/Controllers/Auth.php
 */
class Auth extends BaseController
{
    /**
     * Display login page
     * Route: /login
     * Method: GET
     *
     * @return string Login view or redirect if already logged in
     */
    public function index()
    {
        // If user is already logged in, redirect based on their role
        if (session()->get('isLoggedIn')) {
            return $this->redirectByRole(session()->get('role'));
        }

        // Display login form
        return view('login');
    }

    /**
     * Process login form submission
     * Route: /login
     * Method: POST
     *
     * This method handles user authentication and redirects
     * users to appropriate dashboards based on their roles
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function login()
    {
        // Get session instance
        $session = session();

        // Initialize UserModel
        $userModel = new UserModel();

        // Get form input data
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Validate input
        if (empty($username) || empty($password)) {
            $session->setFlashdata('error', 'Please enter both username and password.');
            return redirect()->to('/login');
        }

        // Find user by username
        $user = $userModel->where('username', $username)->first();

        // Check if user exists
        if ($user) {
            // Verify password
            $passwordVerify = password_verify($password, $user['password']);

            if ($passwordVerify) {
                // Password is correct - set session data
                $sessionData = [
                    'id'         => $user['id'],
                    'username'   => $user['username'],
                    'email'      => $user['email'],
                    'role'       => $user['role'],
                    'isLoggedIn' => true,
                ];

                $session->set($sessionData);

                // Set success message
                $session->setFlashdata('success', 'Welcome back, ' . $user['username'] . '!');

                // Redirect based on user role
                return $this->redirectByRole($user['role']);

            } else {
                // Password is incorrect
                $session->setFlashdata('error', 'Invalid username or password.');
                return redirect()->to('/login');
            }
        } else {
            // User not found
            $session->setFlashdata('error', 'Invalid username or password.');
            return redirect()->to('/login');
        }
    }

    /**
     * Redirect user based on their role
     *
     * This method implements role-based redirection:
     * - Students → /announcements
     * - Teachers → /teacher/dashboard
     * - Admins → /admin/dashboard
     *
     * @param string $role User role
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    private function redirectByRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->to('/admin/dashboard');

            case 'teacher':
                return redirect()->to('/teacher/dashboard');

            case 'student':
                return redirect()->to('/announcements');

            default:
                // Fallback to announcements for unknown roles
                return redirect()->to('/announcements');
        }
    }

    /**
     * Logout user and destroy session
     * Route: /logout
     * Method: GET
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function logout()
    {
        // Get session instance
        $session = session();

        // Destroy all session data
        $session->destroy();

        // Set success message
        $session->setFlashdata('success', 'You have been logged out successfully.');

        // Redirect to login page
        return redirect()->to('/login');
    }

    /**
     * Display registration page (optional)
     * Route: /register
     * Method: GET
     *
     * @return string Registration view
     */
    public function register()
    {
        // Display registration form
        return view('register');
    }

    /**
     * Process registration form (optional)
     * Route: /register
     * Method: POST
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function processRegister()
    {
        // Get session instance
        $session = session();

        // Initialize UserModel
        $userModel = new UserModel();

        // Get form input
        $data = [
            'username'   => $this->request->getVar('username'),
            'email'      => $this->request->getVar('email'),
            'password'   => $this->request->getVar('password'),
            'role'       => 'student', // Default role for new registrations
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Attempt to insert new user
        if ($userModel->insert($data)) {
            $session->setFlashdata('success', 'Registration successful! Please login.');
            return redirect()->to('/login');
        } else {
            $session->setFlashdata('error', 'Registration failed. Please try again.');
            return redirect()->to('/register');
        }
    }
}