<!-- Navbar dengan kelas Bootstrap untuk styling -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top shadow-sm">
    {{-- navbar: Kelas utama untuk membuat navbar Bootstrap.
        navbar-expand-lg: Navbar akan bersifat responsif dan hanya menyusut pada layar kecil.
        bg-dark navbar-dark: Navbar berwarna gelap dengan teks berwarna putih.
        fixed-top: Navbar tetap di bagian atas saat halaman di-scroll.
        shadow-sm: Menambahkan efek bayangan kecil pada navbar. --}}
    <div class="container d-flex justify-content-between">
        {{-- container: Membuat layout agar lebih rapi sesuai grid Bootstrap.
        d-flex: Menggunakan flexbox untuk pengaturan tata letak elemen.
        justify-content-between: Menjadikan elemen di dalamnya tersebar ke kiri dan kanan. --}}
        
        <!-- Bagian kiri navbar yang berisi logo atau nama aplikasi -->
        <div class="d-flex align-items-center">
            <!-- Link menuju halaman utama dengan nama aplikasi diambil dari konfigurasi -->
            <a class="navbar-brand fw-bolder text-uppercase" href="#">{{ config('app.name') }}</a>
            {{-- navbar-brand: Kelas Bootstrap untuk menampilkan logo atau nama aplikasi.
            fw-bolder: Mengatur teks agar lebih tebal.
            text-uppercase: Mengubah teks menjadi huruf kapital.
            href="#": Menjadikan teks sebagai tautan (nantinya bisa diarahkan ke halaman utama).
            {{ config('app.name') }}: Mengambil nama aplikasi dari konfigurasi (mungkin dalam Laravel/PHP). --}}
        </div>

        <!-- Form pencarian -->
        <form class="d-flex bg-light rounded-3 p-1" role="search" 
              style="max-width: 300px; background-color: #af32af;">
            {{-- d-flex: Menggunakan flexbox untuk pengaturan tata letak.
            bg-light: Memberikan latar belakang warna terang (putih).
            rounded-3: Membuat sudut elemen menjadi melengkung.
            p-1: Memberikan padding kecil agar tidak terlalu sempit.
            max-width: 300px: Membatasi lebar maksimal form pencarian.
            background-color: #af32af: Warna ungu khusus untuk latar belakang form. --}}

            <!-- Input pencarian dengan placeholder -->
            <input class="form-control border-0 me-2" type="search" 
                   placeholder="Cari tugas..." aria-label="Search"
                   style="box-shadow: none; background-color: #ffebef;">
                   {{-- form-control: Kelas Bootstrap untuk styling input form.
                    border-0: Menghapus garis tepi input.
                    me-2: Memberikan margin-end (jarak ke tombol).
                    type="search": Menandakan input sebagai kolom pencarian.
                    placeholder="Cari tugas...": Teks petunjuk dalam kolom pencarian.
                    aria-label="Search": Memberikan deskripsi aksesibilitas untuk pengguna screen reader.
                    box-shadow: none: Menghilangkan efek bayangan pada input.
                    background-color: #ffebef: Warna pink muda untuk latar belakang input. --}}

            <!-- Tombol pencarian dengan ikon search -->
            <button class="btn text-white" type="submit" 
                    style="background-color: #ff69b4;">
                <i class="bi bi-search"></i>
            </button>
            {{-- btn: Kelas dasar Bootstrap untuk tombol.
            text-white: Membuat teks/ikon dalam tombol berwarna putih.
            type="submit": Menjadikan tombol untuk mengirim form pencarian.
            background-color: #ff69b4: Warna pink terang untuk tombol.
            <i class="bi bi-search"></i>: Menggunakan ikon Bootstrap Icons untuk simbol pencarian. --}}
        </form>
    </div>
</nav>
