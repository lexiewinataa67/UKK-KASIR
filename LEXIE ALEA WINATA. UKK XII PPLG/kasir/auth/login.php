<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login Lexie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 50%, #40916c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background Pattern */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: float 20s linear infinite;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            animation: float 25s linear infinite reverse;
        }

        @keyframes float {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        /* Login Container */
        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 1rem;
        }

        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            border: none;
            border-radius: 24px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 2;
                transform: translateY(0);
            }
        }

        /* Card Header */
        .card-header-custom {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            padding: 2rem 1rem 5rem;
            position: relative;
            overflow: hidden;
        }

        .card-header-custom::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .card-header-custom::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        /* Brand Logo */
        .brand-logo {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.95);
            color: #2d6a4f;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 2.5rem;
            box-shadow: 
                0 10px 30px rgba(0, 0, 0, 0.2),
                0 0 0 4px rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
            transform: rotate(-5deg);
            transition: transform 0.3s ease;
        }

        .brand-logo:hover {
            transform: rotate(0deg) scale(1.05);
        }

        .brand-text {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
            margin-top: 1.5rem;
        }

        .brand-text h3 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: 1px;
        }

        .brand-text p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 0;
        }

        /* Card Body */
        .card-body-custom {
            padding: 2.5rem 2rem 2rem;
            margin-top: -5rem;
            position: relative;
            z-index: 2;
        }

        /* Welcome Box */
        .welcome-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
            border: 1px solid rgba(45, 106, 79, 0.1);
        }

        .welcome-box h5 {
            color: #2d6a4f;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .welcome-box p {
            color: #6c757d;
            margin: 0;
            font-size: 0.875rem;
        }

        /* Alert */
        .alert-custom {
            background: linear-gradient(135deg, #fee 0%, #fdd 100%);
            border: 1px solid #f5c6cb;
            border-radius: 12px;
            color: #721c24;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .alert-custom i {
            font-size: 1.1rem;
        }

        /* Form Elements */
        .form-label-custom {
            font-size: 0.85rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-group-custom {
            margin-bottom: 1.25rem;
        }

        .input-group-text-custom {
            background: #f8f9fa;
            border: 1.5px solid #e9ecef;
            border-right: none;
            border-radius: 12px 0 0 12px;
            padding: 0.75rem 1rem;
            color: #2d6a4f;
        }

        .form-control-custom {
            border: 1.5px solid #e9ecef;
            border-left: none;
            border-radius: 0 12px 12px 0;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control-custom:focus {
            border-color: #2d6a4f;
            box-shadow: 0 0 0 0.2rem rgba(45, 106, 79, 0.15);
            background: white;
        }

        .form-control-custom:focus + .input-group-text-custom {
            border-color: #2d6a4f;
        }

        .input-group-custom:focus-within .input-group-text-custom {
            border-color: #2d6a4f;
            color: #1b4332;
        }

        /* Login Button */
        .btn-login {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            border: none;
            border-radius: 12px;
            padding: 0.9rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            color: white;
            width: 100%;
            margin-top: 1rem;
            box-shadow: 0 4px 15px rgba(45, 106, 79, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(45, 106, 79, 0.4);
            background: linear-gradient(135deg, #40916c 0%, #2d6a4f 100%);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }

        .belum-ada-akun {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #646161
        }

        .login-footer p {
            color: #6c757d;
            font-size: 0.75rem;
            letter-spacing: 1px;
            margin: 0;
        }

        /* Decorative Elements */
        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(45, 106, 79, 0.05);
        }

        .circle-1 {
            width: 100px;
            height: 100px;
            top: -50px;
            right: -50px;
        }

        .circle-2 {
            width: 150px;
            height: 150px;
            bottom: -75px;
            left: -75px;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                padding: 0.5rem;
            }

            .card-body-custom {
                padding: 2rem 1.5rem 1.5rem;
            }

            .brand-text h3 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <!-- Card Header with Brand -->
        <div class="card-header-custom">
            <div class="brand-logo">
                <i class="fas fa-store"></i>
            </div>
            <div class="brand-text">
                <h3>KASIR LEXIE</h3>
                <p>Website Aplikasi Kasir</p>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body-custom">
            <div class="decorative-circle circle-1"></div>
            <div class="decorative-circle circle-2"></div>

            <!-- Welcome Message -->
            <div class="welcome-box">
                <h5><i class="fas fa-hand-wave me-2"></i>Halo Ganteng!</h5>
                <p>Login la biar masuk, kalo gada akun kontak adminnya @lexiewinataa_</p>
            </div>

            <!-- Error Message -->
            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == "gagal"): ?>
                <div class="alert-custom">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Login Gagal!</strong> Username atau password salah
                </div>
            <?php endif; ?>

            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == "belum_login"): ?>
                <div class="alert-custom">
                    <i class="fas fa-lock me-2"></i>
                    <strong>Akses Ditolak!</strong> Silakan login terlebih dahulu
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="auth.php" method="POST">
                <div class="input-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-user me-1"></i> Username
                    </label>
                    <div class="input-group">
                        <span class="input-group-text input-group-text-custom">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" 
                               name="username" 
                               class="form-control form-control-custom" 
                               placeholder="Masukkan username nya coy" 
                               required 
                               autocomplete="off"
                               autofocus>
                    </div>
                </div>

                <div class="input-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-lock me-1"></i> Password
                    </label>
                    <div class="input-group">
                        <span class="input-group-text input-group-text-custom">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" 
                               name="password" 
                               class="form-control form-control-custom" 
                               placeholder="Masukkan password lu" 
                               required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>MASUK SEKARANG
                </button>
            </div>
            </form>

            <!-- Footer -->
         
                   
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>