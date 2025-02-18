<link rel="stylesheet" href="css/style.css">
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

