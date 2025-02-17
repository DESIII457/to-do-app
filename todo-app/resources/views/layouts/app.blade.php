<!DOCTYPE html>
<html lang="en">
{{-- <!DOCTYPE html> → Menentukan bahwa dokumen ini menggunakan HTML5.
<html lang="en"> → Menentukan bahasa utama dokumen sebagai bahasa Inggris. --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta charset="UTF-8"> → Menentukan karakter encoding menjadi UTF-8 (agar bisa menampilkan berbagai karakter dengan benar).
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> → Mengatur tampilan agar responsif di perangkat mobile.
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> → Menginstruksikan browser untuk menggunakan mode terbaru dalam merender halaman. --}}
    <title>{{ $title ?? 'Default Title' }} - {{ config('app.name') }}</title>
    {{-- Blade syntax ({{ }}) → Digunakan dalam Laravel untuk mencetak variabel.
    {{ $title ?? 'Default Title' }} → Jika variabel $title tersedia, maka akan digunakan sebagai judul halaman. Jika tidak, default-nya adalah "Default Title".
    {{ config('app.name') }} → Mengambil nilai dari konfigurasi Laravel (config/app.php) untuk nama aplikasi. --}}

    <!-- Import bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    @include('partials.navbar') <!-- Mengambil component navbar -->

    @yield('content') <!-- Render content -->

    @include('partials.modal')

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script> <!-- Import bootstrap JS -->
</body>

</html>