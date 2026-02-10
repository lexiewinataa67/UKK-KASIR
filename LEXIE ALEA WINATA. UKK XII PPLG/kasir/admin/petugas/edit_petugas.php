<?php 
session_start();
include '../../main/connect.php';
if($_SESSION['status'] != "login") header("location:../../auth/login.php");

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM user WHERE UserID='$id'");
$d = mysqli_fetch_array($data);

// Proses Update
if(isset($_POST['update'])){
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    if(empty($password)){
        // Jika password kosong, jangan update password-nya
        mysqli_query($conn, "UPDATE user SET Username='$username', Role='$role' WHERE UserID='$id'");
    } else {
        // Jika password diisi, update juga password-nya (MD5 atau plaintext sesuai sistemmu)
        mysqli_query($conn, "UPDATE user SET Username='$username', Role='$role', Password='$password' WHERE UserID='$id'");
    }
    header("location:index.php?pesan=update_sukses");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="d-flex">
        <?php include '../../template/sidebar.php'; ?>
        <div class="container-fluid p-4">
            <div class="card shadow border-0" style="max-width: 500px;">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold m-0 text-success"><i class="fas fa-user-edit me-2"></i>Edit Data User</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= $d['Username']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select">
                                <option value="admin" <?= $d['Role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                <option value="petugas" <?= $d['Role'] == 'petugas' ? 'selected' : ''; ?>>Petugas</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Ganti Password <small class="text-danger">(Kosongkan jika tidak ingin ganti)</small></label>
                            <input type="password" name="password" class="form-control" placeholder="Password baru...">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" name="update" class="btn btn-success px-4 rounded-pill">Simpan</button>
                            <a href="index.php" class="btn btn-light px-4 rounded-pill">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>