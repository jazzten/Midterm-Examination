<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements - Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="bi bi-mortarboard-fill"></i> Student Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('/announcements') ?>">
                            <i class="bi bi-megaphone"></i> Announcements
                        </a>
                    </li>
                    <?php if (isset($role)): ?>
                        <?php if ($role === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/admin/dashboard') ?>">
                                    <i class="bi bi-speedometer2"></i> Admin Dashboard
                                </a>
                            </li>
                        <?php elseif ($role === 'teacher'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/teacher/dashboard') ?>">
                                    <i class="bi bi-speedometer2"></i> Teacher Dashboard
                                </a>
                            </li>
                        <?php elseif ($role === 'student'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/student/dashboard') ?>">
                                    <i class="bi bi-speedometer2"></i> My Dashboard
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/logout') ?>">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <!-- User Welcome Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="alert alert-info d-flex align-items-center">
                    <i class="bi bi-person-circle fs-3 me-3"></i>
                    <div>
                        <strong>Welcome, <?= esc($username ?? 'User') ?>!</strong>
                        <span class="badge bg-primary ms-2"><?= ucfirst(esc($role ?? 'guest')) ?></span>
                        <div class="small">You are currently viewing the announcements page</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="d-flex align-items-center">
                    <i class="bi bi-megaphone-fill text-primary me-2"></i>
                    Announcements
                </h2>
                <p class="text-muted">Stay updated with the latest news and information from the university</p>
                <hr>
            </div>
        </div>

        <!-- Announcements List -->
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($announcements)): ?>
                    <?php foreach ($announcements as $index => $announcement): ?>
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">
                                        <i class="bi bi-pin-angle-fill text-warning"></i>
                                        <?= esc($announcement['title']) ?>
                                    </h5>
                                    <span class="badge bg-info">#<?= $index + 1 ?></span>
                                </div>
                                <p class="card-text mt-3"><?= nl2br(esc($announcement['content'])) ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar-event"></i>
                                        Posted on: <?= date('F d, Y - h:i A', strtotime($announcement['created_at'])) ?>
                                    </small>
                                    <small class="text-muted">
                                        <i class="bi bi-clock-history"></i>
                                        <?php
                                            $date = new DateTime($announcement['created_at']);
                                            $now = new DateTime();
                                            $diff = $now->diff($date);
                                            if ($diff->days == 0) {
                                                echo 'Today';
                                            } elseif ($diff->days == 1) {
                                                echo '1 day ago';
                                            } else {
                                                echo $diff->days . ' days ago';
                                            }
                                        ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                        <div>
                            <strong>No announcements available</strong>
                            <div>There are currently no announcements to display. Please check back later.</div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © <?= date('Y') ?> University Student Portal. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/