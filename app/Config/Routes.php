<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// --------------------------------------------------------------------
// Authentication Routes (Public Access)
// --------------------------------------------------------------------
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::processRegister');

// --------------------------------------------------------------------
// Announcements Route (All Logged-in Users)
// --------------------------------------------------------------------
$routes->get('/announcements', 'Announcement::index');
$routes->get('/announcements/view/(:num)', 'Announcement::view/$1');

// --------------------------------------------------------------------
// Admin Routes (Protected by RoleAuth Filter)
// Only accessible to users with 'admin' role
// --------------------------------------------------------------------
$routes->group('admin', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('users', 'Admin::users');
    $routes->get('settings', 'Admin::settings');
    // Add more admin routes here as needed
});

// --------------------------------------------------------------------
// Teacher Routes (Protected by RoleAuth Filter)
// Only accessible to users with 'teacher' role
// --------------------------------------------------------------------
$routes->group('teacher', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Teacher::dashboard');
    $routes->get('courses', 'Teacher::courses');
    $routes->get('grades', 'Teacher::grades');
    // Add more teacher routes here as needed
});

// --------------------------------------------------------------------
// Student Routes (Protected by RoleAuth Filter)
// Only accessible to users with 'student' role
// --------------------------------------------------------------------
$routes->group('student', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Student::dashboard');
    $routes->get('courses', 'Student::courses');
    $routes->get('grades', 'Student::grades');
    // Add more student routes here as needed
});
