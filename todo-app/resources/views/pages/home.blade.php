@extends('layouts.app')

@section('content')
    <div id="content" class="overflow-y-hidden overflow-x-hidden">
        @if ($lists->count() == 0)
            <div class="d-flex flex-column align-items-center">
                <p class="fw-bold text-center">Belum ada tugas yang ditambahkan</p>
                <button type="button" class="btn btn-sm d-flex align-items-center gap-2 btn-outline-primary add-button">
                    <i class="bi bi-plus-square fs-3"></i> Tambah
                </button>
            </div>
        @endif
        <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden bg-light" style="height: 100vh;">
            @foreach ($lists as $list)
                <div class="card flex-shrink-0 shadow-lg rounded-4 border-0 bg-white" style="width: 18rem; max-height: 80vh;">
                    <div class="card-header d-flex align-items-center justify-content-between bg-dark text-white rounded-top-4">
                        <h4 class="card-title fw-bold">{{ $list->name }} 📝</h4>
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent">
                                <i class="bi bi-trash3-fill text-white fs-5"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">
                        @foreach ($tasks as $task)
                            @if ($task->list_id == $list->id)
                                <div class="card border-0 shadow-sm rounded-4 p-2">
                                    <div class="card-header bg-info-subtle rounded-top-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex flex-column gap-1">
                                                <a href="{{ route('tasks.show', $task->id) }}" class="fw-bold m-0 {{ $task->is_completed ? 'text-decoration-line-through text-muted' : 'text-dark' }}">
                                                    {{ $task->name }} 🏷️
                                                </a>
                                                <span class="badge text-bg-{{ $task->priorityClass }}" style="width: fit-content">
                                                    {{ $task->priority }} ⚡
                                                </span>
                                            </div>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent">
                                                    <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-truncate">📌 {{ $task->description }}</p>
                                    </div>
                                    @if (!$task->is_completed)
                                        <div class="card-footer bg-success-subtle rounded-bottom-4 text-center">
                                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success w-100 rounded-pill">
                                                    ✅ Selesai
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                        <button type="button" class="btn btn-sm btn-outline-primary add-button rounded-pill mt-2" data-bs-toggle="modal" data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                            ➕ Tambah Tugas
                        </button>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center rounded-bottom-4 bg-light">
                        <p class="card-text">📌 {{ $list->tasks->count() }} Tugas</p>
                    </div>
                </div>
            @endforeach
            <button type="button" class="btn btn-outline-primary flex-shrink-0 add-button rounded-pill shadow-lg" style="width: 18rem; height: fit-content;" data-bs-toggle="modal" data-bs-target="#addListModal">
                ➕ Tambah List
            </button>
        </div>
    </div>
    
    <style>
        .add-button {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            border: none;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            border-radius: 20px;
            padding: 10px 20px;
        }
        .add-button:hover {
            background: linear-gradient(135deg, #fad0c4, #ff9a9e);
            transform: scale(1.1);
        }
        .add-button i {
            transition: transform 0.3s ease-in-out;
        }
        .add-button:hover i {
            transform: rotate(360deg);
        }
    </style>
@endsection
