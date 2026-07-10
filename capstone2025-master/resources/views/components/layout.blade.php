<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    <!-- Tambah CDN SweetAlert2 di sini -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <title>Home</title>
</head>
<body>
    <x-nav-bar></x-nav-bar>
    <div class=" sm:ml-64 bg-[#f1f2f6]">
        <x-header>{{ $title }}</x-header>
        <main class="sm:64">
            {{ $slot }}
        </main>
    </div>
<script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    function saveAlert() {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data telah disimpan.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
    function deleteAlert() {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data telah dihapus!',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        
    }
    function editAlert() {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data telah disimpan.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
</script>
</body>
</html>
