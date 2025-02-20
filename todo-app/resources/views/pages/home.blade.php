@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/style.css">
{{-- menambahkan style css yang ada di public/image --}}
<div id="content" class="overflow-y-hidden overflow-x-hidden">
    @if ($lists->count() == 0)
        <div class="d-flex flex-column align-items-center">
            <p class="text-center fst-italic">Belum ada tugas yang ditambahkan</p>
            <button type="button" class="btn d-flex align-items-center gap-2" style="width: fit-content;"
                data-bs-toggle="modal" data-bs-target="#addListModal">
                <i class="bi bi-plus-square fs-1"></i>
            </button>
        </div>
    @endif

    <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden" style="height: 100vh;">
        @foreach ($lists as $list)
            <div class="card flex-shrink-0 border-0 shadow-lg pastel-card" style="width: 18rem; max-height: 80vh;">
                <div class="card-header d-flex align-items-center justify-content-between bg-light-pink rounded-top">
                    <h4 class="card-title text-coquette fw-bold">{{ $list->name }}</h4>
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
                        <div class="card {{ $task->is_completed ? 'bg-secondary-subtle disabled-task' : '' }} cute-task-card">
                            <div class="card-header bg-light-lilac">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex justify-content-center gap-2">
                                        @if ($task->priority == 'high' && !$task->is_completed)
                                            <div class="spinner-grow spinner-grow-sm text-{{ $task->priorityClass }}" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        @endif
                                        <span class="fw-bold lh-1 m-0 text-{{ $task->priorityClass }} cute-text {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                            {{ $task->name }}
                                        </span>
                                    </div>
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
                                <p class="card-text text-truncate {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                    {{ $task->description }}
                                </p>
                            </div>
                            @if (!$task->is_completed)
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
                    <button type="button" class="btn btn-sm btn-outline-primary cute-btn" data-bs-toggle="modal"
                        data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                        <span class="d-flex align-items-center justify-content-center">
                            <i class="bi bi-plus fs-5"></i>
                            Tambah 
                        </span>
                    </button>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center bg-light-blue rounded-bottom">
                    <p class="card-text cute-text">{{ $list->tasks->count() }} Tugas</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="about-creator mt-70 text-center p-4 rounded shadow" style="background-color: #e99bb5;">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('images/WhatsApp Image 2025-02-19 at 10.13.01.jpeg')}}" class="d-block w-70" alt="..." style="width: 600px; height: 200px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>2023</h5>
                        <p>........</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/WhatsApp Image 2025-02-19 at 11.34.19.jpeg')}}" class="d-block w-70" alt="..."
                    style="width: 600px; height: 200px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>2024</h5>
                        <p>.......</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/OIP.jpg')}}" class="d-block w-70" alt="..."
                    style="width: 600px; height: 200px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <br>
        <br>
        <div style="background-color: PINK; border-radius: 80px;">
            <h5 class="text-coquette mb-3">Tentang Pembuat Halaman</h5>
            <p class="fw-bold">Halaman ini dibuat oleh DESI LISNAWATI.</p>
            <p class="text-muted">Pembuat to-do-list ini adalah seorang manusia yang mempunyai hobi menggambar, membuat kerajinan tangan atau pun kadang kadang dia menjadi anomali </p>
        </div>
        
        <div class="social-icons mt-3">
            <a href="https://github.com/DESIII457/to-do-app" class="text-decoration-none me-2" target="_blank">
                <i class="bi bi-github fs-4 text-coquette"></i>
            </a>
            <a href="[LINK_LINKEDIN]" class="text-decoration-none me-2" target="_blank">
                <i class="bi bi-facebook fs-4 text-coquette"></i>
            </a>
            <a href="https://www.instagram.com/desils._?igsh=bTEwNXgyMzR1NjN6" class="text-decoration-none" target="_blank">
                <i class="bi bi-instagram fs-4 text-coquette"></i>
            </a>
        </div>
    </div>
</div>
<style>
    .disabled-task {
        opacity: 0.5; /* Make the task card appear disabled */
        pointer-events: none; /* Disable all interactions except for the delete button */
    }
    p {
        margin: 5px 0; /* Atur jarak atas & bawah */
        padding: 0; /* Hilangkan padding jika ada */
    }
</style>
@endsection