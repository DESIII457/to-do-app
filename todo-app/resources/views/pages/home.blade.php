@extends('layouts.app')

@section('content')
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



        <div class="row my-3">
            <div class="col-6 mx-auto">
                <form action="{{ route('home') }}" method="GET" class="d-flex gap-5 coquette-form">
                    <input type="text" class="form-control coquette-input" name="query" placeholder="Cari tugas atau list..."
                        value="{{ request()->query('query') }}">
                    <button type="submit" class="btn btn-coquette">Cari</button>
                </form>
            </div>
        </div>

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
                            <div class="card {{ $task->is_completed ? 'bg-secondary-subtle' : '' }} cute-task-card">
                                <div class="card-header bg-light-lilac">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($task->priority == 'high' && !$task->is_completed)
                                                <div class="spinner-grow spinner-grow-sm text-{{ $task->priorityClass }}"
                                                    role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            @endif
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="fw-bold lh-1 m-0 text-decoration-none text-{{ $task->priorityClass }} cute-text {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                                {{ $task->name }}
                                            </a>
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
                                                    Selesai ✨
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
                                Tambah 🎀
                            </span>
                        </button>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center bg-light-blue rounded-bottom">
                        <p class="card-text cute-text">{{ $list->tasks->count() }} Tugas</p>
                    </div>
                </div>
            @endforeach
        
            @if ($lists->count() !== 0)
                <button type="button" class="btn btn-outline-primary flex-shrink-0 cute-btn"
                    style="width: 18rem; height: fit-content;" data-bs-toggle="modal" data-bs-target="#addListModal">
                    <span class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-plus fs-5"></i>
                        Tambah 🎀
                    </span>
                </button>
            @endif
        </div>
        
        <style>
            /* Warna pastel untuk tampilan coquette */
            .bg-light-pink { background-color: #fce4ec; }
            .bg-light-lilac { background-color: #ede7f6; }
            .bg-light-peach { background-color: #ffebcd; }
            .bg-light-blue { background-color: #e3f2fd; }
        
            /* Card tampilan soft dan feminin */
            .pastel-card {
                background: white;
                border-radius: 20px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                
            }
            .pastel-card:hover {
                
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            }
        
            /* Teks aesthetic */
            .text-coquette {
                font-family: 'Dancing Script', cursive;
                color: #d81b60;
            }
            .cute-text {
                font-family: 'Poppins', sans-serif;
                font-weight: 500;
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
        
            /* Icon dan efek lembut */
            .cute-btn i {
                color: white;
                margin-right: 5px;
            }
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
        </style>        
    </div>
@endsection