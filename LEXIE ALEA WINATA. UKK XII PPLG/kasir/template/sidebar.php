<?php
// Mengambil nama folder aktif untuk menentukan menu mana yang 'active'
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    * {
        font-family: 'Inter', sans-serif;
    }

    /* Sidebar Container */
    .sidebar-minimalist {
        background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
        min-height: 100vh;
        width: 260px;
        position: fixed;
        z-index: 1000;
        padding: 30px 20px;
        box-shadow: 4px 0 20px rgba(0,0,0,0.08);
    }

    /* Header Brand */
    .sidebar-brand {
        text-align: center;
        margin-bottom: 40px;
        padding: 20px 10px;
    }

    .sidebar-brand h4 {
        font-size: 22px;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        color: #fff;
    }

    .sidebar-brand .role-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        padding: 4px 16px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
    }

    /* Divider */
    .sidebar-divider {
        border: none;
        height: 1px;
        background: rgba(255,255,255,0.15);
        margin: 25px 0;
    }

    /* Navigation Menu */
    .nav-pills .nav-link {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 12px;
        margin-bottom: 6px;
        padding: 14px 18px;
        color: rgba(255,255,255,0.75) !important;
        font-size: 14px;
        font-weight: 400;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    /* Hover Effect - Subtle & Smooth */
    .nav-pills .nav-link:hover:not(.active) {
        background-color: rgba(141, 170, 117, 0.12) !important;
        color: #fff !important;
        transform: translateX(4px);
        padding-left: 22px;
    }

    /* Active State - Clean & Prominent */
    .nav-pills .nav-link.active {
        background-color: rgba(255, 255, 255, 0.95) !important;
        color: #2d6a4f !important;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .nav-pills .nav-link.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: #ffffff;
        border-radius: 0 4px 4px 0;
    }

    /* Icon Styling */
    .nav-link i {
        margin-right: 14px;
        font-size: 16px;
        width: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .nav-link:hover i {
        transform: scale(1.1);
    }

    .nav-link.active i {
        color: #2d6a4f;
    }

    /* Logout Button */
    .logout-section {
        position: absolute;
        bottom: 25px;
        left: 20px;
        right: 20px;
    }

    .btn-logout {
        background: rgba(255,255,255,0.15) !important;
        border: 1px solid rgba(255,255,255,0.3) !important;
        color: #fff !important;
        padding: 12px 20px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        backdrop-filter: blur(10px);
    }

    .btn-logout:hover {
        background: rgba(255,255,255,0.25) !important;
        border-color: rgba(255,255,255,0.4) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .btn-logout i {
        margin-right: 10px;
    }

    /* Spacer untuk konten utama */
    .sidebar-spacer {
        width: 260px;
        flex-shrink: 0;
    }

    /* Responsif */
    @media (max-width: 768px) {
        .sidebar-minimalist {
            display: none;
        }
        .sidebar-spacer {
            display: none;
        }
    }
</style>

<div class="sidebar-minimalist">
    <div class="sidebar-brand">
       <h4><i class="fas fa-store"></i> Kasir Lexie</h4>
        <span class="role-badge"><?= $_SESSION['role']; ?></span> 
    </div>
    
    <hr class="sidebar-divider">
    
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="../dashboard/index.php" class="nav-link <?= ($current_dir == 'dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="../penjualan/index.php" class="nav-link <?= ($current_dir == 'penjualan') ? 'active' : ''; ?>">
                <i class="fas fa-cash-register"></i> Penjualan
            </a>
        </li>

        <li>
            <a href="../produk/index.php" class="nav-link <?= ($current_dir == 'produk') ? 'active' : ''; ?>">
                <i class="fas fa-box"></i> Data Produk
            </a>
        </li>
        
        <?php if($_SESSION['role'] == 'admin'): ?>
        <li>
            <a href="../petugas/index.php" class="nav-link <?= ($current_dir == 'petugas') ? 'active' : ''; ?>">
                <i class="fas fa-user-shield"></i> Registrasi 
            </a>
        </li>
        <?php endif; ?>

        <li>
            <a href="../laporan/index.php" class="nav-link <?= ($current_dir == 'laporan') ? 'active' : ''; ?>">
                <i class="fas fa-chart-line"></i> Laporan
            </a>
        </li>
    </ul>

    <div class="logout-section">
        <hr class="sidebar-divider">
        <a href="../../auth/logout.php" class="btn btn-logout" onclick="return confirm('Yakin ingin keluar?')">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
    </div>
</div>

<div class="d-none d-md-block sidebar-spacer"></div>