@extends('layouts.app')
{{-- Ini adalah direktif Blade yang digunakan untuk mengindikasikan bahwa file ini akan mewarisi (extend) layout dasar yang ada di layouts.app. Layout ini biasanya berisi struktur HTML umum seperti header, footer, dan elemen lainnya yang ingin Anda gunakan di banyak halaman. --}}

@section('content')
{{-- Fungsi: Ini adalah direktif Blade yang mendefinisikan bagian konten yang akan diisi dalam layout yang diwarisi. Bagian ini akan menggantikan placeholder @yield('content') yang ada di layout layouts.app. --}}
    <div id="content" class="row">
        <h1 class="mb-3">Halaman Details</h1>
        {{--  Ini adalah judul halaman yang ditampilkan dengan ukuran besar. Kelas mb-3 memberikan margin bawah (spacing) untuk memisahkan judul dari konten di bawahnya --}}
        <div class="row">
            {{-- Ini adalah elemen lain yang juga menggunakan kelas row, yang berarti di dalamnya akan ada kolom-kolom yang diatur dalam grid. --}}
            <div class="col-8">
                {{-- kolom yang mengambil 8 dari 12 bagian dalam sistem grid. Di dalam kolom ini, terdapat nama tugas dan deskripsi. --}}
                <h3 class="mb-2">{{ $task->name }}</h3>
                {{-- menampilkan nama tugas yang diambil dari objek $task. Tanda kurung kurawal ganda {{ }} adalah sintaks Blade untuk menampilkan data dari variabel. Kelas mb-2 memberikan margin bawah. --}}
                <p class="text-muted">{{ $task->description }}</p>
                {{-- Ini menampilkan deskripsi tugas yang diambil dari objek $task. Kelas text-muted memberikan warna teks yang lebih pudar, biasanya digunakan untuk menunjukkan informasi tambahan. --}}
            </div>
            <div class="col-4">
                {{--  kolom yang mengambil 4 dari 12 bagian dalam sistem grid. Di dalam kolom ini, terdapat badge untuk menunjukkan prioritas dan status tugas. --}}
                <span class="badge text-bg-{{ $task->priorityClass }} badge-pill" style="width: fit-content">
                    {{-- Fungsi: Ini menampilkan badge (label) untuk prioritas tugas. Kelas text-bg-{{ $task->priorityClass }} akan menghasilkan kelas CSS berdasarkan nilai priorityClass dari objek $task, yang mengatur warna latar belakang badge. Kelas badge-pill memberikan bentuk bulat pada badge. --}}
                    {{ $task->priority }}
                    {{-- Ini menampilkan nilai prioritas tugas yang diambil dari objek $task. --}}
                </span>
                <span class="badge text-bg-{{ $task->status ? 'success' : 'danger' }} badge-pill"
                    {{--  Ini menampilkan badge untuk status tugas. Jika $task->status bernilai true, badge akan memiliki kelas success (biasanya berwarna hijau), jika false, badge akan memiliki kelas danger (biasanya berwarna merah). Ini menunjukkan apakah tugas sudah selesai atau belum. --}}
                    style="width: fit-content">
                    {{ $task->status ? 'Selesai' : 'Belum Selesai' }}
                    {{-- Ini menampilkan teks "Selesai" jika $task->status bernilai true, dan "Belum Selesai" jika false. Ini memberikan informasi yang jelas tentang status tugas. --}}
                </span>
            </div>
        </div>
    </div>
@endsection
{{-- Ini menandakan akhir dari bagian konten yang didefinisikan dengan @section('content'). Ini penting untuk menandai batasan konten yang akan dimasukkan ke dalam layout. --}}