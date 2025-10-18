<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * UserModel
 * Handles all database operations for users and authentication
 * 
 * File location: app/Models/UserModel.php
 */
class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'email', 'password', 'role', 'created_at'];

    // Dates configuration
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation rules
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'role'     => 'required|in_list[student,teacher,admin]',
    ];
    
    protected $validationMessages = [
        'username' => [
            'required'   => 'Username is required',
            'is_unique'  => 'Username already exists',
            'min_length' => 'Username must be at least 3 characters',
        ],
        'email' => [
            'required'    => 'Email is required',
            'valid_email' => 'Please provide a valid email',
            'is_unique'   => 'Email already registered',
        ],
        'password' => [
            'required'   => 'Password is required',
            'min_length' => 'Password must be at least 6 characters',
        ],
    ];
    
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Hash password before inserting or updating
     * 
     * @param array $data
     * @return array Modified data with hashed password
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * Find user by username
     * 
     * @param string $username
     * @return array|null User data or null
     */
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Find user by email
     * 
     * @param string $email
     * @return array|null User data or null
     */
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Verify user password
     * 
     * @param string $password Plain text password
     * @param string $hashedPassword Hashed password from database
     * @return bool True if password matches
     */
    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}