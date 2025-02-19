<div class="modal fade" id="addListModal" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
    {{-- div.modal.fade → Elemen modal yang akan muncul ketika dipanggil.
        id="addListModal" → ID modal ini untuk memanggilnya dengan JavaScript atau tombol.
        tabindex="-1" → Agar modal tidak fokus saat ditampilkan.
        aria-labelledby="addListModalLabel" → Menghubungkan modal dengan judulnya.
        aria-hidden="true" → Modal tidak akan ditampilkan secara default. --}}
    <div class="modal-dialog">
        {{-- Menentukan modal sebagai kotak dialog. --}}
        <form action="{{ route('lists.store') }}" method="POST" class="modal-content">
            {{-- action="{{ route('lists.store') }}" → Form akan mengirim data ke route lists.store untuk menyimpan list.
            method="POST" → Metode HTTP untuk menambah data.
            class="modal-content" → Membungkus isi modal agar terlihat sebagai bagian dari pop-up. --}}
            @method('POST')
            @csrf
            {{-- @method('POST') → Laravel menggunakan ini untuk memastikan metode yang digunakan benar.
            @csrf → Token keamanan Laravel untuk mencegah serangan CSRF (Cross-Site Request Forgery).
            --}}
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addListModalLabel">Tambah List</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                {{--  menutup modal tanpa menyimpan perubahan. --}}
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukkan nama list">
                </div>
            </div>
            {{-- <label> → Label untuk input "Nama".
            <input> → Input teks untuk mengisi nama list.
            name="name" → Data ini akan dikirim ke backend saat form dikirim. --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            {{-- "Batal" → Menutup modal tanpa menyimpan.
            "Tambah" → Mengirim form untuk menambah list. --}}
        </form>
    </div>
</div>

<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    {{-- Hampir sama dengan modal list, tetapi ini digunakan untuk menambah tugas (task). --}}
    <div class="modal-dialog">
        <form action="{{ route('tasks.store') }}" method="POST" class="modal-content">
            {{-- Data tugas dikirim ke tasks.store saat form dikirim. --}}
            @method('POST')
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTaskModalLabel">Tambah Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="taskListId" name="list_id" hidden>
                {{-- id="taskListId" → Akan diisi dengan ID daftar tugas saat modal terbuka.
                name="list_id" → Ini dikirim agar tugas dimasukkan ke dalam daftar tugas yang benar.
                hidden → Tidak ditampilkan kepada pengguna. --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukkan nama list">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Masukkan deskripsi"></textarea>
                    {{-- <textarea> → Untuk deskripsi tugas.
                    rows="3" → Tinggi awal 3 baris. --}}
                </div>
                <div class="mb-3">
                    <label for="priority" class="form-label">Priority</label>
                    <select class="form-control" name="priority" id="priority">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                    {{-- <select> → Memilih tingkat prioritas tugas.
                    value="low", "medium", "high" → Disesuaikan dengan backend. --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            {{-- "Batal" → Menutup modal tanpa menyimpan.
            "Tambah" → Mengirim form untuk menambahkan tugas ke database. --}}
        </form>
    </div>
</div>
{{-- Modal #addListModal → Untuk menambahkan daftar tugas (Task List).
Modal #addTaskModal → Untuk menambahkan tugas ke daftar tertentu.
Form memiliki token CSRF untuk keamanan.
ID daftar tugas (list_id) disimpan tersembunyi agar tugas masuk ke list yang benar.
Menggunakan Bootstrap modal untuk tampilan yang lebih interaktif. --}}