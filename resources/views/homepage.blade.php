<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <style>
        .blur-backdrop-filter {
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }
    </style>
</head>

<body class="font-montserrat bg-bg">
    <nav
        class="bg-gren border-gren backdrop-blur-lg fixed w-full text-white bg-opacity-85 bg-clip-padding blur-backdrop-filter">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 mt-">
            <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">galleryFoto</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                    <li>
                        <a href="{{ route('login') }}"
                            class="block py-2 px-3 text-white hover:text-slate-950 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}"
                            class="block py-2 px-3 text-white hover:text-slate-950 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Registrasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- <div
      class="container text-5xl max-w-screen-xl items-center mx-auto p-4 mt-32 px-6"
    >
      <div class="w-full lg:w-1/2">
        <div class="">Selamat datang</div>
        <div class="">Di Website GalleryFoto</div>
      </div>

      <div class="w-full self-center lg:w-1/2">
        <img class="w-52 h-52" src="/dist/img/skeleton.jpg" alt="" />
      </div>
    </div> -->

    <!--section-->
    <section class="pt-44 lg:pt-20">
        <div class="container mx-auto max-w-screen-xl">
            <div class="flex flex-wrap">
                <div class="w-full self-center px-4 lg:w-1/2">
                    <h1 class="font-bold text-5xl mb-2">Selamat datang di GalleryPhoto</h1>
                    <span class="text-xs"> sebuah tempat di mana keindahan, kreativitas, dan inspirasi
                        bertemu dalam harmoni visual. Kami dengan bangga mengundang Anda untuk menjelajahi koleksi
                        eksklusif kami, sebuah persembahan gambar-gambar yang merefleksikan keajaiban dunia di sekitar
                        kita.</span>
                </div>
                <div class="w-full self-end px-4 lg:w-1/2">
                    <div class="mt-10">
                        <img class="max-w-full  mx-auto w-96 h-96" src="/assets/mountain_01.jpg" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="bg-ijobrown w-full h-auto lg:h-[500px]  mt-12 pb-2">
        <div class="font-bold text-2xl mx-auto items-center flex justify-center pt-10">
            Saatnya ber explore!
        </div>
        <div class="max-w-screen-2xl mx-auto flex flex-col lg:flex-row items-center justify-center gap-5 pt-14">

            <div class="bg-green-300  h-64 w-96">
                <div class="text-center mt-2">
                    <img src="{{ asset('assets/bg_01.png') }}" alt="">
                </div>
            </div>
            <div class="bg-green-300 h-64 w-96">
                <div class="text-center mt-2">
                    deskripsi
                </div>
            </div>
            <div class="bg-green-300 h-64 w-96">
                <div class="text-center mt-2">
                    deskripsi
                </div>
            </div>

        </div>
    </div>
    <!--end section-->
    {{-- <script src="/dist/js/script.js"></script> --}}
    @include('sweetalert::alert')
    {{-- <script src="/../../node_modules/flowbite/dist/flowbite.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>
