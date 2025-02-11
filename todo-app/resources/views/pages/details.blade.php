@extends('layouts.app')

@section('content')
    <div id="content" class="container py-5">
        <div class="card shadow-lg rounded-4 border-0 overflow-hidden">
            <div class="card-body p-5">
                <h1 class="mb-4 text-primary d-flex align-items-center">
                    <i class="bi bi-balloon-heart-fill"></i>
                    <span class="fs-3">Detail Tugas</span>
                </h1>

                <div class="row">
                    <div class="col-md-8">
                        <h3 class="mb-3 text-dark">{{ $task->name }}</h3>
                        <p class="text-muted">{{ $task->description }}</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-4 mt-md-0">
                        <span class="badge bg-{{ $task->priorityClass }} badge-pill px-4 py-2 fw-bold text-uppercase shadow-sm">
                            {{ ucfirst($task->priority) }}
                        </span>
                        <span class="badge bg-{{ $task->status ? 'success' : 'danger' }} badge-pill px-4 py-2 fw-bold text-uppercase shadow-sm">
                            {{ $task->status ? '✅ Selesai' : '⏳ Belum selesai' }}
                        </span>
                    </div>
                </div>

                <hr class="my-4 border-muted">

                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-danger btn-lg shadow-lg transition-all hover-effect">
                        ⬅ Kembali
                    </a>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-danger btn-lg shadow-lg transition-all hover-effect">
                        ✏️ Edit Tugas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Efek hover pada tombol */
        .hover-effect:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Tambahkan efek transisi halus pada tombol */
        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        /* Warna border pada hr */
        .border-muted {
            border-color: #f0f0f0;
        }

        /* Membuat layout lebih responsif dan bersih */
        @media (max-width: 768px) {
            .card-body {
                padding: 3rem;
            }
            .fs-2 {
                font-size: 2rem;
            }
            .fs-3 {
                font-size: 1.75rem;
            }
        }
    </style>
@endsection