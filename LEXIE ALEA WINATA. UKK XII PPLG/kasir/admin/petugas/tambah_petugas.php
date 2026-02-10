<?php 
session_start();
include '../../main/connect.php';
if($_SESSION['status'] != "login") header("location:../../auth/login.php");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <div class="d-flex">
        <?php include '../../template/sidebar.php'; ?>
        <div class="container-fluid p-4">
            <div class="col-md-5 mx-auto">
                <div class="card shadow border-0 mt-5">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4 text-center">Registrasi Petugas</h5>
                        <form action="proses_tambah.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="Username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="Password" class="form-control" placeholder="Password..." required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Role</label>
                                <select name="Role" class="form-select" required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success fw-bold p-2 shadow">Daftarkan Akun</button>
                                <a href="index.php" class="btn btn-dark">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>