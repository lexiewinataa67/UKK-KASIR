<?php 
session_start();
include '../../main/connect.php';
// Proteksi halaman
if($_SESSION['status'] != "login") header("location:../../auth/login.php");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laman Tambah Produk</title>
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

        .page-header .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .page-header .breadcrumb-item a:hover {
            color: white;
        }

        .page-header .breadcrumb-item {
            font-size: 0.875rem;
        }

        .page-header .breadcrumb-item.active {
            color: white;
        }

        .page-header .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .form-card .card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 2px solid #2d6a4f;
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: #212529;
        }

        .card-title i {
            color: #2d6a4f;
        }

        /* Form Elements */
        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label i {
            color: #2d6a4f;
            margin-right: 0.5rem;
        }

        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e9ecef;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2d6a4f;
            box-shadow: 0 0 0 0.2rem rgba(45, 106, 79, 0.1);
        }

        .form-control::placeholder {
            color: #adb5bd;
            font-style: italic;
        }

        /* Input Group */
        .input-group {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            border-radius: 10px;
            overflow: hidden;
        }

        .input-group-text {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            color: white;
            border: none;
            font-weight: 600;
            padding: 0.75rem 1.25rem;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
            border-left: none; 
        }

        /* Form Text */
        .form-text {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }

        .form-text i {
            color: #2d6a4f;
            margin-right: 0.25rem;
        }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-left: 4px solid #4a90a4;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        .info-box i {
            color: #4a90a4;
            font-size: 1.25rem;
            margin-right: 0.75rem;
        }

        .info-box p {
            margin: 0;
            color: #1565c0;
            font-size: 0.9rem;
        }

        /* Buttons */
        .btn-save {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.85rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(45, 106, 79, 0.3);
            color: white;
        }

        .btn-save:active {
            transform: translateY(-1px);
        }

        .btn-cancel {
            background: white;
            color: #6c757d;
            border: 1.5px solid #dee2e6;
            border-radius: 12px;
            padding: 0.85rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
            color: #495057;
            transform: translateY(-2px);
        }

        /* Form Section */
        .form-section {
            padding: 2rem;
        }

        .form-divider {
            border: none;
            height: 1px;
            background: linear-gradient(to right, transparent, #dee2e6, transparent);
            margin: 2rem 0;
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
            
            .form-section {
                padding: 1.5rem;
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
                    <h1><i class="fas fa-plus-square me-3"></i>Tambah Produk</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><i class="fas fa-home me-2"></i>Dashboard</li>
                            <li class="breadcrumb-item"><a href="index.php">Data Produk</a></li>
                            <li class="breadcrumb-item active">Tambah Produk</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="container-fluid px-4 pb-4">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-xl-6">
                        <!-- Info Box -->
                        <div class="info-box">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle"></i>
                                <p><strong>eh sebentar dulu:</strong> pastiin dulu barangnya benar gak sbelum masukin ke sistem.</p>
                            </div>
                        </div>

                        <!-- Form Card -->
                        <div class="card form-card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <i class="fas fa-box me-2"></i>
                                    form produk baru
                                </h5>
                            </div>
                            <div class="form-section">
                                <form id="formTambah" action="proses_tambah.php" method="POST">
                                    <div class="mb-4">
                                        <label class="form-label">
                                            <i class="fas fa-tag"></i> Nama Produk
                                        </label>
                                        <input type="text" 
                                               name="NamaProduk" 
                                               class="form-control" 
                                               placeholder="Contoh: Ninja RR" 
                                               required>
                                        <div class="form-text">
                                            <i class="fas fa-lightbulb"></i> Masukkan nama produk yang jelas dan mudah dikenali
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">
                                            <i class="fas fa-money-bill-wave"></i> Harga Jual
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" 
                                                   name="Harga" 
                                                   class="form-control" 
                                                   placeholder="0" 
                                                   min="0" 
                                                   required>
                                        </div>
                                        <div class="form-text">
                                            <i class="fas fa-exclamation-circle"></i> Harga tidak boleh negatif
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">
                                            <i class="fas fa-boxes"></i> Stok Awal
                                        </label>
                                        <input type="number" 
                                               name="Stok" 
                                               class="form-control" 
                                               placeholder="0" 
                                               min="0" 
                                               required>
                                        <div class="form-text">
                                            <i class="fas fa-info-circle"></i> Jumlah unit produk yang tersedia saat ini
                                        </div>
                                    </div>

                                    <hr class="form-divider">

                                    <div class="d-grid gap-2">
                                        <button type="button" 
                                                onclick="confirmAdd()" 
                                                class="btn btn-save">
                                            <i class="fas fa-save me-2"></i>Simpan Produk
                                        </button>
                                        <a href="index.php" class="btn btn-cancel">
                                            <i class="fas fa-arrow-left me-2"></i>Batal & Kembali
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function confirmAdd() {
        const form = document.getElementById('formTambah');
        const nama = form.NamaProduk.value.trim();
        const harga = form.Harga.value;
        const stok = form.Stok.value;

        // Validasi data lengkap
        if(!nama || !harga || !stok) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Harap isi semua kolom sebelum menyimpan!',
                confirmButtonColor: '#2d6a4f'
            });
            return;
        }

        // Validasi nilai negatif
        if(harga < 0 || stok < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Input Tidak Valid',
                text: 'Harga dan Stok tidak boleh bernilai negatif!',
                confirmButtonColor: '#d62828'
            });
            return;
        }

        // Konfirmasi penyimpanan
        Swal.fire({
            title: 'Simpan Produk?',
            html: `
                <div style="text-align: left; padding: 1rem;">
                    <p style="margin-bottom: 0.5rem;"><strong>Nama:</strong> ${nama}</p>
                    <p style="margin-bottom: 0.5rem;"><strong>Harga:</strong> Rp ${parseInt(harga).toLocaleString('id-ID')}</p>
                    <p style="margin-bottom: 0;"><strong>Stok:</strong> ${stok} unit</p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2d6a4f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-check me-2"></i>Ya, Simpan!',
            cancelButtonText: '<i class="fas fa-times me-2"></i>Cek Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan loading
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                form.submit();
            }
        })
    }

    // Format harga saat mengetik
    document.querySelector('input[name="Harga"]').addEventListener('input', function(e) {
        if(this.value < 0) this.value = 0;
    });

    // Format stok saat mengetik
    document.querySelector('input[name="Stok"]').addEventListener('input', function(e) {
        if(this.value < 0) this.value = 0;
    });
    </script>
</body>
</html>