<!-- Navbar dengan kelas Bootstrap untuk styling -->
<nav class="navbar navbar-expand-lg bg-pink navbar-dark fixed-top shadow-sm">
    <div class="container d-flex justify-content-between">
        <!-- Bagian kiri navbar yang berisi logo atau nama aplikasi -->
        <div class="d-flex align-items-center">
            <!-- Link menuju halaman utama dengan nama aplikasi diambil dari konfigurasi -->
            <a class="navbar-brand fw-bolder text-uppercase" href="#">{{ config('app.name') }}</a>
        </div>
        <div class="row my-3">
            <div class="col-100 mx-auto">
                <form action="{{ route('home') }}" method="GET" class="d-flex gap-3 coquette-form">
                    <input type="text" class="form-control coquette-input" name="query" id="searchQuery" placeholder="Cari tugas atau list..."
                        value="{{ request()->query('query') }}">
                    <button type="submit" class="btn btn-coquette">Cari</button>
                    <button type="button" class="btn btn-secondary" id="clearSearch">Clear</button>
                    @if ($lists->count() !== 0)
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addListModal">
                            Tambah
                        </button>
                    @endif

                </form>
                
                <script>
                    document.getElementById('clearSearch').addEventListener('click', function () {
                        document.getElementById('searchQuery').value = ''; // Kosongkan input
                        window.location.href = "{{ route('home') }}"; // Redirect ke halaman awal
                    });
                </script>                
            </div>
        </div>
    </div>
</nav>

<style>

.coquette-form {
    background-color: #f9f3f3; /* Warna latar belakang pastel */
    border-radius: 15px; /* Sudut yang lebih bulat */
    padding: 20px; /* Ruang di dalam form */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Bayangan halus */
}

.coquette-input {
    border: 2px solid #ff6f61; /* Warna border yang cerah */
    border-radius: 10px; /* Sudut input yang lebih bulat */
    padding: 10px; /* Ruang di dalam input */
    transition: border-color 0.3s; /* Transisi halus saat hover */
    margin-right: 8px; /* Sesuaikan jaraknya */
}

.coquette-input:focus {
    border-color: #ff3b30; /* Warna border saat fokus */
    outline: none; /* Menghilangkan outline default */
}

.btn-coquette {
    background-color: #ff61e5; /* Warna latar belakang tombol */
    color: white; /* Warna teks tombol */
    border-radius: 10px; /* Sudut tombol yang lebih bulat */
    transition: background-color 0.3s; /* Transisi halus saat hover */
}

.btn-coquette:hover {
    background-color: #ff3b30; /* Warna latar belakang saat hover */
}

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