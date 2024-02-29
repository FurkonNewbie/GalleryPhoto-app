@extends('pages.user', ['title' => 'Comment'])
@push('cssjsexternal')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('contentUser')
    <div class="flex flex-col lg:flex-row mx-auto justify-center my-7 gap-4 px-2">

        <div class="bg-white   shadow-xl rounded-lg w-full h-auto lg:w-[550px] ">
            <div class="flex justify-end mr-2 my-1">




            </div>


            <div class="flex pr-4 pl-4 pt-2 justify-between">
                <div class="flex">
                    <img src="" class="w-8 h-8" alt="" id="profile">
                    <div class="flex flex-col ml-2">
                        <h3 class="text-sm" id="username">Fukorn</h3>
                        <h6 class="text-xs" id="tanggal">12.00pm</h6>
                    </div>
                </div>
                <div id="tombolfollow">
                    <button class="hover:bg-green-100 rounded-sm px-2">
                        + follow
                    </button>
                </div>
            </div>

            <div class="text-xs px-4 pt-2 mb-2" id="deskripsi">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, asperiores. Maiores molestias dolore
                unde iusto repellendus perferendis laboriosam, aperiam quae.
            </div>
            <div class="overflow-hidden flex justify-center mb-2">
                <img src="" alt="" class="w-80 rounded-md" id="fotodetail">
            </div>
            <hr class="mx-auto w-11/12 border-t border-gray-300">
        </div>
        <div class="w-full lg:w-[450px] h-96 bg-white shadow-xl rounded-xl  px-4 mb-5">
            <div class="p-4 text-xl ">komen</div>
            <hr class="mx-auto w-11/12 border-t border-gray-300">
            <div class="relative flex flex-col p-2 justify-between overflow-auto  h-[250px]  scrollbar-hidden"
                id="listkomentar">
                {{--
                <div class="flex mb-3">
                    <img src="/assets/users.png" class="w-10 h-10" alt="" />
                    <div class="flex flex-col">
                        <h3 class="text-md mx-2">Furqon saliz</h3>
                        <h5 class="text-xs mx-2">
                            Fotonya sangat Bagus Sekali, apakah saya bisa memintanya
                        </h5>
                    </div>
                </div>
                <div class="flex mb-3">
                    <img src="/assets/users.png" class="w-10 h-10" alt="" />
                    <div class="flex flex-col">
                        <h3 class="text-md mx-2">Furqon saliz</h3>
                        <h5 class="text-xs mx-2">
                            Fotonya sangat Bagus Sekali, apakah saya bisa memintanya
                        </h5>
                    </div>
                </div>
                <div class="flex mb-3">
                    <img src="/assets/users.png" class="w-10 h-10" alt="" />
                    <div class="flex flex-col">
                        <h3 class="text-md mx-2">Furqon saliz</h3>
                        <h5 class="text-xs mx-2">
                            Fotonya sangat Bagus Sekali, apakah saya bisa memintanya
                        </h5>
                    </div>
                </div>
                <div class="flex mb-3">
                    <img src="/assets/users.png" class="w-10 h-10" alt="" />
                    <div class="flex flex-col">
                        <h3 class="text-md mx-2">Furqon saliz</h3>
                        <h5 class="text-xs mx-2">
                            Fotonya sangat Bagus Sekali, apakah saya bisa memintanya
                        </h5>
                    </div>
                </div>
                <div class="flex mb-3">
                    <img src="/assets/users.png" class="w-10 h-10" alt="" />
                    <div class="flex flex-col">
                        <h3 class="text-md mx-2">Furqon saliz</h3>
                        <h5 class="text-xs mx-2">
                            Fotonya sangat Bagus Sekali, apakah saya bisa memintanya
                        </h5>
                    </div>
                </div>
                <div class="flex mb-3">
                    <img src="/assets/users.png" class="w-10 h-10" alt="" />
                    <div class="flex flex-col">
                        <h3 class="text-md mx-2">Furqon saliz</h3>
                        <h5 class="text-xs mx-2">
                            Fotonya sangat Bagus Sekali, apakah saya bisa memintanya
                        </h5>
                    </div>
                </div>
                <div class="flex mb-3">
                    <img src="/assets/users.png" class="w-10 h-10" alt="" />
                    <div class="flex flex-col">
                        <h3 class="text-md mx-2">Furqon saliz</h3>
                        <h5 class="text-xs mx-2">
                            Fotonya sangat Bagus Sekali, apakah saya bisa memintanya
                        </h5>
                    </div>
                </div>
                <div class="flex mb-3">
                    <img src="/assets/users.png" class="w-10 h-10" alt="" />
                    <div class="flex flex-col">
                        <h3 class="text-md mx-2">Furqon saliz</h3>
                        <h5 class="text-xs mx-2">
                            Fotonya sangat Bagus Sekali, apakah saya bisa memintanya
                        </h5>
                    </div>
                </div>
                <div class="flex mb-3">
                    <img src="/assets/users.png" class="w-10 h-10" alt="" />
                    <div class="flex flex-col">
                        <h3 class="text-md mx-2">Furqon saliz</h3>
                        <h5 class="text-xs mx-2">
                            Fotonya sangat Bagus Sekali, apakah saya bisa memintanya
                        </h5>
                    </div>
                </div>
                <div class="flex mb-3">
                    <img src="/assets/users.png" class="w-10 h-10" alt="" />
                    <div class="flex flex-col">
                        <h3 class="text-md mx-2">Furqon saliz</h3>
                        <h5 class="text-xs mx-2">
                            Fotonya sangat Bagus Sekali, apakah saya bisa memintanya
                        </h5>
                    </div>
                </div> --}}


            </div>

            <div class="flex gap-2">
                @csrf
                <div class="mt-4">
                    <input type="text" id="small-input" name="isi_komentar"
                        class="block lg:w-80 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="komen disini">
                </div>
                <button onclick="kirimkomentar()"
                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 text-xs rounded-full  px-5 text-center me-2 mt-4 h-10">kirim</button>
            </div>
        </div>
    </div>
    <script src="/js/indexdetail.js"></script>
@endsection
@push('footerjsexternal')
    {{-- <script src="/js/indexdetail.js"></script> --}}
@endpush
