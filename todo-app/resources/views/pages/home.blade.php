@extends('layouts.app')

@section('content')
    <div id="content" class="overflow-y-hidden overflow-x-hidden">
        @if ($lists->count() == 0)
            <!-- Jika tidak ada daftar tugas, tampilkan pesan dan tombol untuk menambahkan list -->
            <!-- Container utama dengan flexbox, mengatur elemen dalam kolom dan rata tengah -->
            <div class="d-flex flex-column align-items-center">
                {{-- <!-- Paragraf dengan teks ditampilkan di tengah dan font italic --> --}}
                <p class="text-center fst-italic">Belum ada tugas yang ditambahkan</p>
                 <!-- Tombol untuk menambah tugas, dengan ikon dan teks berjajar menggunakan flexbox -->
                <button type="button" class="btn d-flex align-items-center gap-2" style="width: fit-content;"
                    data-bs-toggle="modal" data-bs-target="#addListModal">
                    <!-- Ikon plus dari Bootstrap Icons dengan ukuran besar -->
                    <i class="bi bi-plus-square fs-1"></i>
                </button>
            </div>
        @endif

        <!-- Wrapper utama untuk daftar list -->
        <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden" style="height: 100vh;">
            @foreach ($lists as $list)
                <!-- Card untuk setiap list -->
                <div class="card flex-shrink-0 border-0 shadow-lg pastel-card" style="width: 18rem; max-height: 80vh;">
                    <!-- Header kartu dengan styling dan layout flexbox -->
                    <div class="card-header d-flex align-items-center justify-content-between bg-light-pink rounded-top">
                        {{-- Ini adalah bagian header kartu.
                        Menggunakan d-flex align-items-center justify-content-between untuk membuat tata letak fleksibel:
                        align-items-center: Rata tengah vertikal.
                        justify-content-between: Menyebarkan elemen ke kiri dan kanan.
                        bg-light-pink: Warna latar belakang khusus (kemungkinan class custom).
                        rounded-top: Membuat sudut atas kartu membulat. --}}

                        <!-- Nama list yang ditampilkan sebagai judul -->
                        {{-- Menampilkan nama list sebagai judul kartu. --}}
                        <h4 class="card-title text-coquette fw-bold">{{ $list->name }}</h4>

                        <!-- Form untuk menghapus list dengan metode POST-->
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                            {{-- route('lists.destroy', $list->id): Mengarahkan ke rute lists.destroy dengan ID list yang akan dihapus. style="display: inline;": Memastikan form tetap dalam satu baris dengan elemen lain. --}}
                            @csrf <!-- Token keamanan Laravel untuk mencegah CSRF attacks -->
                            @method('DELETE') <!-- Mengubah metode form menjadi DELETE sesuai dengan RESTful API -->

                            <!-- Tombol hapus dengan ikon trash -->
                            <button type="submit" class="btn btn-sm p-0">
                                <i class="bi bi-trash fs-5 text-danger"></i> <!-- Ikon trash berwarna merah -->
                            </button>
                        </form>

                    </div>
                    {{-- Kode ini membuat bagian body kartu untuk daftar tugas. Setiap tugas akan ditampilkan dalam bentuk kartu individu, dengan warna berbeda jika tugas sudah selesai. Header kartu tugas diberi warna lilac, dan layoutnya disusun menggunakan Flexbox agar rapi dan mudah dibaca. --}}
                    <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">
                        {{-- d-flex flex-column:
                            Menggunakan Flexbox untuk menyusun elemen secara vertikal.
                            gap-2:
                            Memberikan jarak antar elemen sebesar Bootstrap spacing 2.
                            overflow-x-hidden:
                            Menyembunyikan konten yang melewati lebar container untuk mencegah scroll horizontal. --}}
                        @foreach ($list->tasks as $task)
                        {{-- Perulangan @foreach untuk menampilkan semua tugas dalam $list->tasks.
                            $task merepresentasikan setiap tugas dalam daftar. --}}
                            <!-- Card untuk setiap tugas dalam list -->
                            <div class="card {{ $task->is_completed ? 'bg-secondary-subtle' : '' }} cute-task-card">
                                {{-- <div class="card">: Membuat kartu untuk setiap tugas dalam daftar.
                                {{ $task->is_completed ? 'bg-secondary-subtle' : '' }}:
                                Jika tugas selesai (is_completed == true), kartu diberi warna secondary-subtle (abu-abu redup).
                                Jika belum selesai, warna tetap default.
                                cute-task-card: Class tambahan (kemungkinan custom CSS) untuk styling kartu tugas. --}}
                                <div class="card-header bg-light-lilac">
                                {{-- card-header: Header dari setiap kartu tugas.
                                bg-light-lilac: Class custom untuk memberi warna latar header. --}}
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Jika tugas prioritas tinggi dan belum selesai, tampilkan indikator -->
                                            @if ($task->priority == 'high' && !$task->is_completed)
                                            {{-- @if: Ini adalah directive Blade untuk membuat kondisi.
                                                $task->priority == 'high': Mengecek apakah prioritas tugas ($task->priority) bernilai 'high'.
                                                && !$task->is_completed: Memastikan tugas belum selesai (is_completed bernilai false).
                                                Jika kedua kondisi ini terpenuhi, maka blok kode di dalamnya akan dieksekusi. --}}
                                                <div class="spinner-grow spinner-grow-sm text-{{ $task->priorityClass }}"
                                                    role="status">
                                                    {{-- spinner-grow: Komponen spinner dari Bootstrap yang menunjukkan proses berjalan.
                                                    spinner-grow-sm: Mengatur ukuran spinner menjadi kecil.
                                                    text-{{ $task->priorityClass }}: Menggunakan kelas warna dinamis berdasarkan nilai $task->priorityClass, yang mungkin berisi warna seperti "danger" untuk prioritas tinggi.
                                                    role="status": Menandakan elemen ini sebagai status loading bagi pembaca layar. --}}
                                                    <span class="visually-hidden">Loading...</span>
                                                    {{-- visually-hidden: Kelas Bootstrap yang menyembunyikan teks dari tampilan tetapi tetap terbaca oleh pembaca layar (screen reader).
                                                    Loading...: Memberikan informasi tambahan kepada pengguna dengan kebutuhan aksesibilitas. --}}
                                                </div>
                                                {{-- Menutup blok @if, mengakhiri kondisi. --}}
                                            @endif
                                            <!-- Nama tugas dengan tautan ke detail tugas -->

                                            {{-- Kode ini membuat tautan ke halaman detail tugas, dengan warna teks sesuai prioritas. Jika tugas sudah selesai, namanya akan dicoret. --}}
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="fw-bold lh-1 m-0 text-decoration-none text-{{ $task->priorityClass }} cute-text {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                                {{-- lh-1: Mengatur tinggi baris menjadi lebih rapat.
                                                m-0: Menghilangkan margin default agar lebih padat.
                                                text-decoration-none: Menghilangkan garis bawah bawaan dari link (<a>).
                                                text-{{ $task->priorityClass }}:
                                                Kelas dinamis untuk warna teks berdasarkan prioritas tugas.
                                                Jika priorityClass adalah "danger", maka teks akan berwarna merah (text-danger).
                                                cute-text: Kemungkinan class custom CSS untuk styling tambahan.
                                                {{ $task->is_completed ? 'text-decoration-line-through' : '' }}:
                                                Jika tugas sudah selesai (is_completed == true), teks akan diberi efek coret (strikethrough).
                                                Jika belum selesai, teks tetap normal. --}}
                                                {{ $task->name }}
                                            </a>
                                        </div>
                                        <!-- Tombol hapus tugas -->
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm p-0">
                                                <i class="bi bi-x-circle text-danger fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body bg-light-peach">
                                    <!-- Deskripsi tugas -->
                                    <p class="card-text text-truncate {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                        {{ $task->description }}
                                    </p>
                                </div>
                                @if (!$task->is_completed)
                                    <!-- Tombol untuk menandai tugas sebagai selesai -->
                                    <div class="card-footer">
                                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-primary w-100 cute-btn">
                                                <span class="d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-heart-fill fs-5"></i>
                                                    Selesai 
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <!-- Tombol tambah tugas -->
                        <button type="button" class="btn btn-sm btn-outline-primary cute-btn" data-bs-toggle="modal"
                            data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                            <span class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-plus fs-5"></i>
                                Tambah 
                            </span>
                        </button>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center bg-light-blue rounded-bottom">
                        <!-- Menampilkan jumlah tugas dalam list -->
                        <p class="card-text cute-text">{{ $list->tasks->count() }} Tugas</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bagian tentang pembuat halaman -->
        <div class="about-creator mt-70 text-center p-4 rounded shadow" style="background-color: #e99bb5;">
            <h5 class="text-coquette mb-3">Tentang Pembuat Halaman</h5>
            <img src="{{asset('images/c4380d8f0d7cbb4221446bb0105c8191.jpg')}}" alt="Gambar Profil" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
            <p class="fw-bold">Halaman ini dibuat oleh DESI LISNAWATI.</p>
            <p class="text-muted">Pembuat to-do-list ini adalah seorang manusia yang mempunyai hobi menggambar, membuat kerajinan tangan atau pun kadang kadang dia menjadi anomali di tengahh kesibukan dunia yang tiada hentinya di zaman sekarang.</p>
            
            <div class="social-icons mt-3">
                <!-- Link yang mengarah ke GitHub -->
                <a href="https://github.com/" class="text-decoration-none me-2" target="_blank">
                {{--  Menentukan URL tujuan, dalam hal ini GitHub.
                text-decoration-none → Menghapus underline bawaan dari tautan.
                me-2 → Menambahkan margin-end (jarak ke kanan) sebesar 2 (Bootstrap spacing). --}}
                    <!-- Ikon GitHub menggunakan Bootstrap Icons -->
                    <i class="bi bi-github fs-4 text-coquette"></i>
                </a>
                <a href="[LINK_LINKEDIN]" class="text-decoration-none me-2" target="_blank">
                    <i class="bi bi-facebook fs-4 text-coquette"></i>
                </a>
                {{-- link mengarah ke instagram --}}
                <a href="[LINK_TWITTER]" class="text-decoration-none" target="_blank">
                    <i class="bi bi-instagram fs-4 text-coquette"></i>
                </a>
            </div>
        </div>

        <style>
            #content {
                background-image: url('images/aa6cf3d8c4f77810f93714ad3b7e2b00 (2).jpg');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                backdrop-filter: blur(10px); /* Efek blur */
                
            }
            .about-creator {
                background-color: #fce4ec; /* Warna latar belakang untuk bagian tentang pembuat */
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .social-icons a {
                color: #d81b60; /* Warna ikon sosial media */
                transition: color 0.3s;
            }

            .social-icons a:hover {
                color: #ff3b30; /* Warna saat hover */
            }
            
            /* Warna pastel untuk tampilan coquette */
            .bg-light-pink { background-color: #fce4ec; }
            .bg-light-lilac { background-color: #ede7f6; }
            .bg-light-peach { background-color: #ffebcd; }
            .bg-light-blue { background-color: #e3f2fd; }
        
            /* Card tampilan soft dan feminin */
            .pastel-card {
                background: white;
                border-radius: 20px;
                box-shadow: none;
            }
    
            /* Teks aesthetic */
            .text-coquette {
                font-family: 'Dancing Script', cursive;
                color: #d81b60;
            }
        
            /* Tombol aesthetic */
            .cute-btn {
                background-color: #f097b6;
                color: white;
                border-radius: 50px;
                border: none;
                font-weight: bold;
            }
        
            .cute-btn:hover {
                background-color: #f48fb1;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }
        
            /* Input form coquette */
            .coquette-input {
                border: 2px solid #ff6f61;
                border-radius: 10px;
                padding: 10px;
                transition: border-color 0.3s;
            }
        
            .coquette-input:focus {
                border-color: #ff3b30;
                outline: none;
            }
            .d-flex.gap-3.px-3.flex-nowrap.overflow-x-scroll.overflow-y-hidden {
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.2); /* Sesuaikan transparansi */
                
            }
        </style>
    </div>
@endsection