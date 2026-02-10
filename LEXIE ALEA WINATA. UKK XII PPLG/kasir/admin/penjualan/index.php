<?php 
session_start();
include '../../main/connect.php';

// Proteksi Halaman
if($_SESSION['status'] != "login") header("location:../../auth/login.php");
if($_SESSION['role'] != 'admin') header("location:../../petugas/dashboard/index.php");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penjualan</title>
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
        .page-header {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(45, 106, 79, 0.15);
        }

        .page-header h1 {
            font-weight: 600;
            font-size: 1.75rem;
            margin: 0;
        }

        .page-header .breadcrumb {
            background: transparent;
            margin: 0;
            padding: 0;
            margin-top: 0.5rem;
        }

        .page-header .breadcrumb-item {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.875rem;
        }

        .page-header .breadcrumb-item.active {
            color: white;
        }

        .page-header .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Filter Card */
        .filter-card {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .filter-card .card-body {
            padding: 1.5rem;
        }

        .filter-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #e9ecef;
            padding: 0.65rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #2d6a4f;
            box-shadow: 0 0 0 0.2rem rgba(45, 106, 79, 0.1);
        }

        /* Buttons */
        .btn-filter {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.65rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 106, 79, 0.3);
            color: white;
        }

        .btn-reset {
            background: #f8f9fa;
            color: #495057;
            border: 1.5px solid #dee2e6;
            border-radius: 10px;
            padding: 0.65rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-reset:hover {
            background: #e9ecef;
            border-color: #adb5bd;
            transform: translateY(-2px);
        }

        .btn-print {
            background: #1b4332;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-print:hover {
            background: #2d6a4f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(27, 67, 50, 0.3);
        }

        /* Alert Info */
        .info-banner {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            color: #1565c0;
            font-size: 0.9rem;
        }

        .info-banner i {
            font-size: 1.1rem;
        }

        /* Main Card */
        .main-card {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .main-card .card-header {
            background: white;
            border-bottom: 1px solid #f1f3f5;
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: #212529;
        }

        /* Table Styling */
        .transaction-table {
            margin: 0;
        }

        .transaction-table thead {
            background: #f8f9fa;
        }

        .transaction-table thead th {
            border: none;
            padding: 1rem 1.25rem;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
        }

        .transaction-table tbody td {
            padding: 1.1rem 1.25rem;
            vertical-align: middle;
            border-color: #f1f3f5;
            font-size: 0.9rem;
        }

        .transaction-table tbody tr {
            transition: all 0.2s ease;
        }

        .transaction-table tbody tr:hover {
            background: rgba(45, 106, 79, 0.03);
        }

        /* Badge Styling */
        .badge-nota {
            background: linear-gradient(135deg, #568f64 0%, #339c52 100%);
            padding: 0.5rem 0.85rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .customer-name {
            font-weight: 600;
            color: #212529;
            font-size: 0.9rem;
        }

        .transaction-date {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .total-amount {
            font-weight: 700;
            color: #2d6a4f;
            font-size: 1rem;
        }

        /* Action Buttons */
        .btn-action {
            padding: 0.45rem 0.85rem;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-detail {
            background: #35553f;
            color: white;
        }

        .btn-detail:hover {
            background: #3d7a8a;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(74, 144, 164, 0.3);
            color: white;
        }

        .btn-delete {
            background: #d62828;
            color: white;
        }

        .btn-delete:hover {
            background: #c1121f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(214, 40, 40, 0.3);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.2;
            color: #2d6a4f;
        }

        .empty-state h5 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #495057;
        }

        .empty-state p {
            margin: 0;
            font-size: 0.95rem;
        }

        /* Print Styles */
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .main-card { box-shadow: none; }
            .page-header { 
                background: #2d6a4f !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .transaction-table {
                font-size: 0.85rem;
            }
            
            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex">
        <div class="no-print">
            <?php include '../../template/sidebar.php'; ?>
        </div>
        
        <div class="container-fluid p-0">
            <!-- Page Header -->
            <div class="page-header no-print">
                <div class="container-fluid px-4">
                    <h1><i class="fas fa-chart-bar me-3"></i>Riwayat Penjualan</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><i class="fas fa-home me-2"></i>Dashboard</li>
                            <li class="breadcrumb-item active">Laporan</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="container-fluid px-4 pb-4">
                <!-- Filter Card -->
                <div class="card filter-card no-print">
                    <div class="card-body">
                        <form method="GET" class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label class="filter-label">
                                    <i class="fas fa-calendar-alt me-1"></i> Tanggal Mulai
                                </label>
                                <input type="date" name="tgl_mulai" class="form-control" value="<?= $_GET['tgl_mulai'] ?? ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="filter-label">
                                    <i class="fas fa-calendar-check me-1"></i> Tanggal Selesai
                                </label>
                                <input type="date" name="tgl_selesai" class="form-control" value="<?= $_GET['tgl_selesai'] ?? ''; ?>" required>
                            </div>
                            <div class="col-md-4 d-flex gap-2">
                                <button type="submit" class="btn btn-filter flex-grow-1">
                                    <i class="fas fa-filter me-2"></i> Tampilkan Data
                                </button>
                                <a href="index.php" class="btn btn-reset">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <?php 
                $tgl_mulai = $_GET['tgl_mulai'] ?? '';
                $tgl_selesai = $_GET['tgl_selesai'] ?? '';

                if ($tgl_mulai != '' && $tgl_selesai != '') {
                    $query_str = "SELECT * FROM penjualan 
                                  JOIN pelanggan ON penjualan.PelangganID = pelanggan.PelangganID 
                                  WHERE TanggalPenjualan BETWEEN '$tgl_mulai 00:00:00' AND '$tgl_selesai 23:59:59'
                                  ORDER BY PenjualanID DESC";
                    
                    echo "<div class='info-banner no-print'>
                            <i class='fas fa-info-circle me-2'></i>
                            Menampilkan transaksi dari <strong>".date('d M Y', strtotime($tgl_mulai))."</strong> sampai <strong>".date('d M Y', strtotime($tgl_selesai))."</strong>
                          </div>";
                } else {
                    $query_str = "SELECT * FROM penjualan 
                                  JOIN pelanggan ON penjualan.PelangganID = pelanggan.PelangganID 
                                  ORDER BY PenjualanID DESC";
                }
                $sql = mysqli_query($conn, $query_str);
                ?>

                <!-- Main Card -->
                <div class="card main-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">
                            <i class="fas fa-receipt me-2 text-success"></i>
                            Riwayat Transaksi
                        </h5>
                        <?php if(isset($_GET['tgl_mulai'])): ?>
                            <button onclick="window.print()" class="btn btn-print no-print">
                                <i class="fas fa-print me-2"></i> Cetak Laporan
                            </button>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table transaction-table mb-0">
                                <thead>
                                    <tr>
                                        <th>No. Nota</th>
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th class="text-end">Total Bayar</th>
                                        <th class="text-center no-print">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(mysqli_num_rows($sql) == 0){
                                        echo "<tr><td colspan='5' class='p-0'>
                                                <div class='empty-state'>
                                                    <i class='fas fa-folder-open'></i>
                                                    <h5>Tidak Ada Transaksi</h5>
                                                    <p>Belum ada data transaksi pada periode ini</p>
                                                </div>
                                              </td></tr>";
                                    }

                                    while($d = mysqli_fetch_array($sql)){
                                    ?>
                                    <tr>
                                        <td><span class="badge badge-nota">#<?= $d['PenjualanID']; ?></span></td>
                                        <td>
                                            <div class="transaction-date">
                                                <i class="far fa-calendar me-1"></i><?= date('d/m/Y', strtotime($d['TanggalPenjualan'])); ?>
                                            </div>
                                           
                                            
                                        </td>
                                        <td>
                                            <div class="customer-name"><?= $d['NamaPelanggan']; ?></div>
                                        </td>
                                        <td class="text-end">
                                            <span class="total-amount">Rp <?= number_format($d['TotalHarga'], 0, ',', '.'); ?></span>
                                        </td>
                                        <td class="text-center no-print">
                                            <div class="btn-group gap-1">
                                                <a href="detail.php?id=<?= $d['PenjualanID']; ?>" class="btn btn-action btn-detail" title="Detail">
                                                    <i class="fas fa-eye me-1"></i> Detail
                                                </a>
                                                <a href="hapus.php?id=<?= $d['PenjualanID']; ?>" 
                                                   class="btn btn-action btn-delete" 
                                                   onclick="return confirm('Menghapus transaksi akan mengembalikan stok produk. Yakin ingin menghapus?')" 
                                                   title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
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
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>