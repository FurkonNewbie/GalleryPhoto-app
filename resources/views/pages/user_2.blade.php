<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GalleryPhoto</title>

    <!-- Include Alpine.js library -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script> --}}

    <!-- Other CDN scripts -->
    <link rel="website icon" type="img/png" href="{{ asset('assets/gf.jpg') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Hurricane&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">

    <!-- Additional styles -->
    <style>
        .blur-backdrop-filter {
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }
    </style>

    <!-- Additional external CSS/JS -->
    @stack('cssjsexternal')
</head>

<body class="font-montserrat bg-bg">
    <!--Navbar-->
    @include('layouts.navIndex')

    @yield('contentUser')
    <!--end menu profiles-->
    @include('sweetalert::alert')
    {{-- <script src="/../../node_modules/flowbite/dist/flowbite.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Additional external scripts -->
    @stack('footerjsexternal')
</body>

</html>
