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
    <title>Transaksi Penjualan - Kasir Aduy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            padding: 1.5rem 0;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 20px rgba(45, 106, 79, 0.15);
        }

        .page-header h1 {
            font-weight: 600;
            font-size: 1.5rem;
            margin: 0;
        }

        /* Product Grid */
        .product-grid-card {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            margin-bottom: 1.5rem;
        }

        .product-grid-card .card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 2px solid #2d6a4f;
            padding: 1.25rem 1.5rem;
            border-radius: 16px 16px 0 0;
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 600;
            margin: 0;
            color: #212529;
        }

        .card-title i {
            color: #2d6a4f;
        }

        /* Product Items */
        .product-item {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 1.25rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .product-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .product-item:hover {
            border-color: #2d6a4f;
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(45, 106, 79, 0.15);
        }

        .product-item:hover::before {
            transform: scaleX(1);
        }

        .product-item:active {
            transform: translateY(-4px);
        }

        .product-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.5rem;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2d6a4f;
            margin-bottom: 0.5rem;
        }

        .stock-badge {
            display: inline-block;
            background: #f8f9fa;
            padding: 0.35rem 0.75rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #6c757d;
        }

        .stock-badge i {
            color: #2d6a4f;
        }

        /* Cart Card */
        .cart-card {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 20px;
        }

        .cart-card .card-header {
            background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            border-radius: 16px 16px 0 0;
        }

        .cart-card .card-header h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1.15rem;
        }

        /* Form Elements */
        .form-label-custom {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .form-label-custom i {
            color: #2d6a4f;
            margin-right: 0.25rem;
        }

        .form-control-custom {
            border: 1.5px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: #2d6a4f;
            box-shadow: 0 0 0 0.2rem rgba(45, 106, 79, 0.1);
        }

        /* Cart Table */
        .cart-table {
            margin: 1.5rem 0;
        }

        .cart-table thead th {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-bottom: 2px solid #e9ecef;
            padding: 0.75rem 0.5rem;
        }

        .cart-table tbody td {
            padding: 0.75rem 0.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f5;
        }

        .cart-item-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #212529;
        }

        .qty-input {
            width: 60px;
            text-align: center;
            font-weight: 600;
            border: 1.5px solid #e9ecef;
            border-radius: 6px;
            padding: 0.35rem;
        }

        .btn-remove {
            color: #d62828;
            background: none;
            border: none;
            padding: 0.25rem 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-remove:hover {
            color: #c1121f;
            transform: scale(1.2);
        }

        /* Total Section */
        .total-section {
            background: #f8f9fa;
            padding: 1.25rem;
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .grand-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .grand-total span {
            font-size: 0.85rem;
            font-weight: 700;
            color: #6c757d;
            text-transform: uppercase;
        }

        .grand-total h3 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #2d6a4f;
            margin: 0;
        }

        /* Payment Section */
        .payment-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.25rem;
            border: 1px solid #dee2e6;
        }

        .payment-input {
            border: 2px solid #2d6a4f;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1.1rem;
            font-weight: 700;
            color: #2d6a4f;
            margin-bottom: 1rem;
        }

        .payment-input:focus {
            border-color: #1b4332;
            box-shadow: 0 0 0 0.2rem rgba(45, 106, 79, 0.15);
        }

        .change-display {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .change-display span:first-child {
            font-size: 0.85rem;
            font-weight: 700;
            color: #6c757d;
            text-transform: uppercase;
        }

        .change-display span:last-child {
            font-size: 1.1rem;
            font-weight: 700;
            color: #d62828;
        }

        /* Submit Button */
        .btn-submit {
            background: linear-gradient(135deg, #52b788 0%, #40916c 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(82, 183, 136, 0.4);
            background: linear-gradient(135deg, #40916c 0%, #2d6a4f 100%);
        }

        .btn-submit:disabled {
            background: #e9ecef;
            color: #adb5bd;
            cursor: not-allowed;
        }

        /* Empty State */
        .empty-cart {
            text-align: center;
            padding: 2rem 1rem;
            color: #6c757d;
        }

        .empty-cart i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.2;
            color: #2d6a4f;
        }

        .empty-cart p {
            margin: 0;
            font-size: 0.9rem;
        }

        /* Scrollbar */
        .product-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .product-scroll::-webkit-scrollbar-track {
            background: #f1f3f5;
            border-radius: 10px;
        }

        .product-scroll::-webkit-scrollbar-thumb {
            background: #2d6a4f;
            border-radius: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.25rem;
            }
            
            .cart-card {
                position: static;
                margin-top: 1.5rem;
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
                    <h1>
                        <i class="fas fa-cash-register me-2"></i>
                        Point of Sale - Transaksi Penjualan
                    </h1>
                </div>
            </div>

            <div class="container-fluid px-4 pb-4">
                <div class="row">
                    <!-- Product Grid -->
                    <div class="col-lg-7 mb-4">
                        <div class="card product-grid-card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <i class="fas fa-th-large me-2"></i>
                                    Pilih Produk
                                </h5>
                            </div>
                            <div class="card-body product-scroll" style="max-height: 75vh; overflow-y: auto;">
                                <div class="row g-3">
                                    <?php 
                                    $sql = mysqli_query($conn, "SELECT * FROM produk WHERE Stok > 0 ORDER BY NamaProduk ASC");
                                    if(mysqli_num_rows($sql) == 0){
                                        echo '<div class="col-12"><div class="empty-cart"><i class="fas fa-box-open"></i><p>Tidak ada produk tersedia</p></div></div>';
                                    }
                                    while($p = mysqli_fetch_array($sql)){
                                    ?>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <div class="product-item" onclick="tambahItem('<?= $p['ProdukID'] ?>', '<?= addslashes($p['NamaProduk']) ?>', '<?= $p['Harga'] ?>', '<?= $p['Stok'] ?>')">
                                            <div class="product-name"><?= $p['NamaProduk'] ?></div>
                                            <div class="product-price">Rp <?= number_format($p['Harga'], 0, ',', '.') ?></div>
                                            <span class="stock-badge">
                                                <i class="fas fa-box"></i> Stok: <?= $p['Stok'] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shopping Cart -->
                    <div class="col-lg-5">
                        <div class="card cart-card">
                            <div class="card-header">
                                <h5>
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    Keranjang Belanja
                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="proses_simpan.php" method="POST" id="formTransaksi">
                                    <!-- Customer Info -->
                                    <div class="mb-3">
                                        <label class="form-label-custom">
                                            <i class="fas fa-user"></i> Nama Pelanggan
                                        </label>
                                        <input type="text" 
                                               name="NamaPelanggan" 
                                               class="form-control form-control-custom" 
                                               placeholder="Masukkan nama pelanggan" 
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label-custom">
                                            <i class="fas fa-map-marker-alt"></i> Alamat
                                        </label>
                                        <input type="text" 
                                               name="Alamat" 
                                               class="form-control form-control-custom" 
                                               placeholder="Masukkan alamat" 
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label-custom">
                                            <i class="fas fa-phone"></i> Nomor Telepon
                                        </label>
                                        <input type="text" 
                                               name="NomorTelepon" 
                                               id="nomorTelepon"
                                               class="form-control form-control-custom" 
                                               placeholder="Contoh: 08123456789" 
                                               pattern="[0-9]+" 
                                               maxlength="15"
                                               required>
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            <i class="fas fa-info-circle me-1"></i>Hanya angka yang diperbolehkan
                                        </small>
                                    </div>
                                    
                                    <!-- Cart Items -->
                                    <div class="cart-table">
                                        <table class="table table-sm" id="tabelPesanan">
                                            <thead>
                                                <tr>
                                                    <th>Produk</th>
                                                    <th width="70">Qty</th>
                                                    <th width="90">Total</th>
                                                    <th width="40"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Items will be added here via JavaScript -->
                                            </tbody>
                                        </table>
                                        <div id="emptyCart" class="empty-cart">
                                            <i class="fas fa-shopping-basket"></i>
                                            <p>Keranjang masih kosong<br>Pilih produk untuk memulai</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Total Section -->
                                    <div class="total-section">
                                        <div class="grand-total">
                                            <span>Grand Total</span>
                                            <h3 id="totalHarga">Rp 0</h3>
                                        </div>

                                        <!-- Payment Box -->
                                        <div class="payment-box">
                                            <label class="form-label-custom">
                                                <i class="fas fa-money-bill-wave"></i> Uang Bayar
                                            </label>
                                            <input type="number" 
                                                   id="uangBayar" 
                                                   class="form-control payment-input" 
                                                   placeholder="0" 
                                                   oninput="hitungKembalian()">
                                            
                                            <div class="change-display">
                                                <span>Kembalian</span>
                                                <span id="textKembalian">Rp 0</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-submit" id="btnBayar" disabled>
                                        <i class="fas fa-check-circle me-2"></i>Konfirmasi Pembayaran
                                    </button>
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
        let items = [];

        function tambahItem(id, nama, harga, stokMax) {
            let index = items.findIndex(i => i.id === id);
            if(index !== -1) {
                if(items[index].qty < stokMax) {
                    items[index].qty++;
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Stok Tidak Cukup!',
                        text: `Stok maksimal produk ini adalah ${stokMax} unit`,
                        confirmButtonColor: '#2d6a4f'
                    });
                    return;
                }
            } else {
                items.push({ id, nama, harga: parseInt(harga), qty: 1, stokMax: parseInt(stokMax) });
            }
            renderTabel();
        }

        function hapusItem(index) {
            items.splice(index, 1);
            renderTabel();
        }

        function hitungKembalian() {
            let total = items.reduce((sum, item) => sum + (item.qty * item.harga), 0);
            let bayar = parseInt(document.getElementById('uangBayar').value) || 0;
            let kembalian = bayar - total;
            
            document.getElementById('textKembalian').innerText = 'Rp ' + (kembalian >= 0 ? kembalian.toLocaleString('id-ID') : 0);
            
            // Validasi: Tombol aktif jika ada item DAN uang cukup
            let nama = document.querySelector('input[name="NamaPelanggan"]').value.trim();
            let alamat = document.querySelector('input[name="Alamat"]').value.trim();
            let telepon = document.querySelector('input[name="NomorTelepon"]').value.trim();
            
            document.getElementById('btnBayar').disabled = 
                (items.length === 0 || kembalian < 0 || bayar === 0 || !nama || !alamat || !telepon);
        }

        function renderTabel() {
            let tbody = document.querySelector('#tabelPesanan tbody');
            let emptyCart = document.getElementById('emptyCart');
            
            if(items.length === 0) {
                tbody.innerHTML = '';
                emptyCart.style.display = 'block';
            } else {
                emptyCart.style.display = 'none';
                let html = '';
                let grandTotal = 0;
                
                items.forEach((item, i) => {
                    let subtotal = item.qty * item.harga;
                    grandTotal += subtotal;
                    html += `<tr>
                        <td>
                            <div class="cart-item-name">${item.nama}</div>
                            <input type="hidden" name="ProdukID[]" value="${item.id}">
                        </td>
                        <td>
                            <input type="number" 
                                   name="Jumlah[]" 
                                   class="qty-input" 
                                   value="${item.qty}" 
                                   min="1" 
                                   max="${item.stokMax}"
                                   onchange="updateQty(${i}, this.value)"
                                   readonly>
                        </td>
                        <td style="font-size: 0.85rem; font-weight: 600; color: #2d6a4f;">
                            Rp ${subtotal.toLocaleString('id-ID')}
                        </td>
                        <td>
                            <button type="button" class="btn-remove" onclick="hapusItem(${i})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>`;
                });
                
                tbody.innerHTML = html;
                document.getElementById('totalHarga').innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');
            }
            
            hitungKembalian();
        }

        function updateQty(index, newQty) {
            newQty = parseInt(newQty);
            if(newQty > 0 && newQty <= items[index].stokMax) {
                items[index].qty = newQty;
                renderTabel();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Jumlah Tidak Valid!',
                    text: `Qty harus antara 1 - ${items[index].stokMax}`,
                    confirmButtonColor: '#2d6a4f'
                });
                renderTabel();
            }
        }

        // Event listener untuk input customer
        document.querySelector('input[name="NamaPelanggan"]').addEventListener('input', hitungKembalian);
        document.querySelector('input[name="Alamat"]').addEventListener('input', hitungKembalian);
        document.querySelector('input[name="NomorTelepon"]').addEventListener('input', hitungKembalian);

        // Validasi nomor telepon - hanya angka yang diperbolehkan
        const inputTelepon = document.getElementById('nomorTelepon');
        
        // Prevent non-numeric characters on keypress
        inputTelepon.addEventListener('keypress', function(e) {
            // Allow: backspace, delete, tab, escape, enter
            if ([46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 ||
                // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (e.keyCode === 65 && e.ctrlKey === true) ||
                (e.keyCode === 67 && e.ctrlKey === true) ||
                (e.keyCode === 86 && e.ctrlKey === true) ||
                (e.keyCode === 88 && e.ctrlKey === true)) {
                return;
            }
            
            // Ensure that it's a number and stop the keypress if not
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        
        // Prevent non-numeric on paste
        inputTelepon.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            const numericText = pastedText.replace(/[^0-9]/g, '');
            
            if(numericText) {
                // Insert only numbers at cursor position
                const start = this.selectionStart;
                const end = this.selectionEnd;
                const currentValue = this.value;
                this.value = currentValue.substring(0, start) + numericText + currentValue.substring(end);
                
                // Set cursor position
                const newPosition = start + numericText.length;
                this.setSelectionRange(newPosition, newPosition);
                
                // Trigger input event for validation
                this.dispatchEvent(new Event('input'));
            }
        });
        
        // Remove non-numeric characters if somehow entered
        inputTelepon.addEventListener('input', function(e) {
            const value = this.value;
            const numericValue = value.replace(/[^0-9]/g, '');
            
            if(value !== numericValue) {
                this.value = numericValue;
            }
        });

        // Initialize
        renderTabel();
    </script>
</body>
</html>