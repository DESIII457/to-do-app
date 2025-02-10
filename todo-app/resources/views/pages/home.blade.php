@extends('layouts.app')

@section('content')
    <div id="content" class="overflow-y-hidden overflow-x-hidden">
        {{-- Atribut id dalam HTML adalah cara untuk memberi nama khusus pada bagian tertentu dari halaman web. Misalnya, jika kita punya bagian yang berisi konten utama, kita bisa memberi nama "content" pada bagian itu dengan menulis id="content". --}}
        @if ($lists->count() == 0)
            <div class="d-flex flex-column align-items-center">
                <p class="fw-bold text-center">Belum ada tugas yang ditambahkan</p>
                <button type="button" class="btn btn-sm d-flex align-items-center gap-2 btn-outline-primary"
                    style="width: fit-content;">
                    <i class="bi bi-plus-square fs-3"></i> Tambah
                </button>
            </div>
            {{-- Tag <div> dalam HTML adalah elemen yang digunakan untuk mengelompokkan konten atau elemen lain di dalam halaman web. --}}
        @endif
        <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden" style="height: 100vh;">
            {{-- d-flex: Ini biasanya berasal dari framework CSS seperti Bootstrap. Kelas ini membuat elemen menjadi "flex container", yang berarti elemen di dalamnya akan diatur dalam satu baris atau kolom dengan cara yang fleksibel. --}}

            {{-- gap-3: Ini menambahkan jarak (gap) antara elemen di dalam flex container. Angka "3" biasanya menunjukkan ukuran jarak yang ditentukan oleh framework. --}}

            {{-- px-3: Ini memberikan padding (ruang di dalam) di sisi kiri dan kanan elemen. Sama seperti sebelumnya, "3" menunjukkan ukuran padding yang ditentukan --}}

            {{-- flex-nowrap: Kelas ini memastikan bahwa elemen di dalam flex container tidak akan membungkus ke baris berikutnya. Semua elemen akan tetap berada dalam satu baris, meskipun mungkin akan melampaui lebar tampilan. --}}

            {{-- overflow-y-hidden: Ini berarti jika konten di dalam elemen lebih tinggi daripada tinggi elemen, bagian yang melampaui tinggi tersebut tidak akan terlihat (disembunyikan) dan tidak akan ada scrollbar vertikal. --}}

            {{-- height: 100vh: Ini berarti tinggi elemen akan sama dengan 100% dari tinggi viewport (area tampilan) browser. Jadi, elemen ini akan mengambil seluruh tinggi layar yang terlihat oleh pengguna. --}}
            @foreach ($lists as $list)
                <div class="card flex-shrink-0" style="width: 18rem; max-height: 80vh;">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="card-title">{{ $list->name }}</h4>
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm p-0">
                                <i class="bi bi-trash fs-5 text-danger"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">
                        @foreach ($tasks as $task)
                            @if ($task->list_id == $list->id)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex flex-column justify-content-center gap-2">
                                                <a href="{{ route('tasks.show', $task->id) }}"
                                                    class="fw-bold lh-1 m-0 {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                                    {{ $task->name }}
                                                </a>
                                                <span class="badge text-bg-{{ $task->priorityClass }} badge-pill"
                                                    style="width: fit-content">
                                                    {{ $task->priority }}
                                                </span>
                                            </div>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm p-0">
                                                    <i class="bi bi-x-circle text-danger fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-truncate">
                                            {{ $task->description }}
                                        </p>
                                    </div>
                                    @if (!$task->is_completed)
                                        <div class="card-footer">
                                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-primary w-100">
                                                    <span class="d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-check fs-5"></i>
                                                        Selesai
                                                    </span>
                                                </button>
                                            </form>

                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                            <span class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-plus fs-5"></i>
                                Tambah
                            </span>
                        </button>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="card-text">{{ $list->tasks->count() }} Tugas</p>
                    </div>
                </div>
            @endforeach
            <button type="button" class="btn btn-outline-primary flex-shrink-0" style="width: 18rem; height: fit-content;"
                data-bs-toggle="modal" data-bs-target="#addListModal">
                <span class="d-flex align-items-center justify-content-center">
                    <i class="bi bi-plus fs-5"></i>
                    Tambah
                </span>
            </button>
        </div>
    </div>
@endsection