@extends('layouts.app')

@section('content')
    <div id="content" class="container py-5" style="background: linear-gradient(135deg, #ffd1dc, #ffb6c1); min-height: 100vh; border-radius: 10px;">
        {{-- Container utama dengan background pink gradient --}}
        <div class="card shadow-lg p-4 border-0 rounded-4" style="background: #fff0f5;">
            {{-- card → Bootstrap komponen untuk tampilan kotak (kartu)
            shadow-lg → Menambahkan efek bayangan agar terlihat lebih elegan
            p-4 → Padding dalam kartu agar isi tidak terlalu mepet
            border-0 → Menghilangkan border bawaan Bootstrap
            rounded-4 → Membuat sudut kartu melengkung agar lebih lembut
            background: #fff0f5; → Warna soft pink untuk tampilan lebih manis --}}
            {{-- Kartu dengan warna soft pink --}}
            <h1 class="mb-4 text-center text-danger fw-bold text-uppercase" style="letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(255, 105, 180, 0.5);">
                🎀 Detail Tugas
            </h1>
            {{-- text-center → Posisikan teks di tengah
            text-danger → Warna merah (agar kontras dengan latar pink)
            fw-bold → Font tebal
            text-uppercase → Huruf besar semua
            letter-spacing: 2px; → Memberikan sedikit jarak antar huruf agar lebih estetis
            text-shadow: 2px 2px 5px rgba(255, 105, 180, 0.5); → Efek bayangan tipis untuk memperjelas teks
            --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <h3 class="fw-bold text-dark">{{ $task->name }}</h3>
                        <p class="text-muted">{{ $task->description }}</p>
                    </div>
                </div>

                <div class="col-md-4 d-flex flex-column align-items-start">
                    <span class="badge fs-6 px-3 py-2 shadow-sm" style="background-color: #ff69b4; color: white;">
                        {{ $task->priority }}
                    </span>
                    <span class="badge fs-6 px-3 py-2 mt-2 shadow-sm" 
                          style="background-color: {{ $task->is_completed ? '#ffb6c1' : '#ff1493' }}; color: white;">
                        {{ $task->is_completed ? 'Selesai 🎉' : 'Belum Selesai ❌' }}
                    </span>
                </div>
            </div>

            @if (!$task->is_completed)
                <div class="mt-4 text-center">
                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn text-white w-75 shadow-sm" 
                                style="background-color: #ff69b4; transition: all 0.3s ease-in-out;">
                            <i class="bi bi-check-circle"></i> Tandai sebagai Selesai
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
