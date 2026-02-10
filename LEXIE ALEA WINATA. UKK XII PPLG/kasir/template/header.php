<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Efek Halus untuk Semua Tombol */
    .btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 10px;
        position: relative;
        overflow: hidden;
        font-weight: 500;
    }

    /* Efek saat Mouse Menempel (Hover) */
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(45, 106, 79, 0.25);
        filter: brightness(1.05);
    }

    /* Efek saat Tombol Diklik (Active) */
    .btn:active {
        transform: translateY(1px);
        box-shadow: 0 2px 6px rgba(45, 106, 79, 0.15);
    }

    /* Tombol Primary - Hijau Tua */
    .btn-primary {
        background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #40916c 0%, #2d6a4f 100%);
        box-shadow: 0 4px 15px rgba(45, 106, 79, 0.3);
    }

    /* Tombol Success - Hijau Natural */
    .btn-success {
        background: #52b788;
        border: none;
    }

    .btn-success:hover {
        background: #40916c;
        box-shadow: 0 4px 12px rgba(82, 183, 136, 0.3);
    }

    /* Tombol Danger - Tetap Merah tapi Soft */
    .btn-danger {
        background: #d62828;
        border: none;
    }

    .btn-danger:hover {
        background: #c1121f;
        box-shadow: 0 4px 12px rgba(214, 40, 40, 0.3);
    }

    .btn-danger:active {
        transform: scale(0.97);
    }

    /* Tombol Warning - Kuning Natural */
    .btn-warning {
        background: #f4a261;
        border: none;
        color: #fff;
    }

    .btn-warning:hover {
        background: #e76f51;
        box-shadow: 0 4px 12px rgba(244, 162, 97, 0.3);
    }

    /* Tombol Info - Biru Soft */
    .btn-info {
        background: #4a90a4;
        border: none;
        color: #fff;
    }

    .btn-info:hover {
        background: #3d7a8a;
        box-shadow: 0 4px 12px rgba(74, 144, 164, 0.3);
    }

    /* Tombol Outline - Hijau Tua */
    .btn-outline-primary {
        border: 2px solid #2d6a4f;
        color: #2d6a4f;
    }

    .btn-outline-primary:hover {
        background: #2d6a4f;
        color: #fff;
        border-color: #2d6a4f;
    }

    /* Tombol Outline Danger */
    .btn-outline-danger {
        border: 2px solid rgba(214, 40, 40, 0.5);
        color: #d62828;
    }

    .btn-outline-danger:hover {
        background: #d62828;
        color: #fff;
        border-color: #d62828;
    }

    /* Efek Hover Menu Sidebar */
    .nav-link {
        padding: 14px 18px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 12px;
        margin: 6px 0;
        font-weight: 400;
    }

    .nav-link:hover:not(.active) {
        background-color: rgba(255, 255, 255, 0.12) !important;
        transform: translateX(4px);
        color: rgba(255, 255, 255, 0.95) !important;
        padding-left: 22px;
    }

    /* Efek saat Menu Aktif */
    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.95) !important;
        color: #2d6a4f !important;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Card & Container Styling */
    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 16px rgba(45, 106, 79, 0.12);
        transform: translateY(-2px);
    }

    /* Table Styling */
    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead {
        background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);
        color: #fff;
    }

    .table tbody tr:hover {
        background-color: rgba(45, 106, 79, 0.05);
        transition: background-color 0.2s ease;
    }

    /* Form Control */
    .form-control:focus,
    .form-select:focus {
        border-color: #2d6a4f;
        box-shadow: 0 0 0 0.2rem rgba(45, 106, 79, 0.15);
    }

    /* Badge Styling */
    .badge {
        border-radius: 6px;
        padding: 6px 12px;
        font-weight: 500;
    }

    /* Smooth Page Transitions */
    * {
        scroll-behavior: smooth;
    }
</style>