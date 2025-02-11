@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg rounded-4 border-0">
            <div class="card-body p-5">
                <h1 class="mb-4 text-primary d-flex align-items-center">
                    <span class="me-3">✏️</span> <span>Edit Tugas</span>
                </h1>

                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-4">
                        <label for="name" class="form-label fw-bold">Nama Tugas</label>
                        <input type="text" name="name" id="name" class="form-control border-danger shadow-sm" value="{{ $task->name }}">
                    </div>

                    <div class="form-group mb-4">
                        <label for="description" class="form-label fw-bold">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control border-danger shadow-sm" rows="4">{{ $task->description }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-danger btn-lg shadow-sm mt-3 w-100 transition-all hover-effect">
                        Simpan Perubahan
                    </button>
                </form>
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

        /* Membuat form lebih bersih */
        .form-control {
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
        box-shadow: 0px 0px 10px rgba(235, 51, 121, 0.5);
        border-color: #d84e83;
        }

        /* Membuat layout lebih responsif */
        @media (max-width: 768px) {
            .card-body {
                padding: 3rem;
            }

            .fs-4 {
                font-size: 1.25rem;
            }
        }
    </style>
@endsection