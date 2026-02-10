<?php 
session_start();
// Proteksi halaman: Jika belum login, lempar ke halaman login
if($_SESSION['status'] != "login"){
    header("location:../../auth/login.php?pesan=belum_login");
}
include '../../main/connect.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laman Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f8f9fa;
        }

        /* Header Section */
        .dashboard-header {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            
            box-shadow: 0 4px 20px rgba(45, 106, 79, 0.15);
        }

        .dashboard-header h1 {
            font-weight: 600;
            font-size: 2rem;
            margin: 0;
        }

        .dashboard-header .welcome-text {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        /* Stat Cards */
        .stat-card {
            border-radius: 16px;
            border: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
            height: 100%;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .stat-card .card-body {
            padding: 1.75rem;
            position: relative;
            z-index: 1;
        }

        .stat-icon {
            width: 64px;
            height: 64px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 1rem 0 0.25rem 0;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.95;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Color Variants */
        .card-green {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            color: white;
        }

        .card-blue {
            background: linear-gradient(135deg, #4a90a4 0%, #3d7a8a 100%);
            color: white;
        }

        .card-orange {
            background: linear-gradient(135deg, #f4a261 0%, #e76f51 100%);
            color: white;
        }

        .card-red {
            background: linear-gradient(135deg, #d62828 0%, #c1121f 100%);
            color: white;
        }

        /* Low Stock Table */
        .stock-card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .stock-card .card-header {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            border: none;
        }

        .stock-card .card-header h6 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .stock-table {
            margin: 0;
        }

        .stock-table thead {
            background: #f8f9fa;
        }

        .stock-table thead th {
            border: none;
            padding: 1rem 1.25rem;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
        }

        .stock-table tbody td {
            padding: 1.1rem 1.25rem;
            vertical-align: middle;
            border-color: #f1f3f5;
        }

        .stock-table tbody tr {
            transition: all 0.2s ease;
        }

        .stock-table tbody tr:hover {
            background: rgba(45, 106, 79, 0.03);
            transform: scale(1.01);
        }

        .badge-stock {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .btn-action {
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 106, 79, 0.2);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .empty-state p {
            margin: 0;
            font-size: 1rem;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-card {
            animation: fadeInUp 0.5s ease forwards;
        }

        .animate-card:nth-child(1) { animation-delay: 0.1s; opacity: 0; }
        .animate-card:nth-child(2) { animation-delay: 0.2s; opacity: 0; }
        .animate-card:nth-child(3) { animation-delay: 0.3s; opacity: 0; }
        .animate-card:nth-child(4) { animation-delay: 0.4s; opacity: 0; }

        /* Responsive */
        @media (max-width: 768px) {
            .stat-number {
                font-size: 1.8rem;
            }
            
            .stat-icon {
                width: 52px;
                height: 52px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="d-flex">
    <?php include '../../template/sidebar.php'; ?>

    <div class="container-fluid p-0">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="container-fluid px-4">
                <h1><i class="fas fa-chart-line me-3"></i>Dashboard</h1>
                <div class="welcome-text">
                    <i class="fas fa-user-circle me-2"></i>Selamat datang, <strong><?php echo $_SESSION['username']; ?></strong> 
                    <span class="ms-3"><i class="fas fa-calendar-alt me-2"></i><?php echo date('d F Y'); ?></span>
                </div>
            </div>
        </div>

        <div class="container-fluid px-4 pb-4">
            <!-- Stat Cards -->
            <div class="row g-4 mb-4">
                <!-- Total Produk -->
                <div class="col-12 col-sm-6 col-xl-3 animate-card">
                    <div class="card stat-card card-green">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon me-3">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="stat-label">Total Produk</div>
                                    <?php 
                                        $ambil_produk = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk");
                                        $data_produk  = mysqli_fetch_assoc($ambil_produk);
                                        echo '<div class="stat-number">' . $data_produk['total'] . '</div>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Penjualan Hari Ini -->
                <div class="col-12 col-sm-6 col-xl-3 animate-card">
                    <div class="card stat-card card-blue">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon me-3">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="stat-label">Penjualan Hari Ini</div>
                                    <?php 
                                        date_default_timezone_set('Asia/Jakarta'); 
                                        $tgl_hari_ini = date('Y-m-d');
                                        $query_hari_ini = mysqli_query($conn, "SELECT COUNT(*) as total FROM penjualan WHERE TanggalPenjualan LIKE '$tgl_hari_ini%'");
                                        $data_hari_ini = mysqli_fetch_assoc($query_hari_ini);
                                        echo '<div class="stat-number">' . ($data_hari_ini['total'] ?? 0) . '</div>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pelanggan -->
                <div class="col-12 col-sm-6 col-xl-3 animate-card">
                    <div class="card stat-card card-orange">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon me-3">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="stat-label">Total Pelanggan</div>
                                    <?php 
                                        $query_plg = mysqli_query($conn, "SELECT DISTINCT PelangganID FROM penjualan");
                                        $jml_plg = mysqli_num_rows($query_plg);
                                        echo '<div class="stat-number">' . $jml_plg . '</div>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Petugas -->
                <div class="col-12 col-sm-6 col-xl-3 animate-card">
                    <div class="card stat-card card-red">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon me-3">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="stat-label">Total Petugas</div>
                                    <?php 
                                        $hitung_user = mysqli_query($conn, "SELECT COUNT(*) AS total FROM user");
                                        $hasil_user = mysqli_fetch_assoc($hitung_user);
                                        echo '<div class="stat-number">' . $hasil_user['total'] . '</div>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Low Stock Table -->
            <div class="card stock-card">
                <div class="card-header">
                    <h6>
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Stok Produk Menipis
                    </h6>
                </div>
                <div class="card-body p-0">
                    <?php 
                    $stok_low = mysqli_query($conn, "SELECT * FROM produk WHERE Stok < 10 ORDER BY Stok ASC");
                    if(mysqli_num_rows($stok_low) > 0){
                    ?>
                    <div class="table-responsive">
                        <table class="table stock-table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($d = mysqli_fetch_assoc($stok_low)){
                                ?>
                                <tr>
                                    <td><span class="text-muted">#<?php echo $d['ProdukID']; ?></span></td>
                                    <td><strong><?php echo $d['NamaProduk']; ?></strong></td>
                                    <td>Rp <?php echo number_format($d['Harga'], 0, ',', '.'); ?></td>
                                    <td>
                                        <span class="badge badge-stock bg-danger">
                                            <i class="fas fa-box me-1"></i><?php echo $d['Stok']; ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="../produk/edit.php?id=<?= $d['ProdukID']; ?>" class="btn btn-sm btn-action btn-dark">
                                            <i class="fas fa-edit me-1"></i> Update Stok
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php 
                    } else {
                    ?>
                    <div class="empty-state">
                        <i class="fas fa-check-circle"></i>
                        <p>Semua produk memiliki stok yang cukup</p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../template/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>