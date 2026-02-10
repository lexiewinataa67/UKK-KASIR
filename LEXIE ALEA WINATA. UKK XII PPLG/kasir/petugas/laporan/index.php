<?php 
session_start();
include '../../main/connect.php';
if($_SESSION['status'] != "login") header("location:../../auth/login.php");

// Logika Filter Tanggal
$tgl_mulai = isset($_GET['tgl_mulai']) ? $_GET['tgl_mulai'] : '';
$tgl_selesai = isset($_GET['tgl_selesai']) ? $_GET['tgl_selesai'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan - Kasir Lexie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        .card-report { border-radius: 12px; border: none; }
        @media print {
            .no-print, .sidebar { display: none !important; }
            .container-fluid { width: 100%; padding: 0; }
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex">
        <div class="no-print">
            <?php include '../../template/sidebar.php'; ?>
        </div>
        
        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 no-print">
                <h3 class="fw-bold"><i class="fas fa-file-alt me-2 text-success"></i>Laporan Transaksi</h3>
                <button class="btn btn-dark fw-bold btn-print" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Cetak Laporan
                </button>
            </div>

            <div class="card shadow-sm mb-4 no-print border-0" style="border-radius: 15px;">
                <div class="card-body">
                    <form method="GET" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">DARI TANGGAL</label>
                            <input type="date" name="tgl_mulai" class="form-control" value="<?= $tgl_mulai ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">SAMPAI TANGGAL</label>
                            <input type="date" name="tgl_selesai" class="form-control" value="<?= $tgl_selesai ?>">
                        </div>
                        <div class="col-md-6 d-flex gap-2">
                            <button type="submit" class="btn btn-success flex-grow-1 fw-bold">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <a href="index.php" class="btn btn-outline-secondary px-4 fw-bold">
                                <i class="fas fa-sync-alt me-2"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <?php 
            $where = "";
            if($tgl_mulai != '' && $tgl_selesai != '') {
                $where = " WHERE TanggalPenjualan BETWEEN '$tgl_mulai 00:00:00' AND '$tgl_selesai 23:59:59'";
            }
            $summary = mysqli_query($conn, "SELECT SUM(TotalHarga) as total, COUNT(*) as jml FROM penjualan $where");
            $ds = mysqli_fetch_assoc($summary);
            ?>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card card-report shadow-sm p-3 bg-white border-start border-success border-5">
                        <small class="text-muted fw-bold">OMSET PERIODE INI</small>
                        <h2 class="fw-bold text-success">Rp <?= number_format($ds['total'] ?? 0); ?></h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-report shadow-sm p-3 bg-white border-start border-success border-5">
                        <small class="text-muted fw-bold">TOTAL TRANSAKSI</small>
                        <h2 class="fw-bold text-success"><?= $ds['jml']; ?> Transaksi</h2>
                    </div>
                </div>
            </div>

            <div class="card card-report shadow-sm">
                <div class="card-body">
                    <div class="text-center mb-4 d-none d-print-block">
                        <h2 class="fw-bold">LAPORAN PENJUALAN KASIR LEXIE</h2>
                        <p>Tanggal Cetak: <?= date('d-m-Y'); ?></p>
                        <hr>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Pelanggan</th>
                                    <th class="text-end">Total Bayar</th>
                                    <th class="no-print text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT * FROM penjualan JOIN pelanggan ON penjualan.PelangganID = pelanggan.PelangganID $where ORDER BY TanggalPenjualan DESC");
                                while($d = mysqli_fetch_array($query)){
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= date('d/m/Y', strtotime($d['TanggalPenjualan'])); ?></td>
                                    <td><span class="fw-bold text-uppercase"><?= $d['NamaPelanggan']; ?></span></td>
                                    <td class="fw-bold text-end text-success">Rp <?= number_format($d['TotalHarga']); ?></td>
                                    <td class="no-print text-center">
                                       <a href="/kasir/petugas/laporan/detail.php?id=<?= $d['PenjualanID']; ?>" 
   class="btn btn-sm btn-light border rounded-pill px-3 shadow-sm">
                                            <i class="fas fa-eye me-1 text-primary"></i> Detail
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
    </div>
</body>
</html>