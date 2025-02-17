@extends('layouts.app')

@section('content')
    <div id="content" class="overflow-y-hidden overflow-x-hidden">
        @if ($lists->count() == 0)
            <!-- Jika tidak ada daftar tugas, tampilkan pesan dan tombol untuk menambahkan list -->
            <div class="d-flex flex-column align-items-center">
                <p class="text-center fst-italic">Belum ada tugas yang ditambahkan</p>
                <button type="button" class="btn d-flex align-items-center gap-2" style="width: fit-content;"
                    data-bs-toggle="modal" data-bs-target="#addListModal">
                    <i class="bi bi-plus-square fs-1"></i>
                </button>
            </div>
        @endif

        <!-- Wrapper utama untuk daftar list -->
        <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden" style="height: 100vh;">
            @foreach ($lists as $list)
                <!-- Card untuk setiap list -->
                <div class="card flex-shrink-0 border-0 shadow-lg pastel-card" style="width: 18rem; max-height: 80vh;">
                    <div class="card-header d-flex align-items-center justify-content-between bg-light-pink rounded-top">
                        <!-- Nama list -->
                        <h4 class="card-title text-coquette fw-bold">{{ $list->name }}</h4>
                        <!-- Tombol hapus list -->
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm p-0">
                                <i class="bi bi-trash fs-5 text-danger"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">
                        @foreach ($list->tasks as $task)
                            <!-- Card untuk setiap tugas dalam list -->
                            <div class="card {{ $task->is_completed ? 'bg-secondary-subtle' : '' }} cute-task-card">
                                <div class="card-header bg-light-lilac">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Jika tugas prioritas tinggi dan belum selesai, tampilkan indikator -->
                                            @if ($task->priority == 'high' && !$task->is_completed)
                                                <div class="spinner-grow spinner-grow-sm text-{{ $task->priorityClass }}"
                                                    role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            @endif
                                            <!-- Nama tugas dengan tautan ke detail tugas -->
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="fw-bold lh-1 m-0 text-decoration-none text-{{ $task->priorityClass }} cute-text {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
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
        <div class="about-creator mt-5 text-center p-4 rounded shadow" style="background-color: #fce4ec;">
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
                <a href="[LINK_TWITTER]" class="text-decoration-none" target="_blank">
                    <i class="bi bi-twitter fs-4 text-coquette"></i>
                </a>
            </div>
            
            <a href="[LINK_PROFIL]" class="btn btn-coquette mt-3">Lihat Profil</a>
        </div>

        <style>
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
        </style>
    </div>
@endsection