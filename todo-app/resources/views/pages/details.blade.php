@extends('layouts.app')

@section('content')
    <div id="content" class="container py-5">
        <div class="card shadow-lg p-4 border-0 rounded-4">
            <h1 class="mb-4 text-center text-primary fw-bold text-uppercase" style="letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                📌 Detail Tugas
            </h1>
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <h3 class="fw-bold text-dark">{{ $task->name }}</h3>
                        <p class="text-muted">{{ $task->description }}</p>
                    </div>
                </div>
                <div class="col-md-4 d-flex flex-column align-items-start">
                    <span class="badge text-bg-{{ $task->priorityClass }} fs-6 px-3 py-2">
                        {{ $task->priority }}
                    </span>
                    <span class="badge text-bg-{{ $task->status ? 'success' : 'danger' }} fs-6 px-3 py-2 mt-2">
                        {{ $task->status ? 'Selesai' : 'Belum Selesai' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
