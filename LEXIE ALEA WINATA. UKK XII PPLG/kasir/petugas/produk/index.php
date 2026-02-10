<?php 
session_start();
include '../../main/connect.php';
// Cek login
if($_SESSION['status'] != "login") header("location:../../auth/login.php");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laman Data Produk</title>
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

        /* Page Header */
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

        /* Stats Card */
        .stats-card {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            background: rgba(45, 106, 79, 0.05);
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            color: white;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #4a90a4 0%, #3d7a8a 100%);
            color: white;
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #f4a261 0%, #e76f51 100%);
            color: white;
        }

        .stat-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: #212529;
        }

        .stat-content p {
            font-size: 0.8rem;
            color: #6c757d;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
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

        /* Button Add Product */
        .btn-add {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.7rem 1.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(45, 106, 79, 0.3);
            color: white;
        }

        /* Table Styling */
        .product-table {
            margin: 0;
        }

        .product-table thead {
            background: #f8f9fa;
        }

        .product-table thead th {
            border: none;
            padding: 1rem 1.25rem;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
        }

        .product-table tbody td {
            padding: 1.1rem 1.25rem;
            vertical-align: middle;
            border-color: #f1f3f5;
            font-size: 0.9rem;
        }

        .product-table tbody tr {
            transition: all 0.2s ease;
        }

        .product-table tbody tr:hover {
            background: rgba(45, 106, 79, 0.03);
            transform: translateX(4px);
        }

        .product-table tfoot {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-top: 2px solid #2d6a4f;
        }

        .product-table tfoot th {
            padding: 1.25rem;
            font-weight: 600;
        }

        /* Product Name */
        .product-name {
            font-weight: 600;
            color: #212529;
        }

        /* Price */
        .product-price {
            color: #2d6a4f;
            font-weight: 600;
        }

        /* Stock Badge */
        .badge-stock {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            min-width: 60px;
            display: inline-block;
        }

        .badge-low {
            background: linear-gradient(135deg, #d62828 0%, #c1121f 100%);
            color: white;
        }

        .badge-good {
            background: linear-gradient(135deg, #52b788 0%, #40916c 100%);
            color: white;
        }

        /* Action Buttons */
        .btn-action {
            padding: 0.5rem 0.9rem;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-edit {
            background: #6eb37d;
            color: white;
        }

        .btn-edit:hover {
            background: #e76f51;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(244, 162, 97, 0.3);
            color: white;
        }

        .btn-delete {
            background:     #549c72;
            color: white;
        }

        .btn-delete:hover {
            background: #03642b;
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

        /* Number Badge */
        .number-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: #f8f9fa;
            border-radius: 8px;
            font-weight: 600;
            color: #6c757d;
            font-size: 0.85rem;
        }

        /* Total Asset Highlight */
        .total-asset {
            font-size: 1.5rem;
            color: #2d6a4f;
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .product-table {
                font-size: 0.85rem;
            }
            
            .stat-item {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex">
        <?php include '../../template/sidebar.php'; ?>

        <div class="container-fluid p-0">
            <!-- Page Header -->
            <div class="page-header">
                <div class="container-fluid px-4">
                    <h1><i class="fas fa-boxes me-3"></i>Manajemen Produk</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><i class="fas fa-home me-2"></i>Dashboard</li>
                            <li class="breadcrumb-item active">Data Produk</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="container-fluid px-4 pb-4">
                <!-- Stats Card -->
                <?php 
                $query_all = mysqli_query($conn, "SELECT * FROM produk");
                $total_produk = mysqli_num_rows($query_all);
                
                $query_low = mysqli_query($conn, "SELECT * FROM produk WHERE Stok < 10");
                $stok_rendah = mysqli_num_rows($query_low);
                
                $total_aset = 0;
                mysqli_data_seek($query_all, 0); // Reset pointer
                while($p = mysqli_fetch_array($query_all)){
                    $total_aset += ($p['Harga'] * $p['Stok']);
                }
                ?>
                
                <div class="stats-card">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-icon green">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="stat-content">
                                    <h3><?= $total_produk; ?></h3>
                                    <p>Total Produk</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-icon orange">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="stat-content">
                                    <h3><?= $stok_rendah; ?></h3>
                                    <p>Stok Rendah</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-icon blue">
                                    <i class="fas fa-coins"></i>
                                </div>
                                <div class="stat-content">
                                    <h3>Rp <?= number_format($total_aset, 0, ',', '.'); ?></h3>
                                    <p>Total Nilai Aset</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Card -->
                <div class="card main-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">
                            <i class="fas fa-list me-2 text-success"></i>
                            Daftar Produk
                        </h5>
                        <a href="tambah.php" class="btn btn-add">
                            <i class="fas fa-plus-circle me-2"></i> Tambah Produk
                        </a>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table product-table mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Jual</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY NamaProduk ASC");
                                    
                                    if(mysqli_num_rows($query) == 0){
                                        echo "<tr><td colspan='5' class='p-0'>
                                                <div class='empty-state'>
                                                    <i class='fas fa-box-open'></i>
                                                    <h5>Belum Ada Produk</h5>
                                                    <p>Silakan tambahkan produk baru untuk memulai</p>
                                                </div>
                                              </td></tr>";
                                    }

                                    while($d = mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="number-badge"><?= $no++; ?></span>
                                        </td>
                                        <td>
                                            <div class="product-name"><?= $d['NamaProduk']; ?></div>
                                        </td>
                                        <td>
                                            <span class="product-price">Rp <?= number_format($d['Harga'], 0, ',', '.'); ?></span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-stock <?= $d['Stok'] < 10 ? 'badge-low' : 'badge-good'; ?>">
                                                <i class="fas fa-box me-1"></i><?= $d['Stok']; ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group gap-1">
                                                <a href="edit.php?id=<?= $d['ProdukID']; ?>" class="btn btn-action btn-edit" title="Edit">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                                <a href="hapus.php?id=<?= $d['ProdukID']; ?>" 
                                                   class="btn btn-action btn-delete" 
                                                   title="Hapus" 
                                                   onclick="return confirm('Menghapus produk akan berpengaruh pada data transaksi. Yakin ingin menghapus?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <?php if(mysqli_num_rows($query) > 0): ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-end">
                                            <i class="fas fa-calculator me-2"></i>Total Nilai Inventaris:
                                        </th>
                                        <th colspan="3">
                                            <span class="total-asset">Rp <?= number_format($total_aset, 0, ',', '.'); ?></span>
                                        </th>
                                    </tr>
                                </tfoot>
                                <?php endif; ?>
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