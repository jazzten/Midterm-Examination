<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
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
                        <a class="nav-link" href="<?= base_url('/announcements') ?>">Announcements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('/teacher/dashboard') ?>">Dashboard</a>
                    </li>
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

        <!-- Welcome Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron bg-success text-white p-5 rounded shadow">
                    <h1 class="display-4">
                        <i class="bi bi-person-badge-fill"></i> Welcome, Teacher!
                    </h1>
                    <p class="lead">Hello, <strong><?= esc($username ?? 'Teacher') ?></strong></p>
                    <hr class="my-4 bg-white">
                    <p>You have successfully accessed the Teacher Dashboard. From here, you can manage your courses, grades, and interact with students.</p>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-clipboard-check-fill"></i> Pending Tasks</h5>
                        <p class="card-text display-6">8</p>
                        <small>Assignments to Grade</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Quick Actions</h3>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-plus display-4 text-success"></i>
                        <h5 class="card-title mt-3">Manage Courses</h5>
                        <button class="btn btn-success btn-sm">Access</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <i class="bi bi-graph-up display-4 text-info"></i>
                        <h5 class="card-title mt-3">View Grades</h5>
                        <button class="btn btn-info btn-sm">Access</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-event display-4 text-warning"></i>
                        <h5 class="card-title mt-3">Schedule</h5>
                        <button class="btn btn-warning btn-sm">Access</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <i class="bi bi-chat-dots display-4 text-primary"></i>
                        <h5 class="card-title mt-3">Messages</h5>
                        <button class="btn btn-primary btn-sm">Access</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © <?= date('Y') ?> University Student Portal. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-book-fill"></i> My Courses</h5>
                        <p class="card-text display-6">5</p>
                        <small>Active Courses</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-people-fill"></i> Students</h5>
                        <p class="card-text display-6">120</p>
                        <small>Total Students</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
