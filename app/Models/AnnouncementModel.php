<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AnnouncementModel
 * Handles all database operations for announcements
 *
 * File location: app/Models/AnnouncementModel.php
 */
class AnnouncementModel extends Model
{
    protected $table            = 'announcements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'content', 'created_at'];

    // Dates configuration
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation rules
    protected $validationRules = [
        'title'   => 'required|min_length[3]|max_length[255]',
        'content' => 'required|min_length[10]',
    ];

    protected $validationMessages   = [
        'title' => [
            'required'   => 'Title is required',
            'min_length' => 'Title must be at least 3 characters',
            'max_length' => 'Title cannot exceed 255 characters',
        ],
        'content' => [
            'required'   => 'Content is required',
            'min_length' => 'Content must be at least 10 characters',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get all announcements ordered by created_at in descending order
     * This method returns the newest announcements first
     *
     * @return array List of announcements
     */
    public function getAnnouncementsOrdered()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    /**
     * Get recent announcements with limit
     *
     * @param int $limit Number of announcements to retrieve
     * @return array List of announcements
     */
    public function getRecentAnnouncements($limit = 5)
    {
        return $this->orderBy('created_at', 'DESC')->findAll($limit);
    }
}