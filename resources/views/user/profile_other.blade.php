@extends('pages.user', ['title' => 'Profile'])
@push('cssjsexternal')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('contentUser')
    <!--menu profiles-->
    <div class="flex items-start gap-8 p-4 max-w-screen-xl mx-auto px-8 py-20">
        {{-- <img src="{{ file_exists(public_path('profile/' . $profile->profile)) ? asset('/profile/' . $profile->profile) : asset('assets/users.png') }}"
            class="w-14 h-14 rounded-full" alt="" id="profile"> --}}
        <img src="" class="w-14 h-14 rounded-full" alt="" id="profile">




        <div class="flex flex-col">
            <strong class="text-2xl" id="username">saliz</strong>
            <div class="flex gap-4">
                <!-- Modal toggle -->
                <button data-modal-target="progress-modal" data-modal-toggle="progress-modal"
                    class="blockfocus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  text-center "
                    type="button" id="followers">
                    Followers
                </button>

                <!-- Main modal -->
                <div id="progress-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="progress-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5">

                                <h3>Followers</h3>
                                <hr class="mx-auto w-11/12 border-t border-gray-300 my-2">
                                <div class="flex flex-col overflow-y-auto  h-[250px]  scrollbar-hidden justify-start">
                                    <div class="flex justify-between w-full my-2">
                                        <div class="flex items-center">
                                            <img src="{{ asset('assets/kocheng-3.jpg') }}" class="w-10 h-10 rounded-full"
                                                alt="">
                                            <p class="text-sm font-bold ml-2">furkon saliz</p>
                                        </div>
                                        <div>
                                            <button class="hover:bg-green-100 rounded px-2">
                                                + follow
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex justify-between w-full my-2">
                                        <div class="flex items-center">
                                            <img src="/assets/kocheng.jpg" class="w-10 h-10 rounded-full" alt="">
                                            <p class="text-sm font-bold ml-2">furkon saliz</p>
                                        </div>
                                        <div>
                                            <button class="hover:bg-green-100 rounded px-2">
                                                + follow
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex justify-between w-full my-2">
                                        <div class="flex items-center">
                                            <img src="/assets/kocheng.jpg" class="w-10 h-10 rounded-full" alt="">
                                            <p class="text-sm font-bold ml-2">furkon saliz</p>
                                        </div>
                                        <div>
                                            <button class="hover:bg-green-100 rounded px-2">
                                                + follow
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex justify-between w-full my-2">
                                        <div class="flex items-center">
                                            <img src="/assets/kocheng.jpg" class="w-10 h-10 rounded-full" alt="">
                                            <p class="text-sm font-bold ml-2">furkon saliz</p>
                                        </div>
                                        <div>
                                            <button class="hover:bg-green-100 rounded px-2">
                                                + follow
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex justify-between w-full my-2">
                                        <div class="flex items-center">
                                            <img src="/assets/kocheng.jpg" class="w-10 h-10 rounded-full" alt="">
                                            <p class="text-sm font-bold ml-2">furkon saliz</p>
                                        </div>
                                        <div>
                                            <button class="hover:bg-green-100 rounded px-2">
                                                + follow
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex justify-between w-full my-2">
                                        <div class="flex items-center">
                                            <img src="/assets/kocheng.jpg" class="w-10 h-10 rounded-full" alt="">
                                            <p class="text-sm font-bold ml-2">furkon saliz</p>
                                        </div>
                                        <div>
                                            <button class="hover:bg-green-100 rounded px-2">
                                                + follow
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex justify-between w-full my-2">
                                        <div class="flex items-center">
                                            <img src="/assets/kocheng.jpg" class="w-10 h-10 rounded-full" alt="">
                                            <p class="text-sm font-bold ml-2">furkon saliz</p>
                                        </div>
                                        <div>
                                            <button class="hover:bg-green-100 rounded px-2">
                                                + follow
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal toggle -->
                <button data-modal-target="following-modal" data-modal-toggle="following-modal"
                    class="blockfocus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  text-center "
                    type="button" id="following">
                    Following
                </button>

                <!-- Main modal -->
                <div id="following-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="following-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5">

                                <h3>Following</h3>
                                <hr class="mx-auto w-11/12 border-t border-gray-300 my-2">
                                <div class="flex flex-col overflow-y-auto  h-[250px]  scrollbar-hidden justify-start">
                                    <div class="flex justify-between w-full my-2">
                                        <div class="flex items-center">
                                            <img src="/assets/kocheng.jpg" class="w-10 h-10 rounded-full" alt="">
                                            <p class="text-sm font-bold ml-2">furkon saliz</p>
                                        </div>
                                        <div>
                                            <button class="hover:bg-green-100 rounded px-2">
                                                + follow
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex justify-between w-full my-2">
                                        <div class="flex items-center">
                                            <img src="/assets/kocheng.jpg" class="w-10 h-10 rounded-full" alt="">
                                            <p class="text-sm font-bold ml-2">furkon saliz</p>
                                        </div>
                                        <div>
                                            <button class="hover:bg-green-100 rounded px-2">
                                                + follow
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex justify-between w-full my-2">
                                        <div class="flex items-center">
                                            <img src="/assets/kocheng.jpg" class="w-10 h-10 rounded-full" alt="">
                                            <p class="text-sm font-bold ml-2">furkon saliz</p>
                                        </div>
                                        <div>
                                            <button class="hover:bg-green-100 rounded px-2">
                                                + follow
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-sm mt-3" id="bio">
                {{-- {{ $profile->bio }} --}}
            </p>
        </div>
        <div id="tombolfollow">
            @csrf
            <button class="flex justify-start text-start    hover:bg-green-100 rounded-sm px-2">
                + follow
            </button>
            <div>

            </div>
        </div>
    </div>
    <!--end menu profiles-->


    {{-- <div class="mb-4 border-b border-gray-200 dark:border-gray-700 max-w-screen-xl mx-auto">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Upload</button>
            </li>
        </ul>
    </div> --}}
    <!-- Tambahkan sesuai kebutuhan untuk menampilkan informasi lainnya tentang user -->
    {{-- <h2 class="ml-96">{{ $userLain->username }}'s Profile</h2> --}}

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700 max-w-screen-xl mx-auto">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="indexdata-tab" data-tabs-target="#indexdata"
                    type="button" role="tab" aria-controls="indexdata" aria-selected="false">Upload</button>
            </li>
        </ul>
    </div>

    <div id="default-tab-content">
        <div class="hidden p-4 rounded-lg columns-1 gap-5 xl:p-2 lg:columns-5 mx-auto max-w-screen-xl mb-10"
            id="indexdata" id="indexdata" role="tabpanel" aria-labelledby="indexdata-tab">


        </div>
    </div>


    {{-- <div class="hidden p-4 rounded-lg columns-1 gap-5 xl:p-2 lg:columns-5 mx-auto max-w-screen-xl mb-10 " id="profile"
        role="tabpanel" aria-labelledby="profile-tab">
        <img src="{{ asset('foto/foto1707354209.png') }}" alt="">

        <div class="grid grid-cols-3 gap-4">
            @foreach ($tampilUpload as $foto)
                <div class="foto-item">
                    <img class="w-full h-auto" src="{{ asset('foto/' . $foto->url) }}" alt="Foto {{ $foto->id }}">
                    <img src="/foto/foto1707701521.jpg" alt="">
                    <!-- Tampilkan informasi lainnya mengenai foto jika diperlukan -->
                </div>
            @endforeach
        </div>


    </div> --}}



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endsection
@push('footerjsexternal')
    <script src="/js/profilother.js"></script>
@endpush
