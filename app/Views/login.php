<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 20px;
        }
        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .login-header i {
            font-size: 3.5rem;
            margin-bottom: 15px;
        }
        .login-body {
            padding: 40px;
            background: white;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: bold;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .test-accounts {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            font-size: 0.9rem;
        }
        .footer-text {
            color: white;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Login Header -->
            <div class="login-header">
                <i class="bi bi-mortarboard-fill"></i>
                <h2 class="mb-1">Student Portal</h2>
                <p class="mb-0">University Management System</p>
            </div>

            <!-- Login Body -->
            <div class="login-body">
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

                <h4 class="text-center mb-4">Sign In to Your Account</h4>

                <!-- Login Form -->
                <form action="<?= base_url('/login') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="username" class="form-label">
                            <i class="bi bi-person-fill"></i> Username
                        </label>
                        <input type="text" class="form-control" id="username" name="username" 
                            placeholder="Enter your username" required autofocus>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock-fill"></i> Password
                        </label>
                        <input type="password" class="form-control" id="password" name="password" 
                            placeholder="Enter your password" required>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-primary btn-login w-100">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </form>

                <!-- Test Accounts Information -->
                <div class="test-accounts">
                    <strong><i class="bi bi-info-circle-fill"></i> Test Accounts:</strong>
                    <hr class="my-2">
                    <small>
                        <strong>Admin:</strong> admin / admin123<br>
                        <strong>Teacher:</strong> teacher1 / teacher123<br>
                        <strong>Student:</strong> student1 / student123
                    </small>
                </div>

                <!-- Forgot Password Link -->
                <div class="text-center mt-3">
                    <small class="text-muted">
                        Forgot password? <a href="#" class="text-decoration-none">Reset here</a>
                    </small>
                </div>
            </div>
        </div>

        <!-- Footer Text -->
        <div class="footer-text">
            <small>© <?= date('Y') ?> University Student Portal. All rights reserved.</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>