@extends('layouts.app')

@section('content')
    {{-- Menggunakan layout utama dari aplikasi --}}
    <div id="content" class="container py-5">
        {{-- Container utama dengan padding atas dan bawah --}}
        <div class="card shadow-lg p-4 border-0 rounded-4">
            {{-- Kartu dengan efek bayangan, padding, tanpa border, dan sudut melengkung --}}
            <h1 class="mb-4 text-center text-primary fw-bold text-uppercase" style="letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                {{-- Judul halaman dengan efek teks berwarna biru, tebal, uppercase, dan efek bayangan --}}
                📌 Detail Tugas
            </h1>
            <div class="row">
                {{-- Baris utama yang membagi halaman menjadi dua kolom --}}
                <div class="col-md-8">
                    {{-- Kolom utama dengan lebar 8 dari 12 grid --}}
                    <div class="mb-3">
                        {{-- Section untuk menampilkan nama dan deskripsi tugas --}}
                        <h3 class="fw-bold text-dark">{{ $task->name }}</h3>
                        {{-- Menampilkan nama tugas dengan teks tebal dan berwarna gelap --}}
                        <p class="text-muted">{{ $task->description }}</p>
                        {{-- Menampilkan deskripsi tugas dengan teks berwarna abu-abu --}}
                    </div>
                </div>
                <div class="col-md-4 d-flex flex-column align-items-start">
                    {{-- Kolom samping untuk menampilkan prioritas dan status tugas --}}
                    <span class="badge text-bg-{{ $task->priorityClass }} fs-6 px-3 py-2">
                        {{-- Badge untuk menampilkan prioritas tugas dengan warna sesuai priorityClass --}}
                        {{ $task->priority }}
                    </span>
                    <span class="badge text-bg-{{ $task->status ? 'success' : 'danger' }} fs-6 px-3 py-2 mt-2">
                        {{-- Badge untuk menampilkan status tugas, hijau jika selesai, merah jika belum selesai --}}
                        {{ $task->status ? 'Selesai' : 'Belum Selesai' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
