<?php 
session_start();
include '../../main/connect.php';
if($_SESSION['status'] != "login") header("location:../../auth/login.php");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laman Manajemen User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

        .stat-icon.admin {
            background: linear-gradient(135deg, #d62828 0%, #c1121f 100%);
            color: white;
        }

        .stat-icon.petugas {
            background: linear-gradient(135deg, #4a90a4 0%, #3d7a8a 100%);
            color: white;
        }

        .stat-icon.total {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
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

        /* Button Add User */
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
        .user-table {
            margin: 0;
        }

        .user-table thead {
            background: #f8f9fa;
        }

        .user-table thead th {
            border: none;
            padding: 1rem 1.25rem;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
        }

        .user-table tbody td {
            padding: 1.1rem 1.25rem;
            vertical-align: middle;
            border-color: #f1f3f5;
            font-size: 0.9rem;
        }

        .user-table tbody tr {
            transition: all 0.2s ease;
        }

        .user-table tbody tr:hover {
            background: rgba(45, 106, 79, 0.03);
            transform: translateX(4px);
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

        /* Username Display */
        .username {
            font-weight: 600;
            color: #212529;
        }

        .username i {
            color: #2d6a4f;
            margin-right: 0.5rem;
        }

        /* Role Badges */
        .role-badge {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .role-admin {
            background: linear-gradient(135deg, #d62828 0%, #c1121f 100%);
            color: white;
        }

        .role-petugas {
            background: linear-gradient(135deg, #4a90a4 0%, #3d7a8a 100%);
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
            background: #407253;
            color: white;
        }

        .btn-edit:hover {
            background: #114d25;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(244, 162, 97, 0.3);
            color: white;
        }

        .btn-delete {
            background: #196432;
            color: white;
        }

        .btn-delete:hover {
            background: #7fd186;
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

        /* SweetAlert Custom */
        .swal2-confirm {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%) !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .user-table {
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
                    <h1><i class="fas fa-users-cog me-3"></i>Manajemen User</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><i class="fas fa-home me-2"></i>Dashboard</li>
                            <li class="breadcrumb-item active">Registrasi User</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="container-fluid px-4 pb-4">
                <!-- Stats Card -->
                <?php 
                $query_all = mysqli_query($conn, "SELECT * FROM user");
                $total_user = mysqli_num_rows($query_all);
                
                $query_admin = mysqli_query($conn, "SELECT * FROM user WHERE Role = 'admin'");
                $total_admin = mysqli_num_rows($query_admin);
                
                $query_petugas = mysqli_query($conn, "SELECT * FROM user WHERE Role = 'petugas'");
                $total_petugas = mysqli_num_rows($query_petugas);
                ?>
                
                <div class="stats-card">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-icon total">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-content">
                                    <h3><?= $total_user; ?></h3>
                                    <p>Total User</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-icon admin">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <div class="stat-content">
                                    <h3><?= $total_admin; ?></h3>
                                    <p>Administrator</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-icon petugas">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="stat-content">
                                    <h3><?= $total_petugas; ?></h3>
                                    <p>Petugas</p>
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
                            Daftar Pengguna
                        </h5>
                        <a href="tambah_petugas.php" class="btn btn-add">
                            <i class="fas fa-user-plus me-2"></i> Tambah User
                        </a>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table user-table mb-0">
                                <thead>
                                    <tr>
                                        <th width="8%">No</th>
                                        <th>Username</th>
                                        <th>Role / Hak Akses</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    $query = mysqli_query($conn, "SELECT * FROM user ORDER BY Role DESC, Username ASC");
                                    
                                    if(mysqli_num_rows($query) == 0){
                                        echo "<tr><td colspan='4' class='p-0'>
                                                <div class='empty-state'>
                                                    <i class='fas fa-user-slash'></i>
                                                    <h5>Belum Ada User</h5>
                                                    <p>Silakan tambahkan user baru untuk memulai</p>
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
                                            <div class="username">
                                                <i class="fas fa-user-circle"></i>
                                                <?= $d['Username']; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="role-badge <?= $d['Role'] == 'admin' ? 'role-admin' : 'role-petugas'; ?>">
                                                <i class="fas <?= $d['Role'] == 'admin' ? 'fa-crown' : 'fa-user'; ?> me-1"></i>
                                                <?= $d['Role']; ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group gap-1">
                                                <a href="edit_petugas.php?id=<?= $d['UserID']; ?>" class="btn btn-action btn-edit" title="Edit">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                                <button onclick="confirmDelete(<?= $d['UserID']; ?>)" class="btn btn-action btn-delete" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
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
    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus User?',
            text: "User ini tidak akan bisa login lagi setelah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d62828',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "hapus.php?id=" + id;
            }
        })
    }
    </script>

    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses'): ?>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'User baru telah berhasil didaftarkan',
            icon: 'success',
            confirmButtonColor: '#2d6a4f'
        });
    </script>
    <?php endif; ?>

    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'hapus_sukses'): ?>
    <script>
        Swal.fire({
            title: 'Terhapus!',
            text: 'User telah dihapus dari sistem',
            icon: 'success',
            confirmButtonColor: '#2d6a4f'
        });
    </script>
    <?php endif; ?>
</body>
</html>