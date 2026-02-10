<?php 
session_start();
include '../../main/connect.php';
if($_SESSION['status'] != "login") header("location:../../auth/login.php");

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM produk WHERE ProdukID='$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - Kasir Lexie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .btn-update { transition: all 0.3s; border-radius: 10px; }
        .btn-update:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgb(39, 48, 28); }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex">
        <?php include '../../template/sidebar.php'; ?>
        <div class="container-fluid p-4">
            <div class="col-md-6 mx-auto">
                <div class="card shadow border-0">
                    <div class="card-header bg-white py-3 text-dark">
                        <h5 class="fw-bold m-0"><i class="fas fa-edit me-2"></i>Edit Produk</h5>
                    </div>
                    <div class="card-body p-4">
                        <form id="formEdit" action="proses_edit.php" method="POST">
                            <input type="hidden" name="ProdukID" value="<?= $d['ProdukID']; ?>">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Produk</label>
                                <input type="text" name="NamaProduk" class="form-control" value="<?= $d['NamaProduk']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Harga (Rp)</label>
                                <input type="number" name="Harga" class="form-control" value="<?= $d['Harga']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Stok</label>
                                <input type="number" name="Stok" class="form-control" value="<?= $d['Stok']; ?>" required>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="button" onclick="confirmEdit()" class="btn btn-dark text-white fw-bold btn-update">Update Produk</button>
                                <a href="index.php" class="btn btn-light">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmEdit() {
        Swal.fire({
            title: 'Update data?',
            text: "Data produk akan segera diperbarui",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4eb85f',
            confirmButtonText: 'Ya, Update!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formEdit').submit();
            }
        })
    }
    </script>
</body>
</html>