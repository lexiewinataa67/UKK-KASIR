<?php 
session_start();
include '../../main/connect.php';

// Pastikan yang masuk adalah Petugas
if($_SESSION['status'] != "login") header("location:../../auth/login.php");
if($_SESSION['role'] != 'petugas') {
    header("location:../../admin/dashboard/index.php");
}

$username = $_SESSION['username'];
$tgl_hari_ini = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card-stats { border: none; border-radius: 15px; transition: 0.3s; }
        .card-stats:hover { transform: translateY(-5px); }
        .welcome-box { background: linear-gradient(45deg, #2d6a4f, #1b4332); color: white; border-radius: 15px; }
        .icon-box { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex">
        <?php include '../../template/sidebar.php'; ?>
        
        <div class="container-fluid p-4">
            <div class="welcome-box p-5 mb-4 shadow">
                <h2 class="fw-bold">Semangat <?= strtoupper($username); ?>!</h2>
                <p class="mb-0"></p>Gas Terus Bos, Liat Stok Barang Juga
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card card-stats shadow-sm bg-white p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-success text-white rounded-circle me-3">
                                <i class="fas fa-shopping-basket fa-2x"></i>
                            </div>
                            <div>
                                <small class="text-muted fw-bold">TRANSAKSI SAYA HARI INI</small>
                                <?php 
                                // Menggunakan LIKE agar data 00:00 dan data dengan Jam tetap terhitung di hari yang sama
                                $query_trx = mysqli_query($conn, "SELECT COUNT(*) as total FROM penjualan WHERE TanggalPenjualan LIKE '$tgl_hari_ini%'");
                                $data_trx = mysqli_fetch_assoc($query_trx);
                                ?>
                                <h3 class="fw-bold mb-0"><?= $data_trx['total']; ?> Nota</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card card-stats shadow-sm border-0 rounded-4 p-3 bg-white">
                        <small class="text-muted fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 11px;">
                             Total Penjualan
                        </small>
    
    <?php 
        date_default_timezone_set('Asia/Jakarta');
        $tgl_sekarang = date('Y-m-d');

        // 1. Query Total Seluruh Waktu
        $query_total = mysqli_query($conn, "SELECT SUM(TotalHarga) as total_all FROM penjualan");
        $data_total = mysqli_fetch_assoc($query_total);
        $total_all = $data_total['total_all'] ?? 0;

        // 2. Query Khusus Hari Ini
        $query_harian = mysqli_query($conn, "SELECT SUM(TotalHarga) as total_hari FROM penjualan WHERE TanggalPenjualan LIKE '$tgl_sekarang%'");
        $data_harian = mysqli_fetch_assoc($query_harian);
        $total_hari = $data_harian['total_hari'] ?? 0;
    ?>

    <h3 class="fw-bold text-dark mb-1">
        Rp <?= number_format($total_all, 0, ',', '.'); ?>
    </h3>

    <div class="d-flex align-items-center mt-2">
        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1" style="font-size: 11px;">
            <i class="fas fa-chart-line me-1"></i>
            Hari ini: Rp <?= number_format($total_hari, 0, ',', '.'); ?>
        </span>
    </div>
</div>
            </div>

            <div class="card border-0 shadow-sm mt-2">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold m-0"><i class="fas fa-history me-2"></i>Transaksi Terakhir</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Total Bayar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $log = mysqli_query($conn, "SELECT * FROM penjualan 
                                   JOIN pelanggan ON penjualan.PelangganID = pelanggan.PelangganID 
                                   ORDER BY PenjualanID DESC LIMIT 5");
                            while($l = mysqli_fetch_array($log)){
                            ?>
                            <tr>
                                <td><?= date('d-m-Y', strtotime($l['TanggalPenjualan'])); ?></td>
                                <td><?= $l['NamaPelanggan']; ?></td>
                                <td class="fw-bold">Rp <?= number_format($l['TotalHarga']); ?></td>
                                <td class="text-center">
                                    <a href="../dashboard/detail.php?id=<?= $l['PenjualanID']; ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>