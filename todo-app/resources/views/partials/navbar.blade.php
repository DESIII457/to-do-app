
<!-- Navbar dengan kelas Bootstrap untuk styling -->
<nav class="navbar navbar-expand-lg bg-pink navbar-dark fixed-top shadow-sm">
    <img src="{{asset('images/WhatsApp Image 2025-02-19 at 10.07.34.jpeg')}}" alt="Gambar Profil" class="rounded-circle mb-90" style="width: 100px; height: 100px; object-fit: cover; cover; margin: 30px;">
    <div class="container d-flex justify-content-between">
        <!-- Bagian kiri navbar yang berisi logo atau nama aplikasi -->
        <div class="d-flex align-items-center">
            <!-- Link menuju halaman utama dengan nama aplikasi diambil dari konfigurasi -->
            <a class="navbar-brand fw-bolder text-uppercase" href="#">{{ config('app.name') }}</a>
        </div>
        <div class="row my-3">
            {{-- fitur clear --}}
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
                {{-- javascript untuk fitur clear --}}
                <script>
                    document.getElementById('clearSearch').addEventListener('click', function () {
                        document.getElementById('searchQuery').value = ''; // Kosongkan input
                        window.location.href = "{{ route('home') }}"; // Redirect ke halaman awal
                    });
                </script>  
                              
            </div>
        </div>
    </div>
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
/* Bagian utama dengan latar belakang gambar */
#content {
    background-image: url('aa6cf3d8c4f77810f93714ad3b7e2b00 (2).jpg'); /* Gambar latar belakang */
    background-size: cover; /* Agar gambar menyesuaikan ukuran container */
    background-repeat: no-repeat; /* Tidak mengulang gambar */
    background-position: center; /* Pusatkan gambar */
    backdrop-filter: blur(10px); /* Efek blur pada latar belakang */
}

/* Styling untuk bagian "Tentang Pembuat" */
.about-creator {
    background-color: #fce4ec; /* Warna pastel pink yang lembut */
    padding: 20px; /* Ruang di dalam box agar tidak terlalu sempit */
    border-radius: 10px; /* Sudut membulat agar lebih aesthetic */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Efek bayangan halus */
}

/* Ikon sosial media */
.social-icons a {
    color: #d81b60; /* Warna ikon sosial media pink */
    transition: color 0.3s; /* Efek transisi saat hover */
}

.social-icons a:hover {
    color: #ff3b30; /* Warna berubah jadi pink lebih terang saat hover */
}

/* Warna-warna pastel untuk elemen latar belakang */
.bg-light-pink { background-color: #fce4ec; } /* Pink lembut */
.bg-light-lilac { background-color: #ede7f6; } /* Lilac kalem */
.bg-light-peach { background-color: #ffebcd; } /* Peach hangat */
.bg-light-blue { background-color: #e3f2fd; } /* Biru pastel */

/* Kartu dengan tampilan soft dan feminin */
.pastel-card {
    background: white; /* Warna dasar putih bersih */
    border-radius: 20px; /* Sudut yang membulat agar terlihat lebih lembut */
    box-shadow: none; /* Menghilangkan bayangan default */
}

/* Teks aesthetic dengan font script */
.text-coquette {
    font-family: 'Dancing Script', cursive; /* Font tulisan tangan yang elegan */
    color: #d81b60; /* Warna pink khas */
}

/* Tombol dengan tampilan cute dan aesthetic */
.cute-btn {
    background-color: #f097b6; /* Warna pink pastel */
    color: white; /* Teks putih agar kontras */
    border-radius: 50px; /* Bentuk oval */
    border: none; /* Menghilangkan border */
    font-weight: bold; /* Membuat teks lebih tegas */
}

.cute-btn:hover {
    background-color: #f48fb1; /* Warna lebih terang saat hover */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Efek bayangan saat hover */
}

/* Input form dengan gaya coquette */
.coquette-input {
    border: 2px solid #ff6f61; /* Warna border merah pastel */
    border-radius: 10px; /* Sudut membulat */
    padding: 10px; /* Spasi dalam input */
    transition: border-color 0.3s; /* Animasi saat fokus */
}

.coquette-input:focus {
    border-color: #ff3b30; /* Warna lebih cerah saat fokus */
    outline: none; /* Menghilangkan outline bawaan browser */
}

/* Styling untuk container dengan efek blur */
.d-flex.gap-3.px-3.flex-nowrap.overflow-x-scroll.overflow-y-hidden {
    backdrop-filter: blur(10px); /* Efek blur agar terlihat dreamy */
    background: rgba(255, 255, 255, 0.2); /* Warna putih transparan */
}
    </style>
</nav>

