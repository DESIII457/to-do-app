<!-- Navbar dengan kelas Bootstrap untuk styling -->
<nav class="navbar navbar-expand-lg bg-pink navbar-dark fixed-top shadow-sm">
    <div class="container d-flex justify-content-between">
        <!-- Bagian kiri navbar yang berisi logo atau nama aplikasi -->
        <div class="d-flex align-items-center">
            <!-- Link menuju halaman utama dengan nama aplikasi diambil dari konfigurasi -->
            <a class="navbar-brand fw-bolder text-uppercase" href="#">{{ config('app.name') }}</a>
        </div>
    </div>
</nav>

<style>
    .bg-pink {
    background-color: #ff77a8; /* Warna latar belakang pink */
}

.navbar-dark .navbar-brand {
    color: #fff; /* Warna teks putih untuk navbar-brand */
    transition: color 0.3s; /* Transisi halus saat hover */
}

.navbar-dark .navbar-brand:hover {
    color: #ff3b30; /* Warna teks saat hover */
}

.shadow-sm {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Bayangan halus */
}
</style>