@extends('pages.user', ['title' => 'Profile'])
@push('cssjsexternal')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@section('contentUser')
    <!--menu profiles-->
    <div class="flex items-start gap-8 p-4 max-w-screen-xl mx-auto px-8 py-20">
        {{-- <img src="{{ asset('/profile/' . $profile->profile) }}" class="w-20 h-20 md:w-32 md:h-32" alt="" /> --}}
        <img src="{{ file_exists(public_path('profile/' . $profile->profile)) ? asset('/profile/' . $profile->profile) : asset('assets/users.png') }}"
            class="w-14 h-14 rounded-full" alt="">


        <div class="flex flex-col">
            <strong class="text-2xl">{{ Auth::user()->username }}</strong>
            <div class="flex gap-4">
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
                                <div class="flex flex-col overflow-y-auto  h-[250px]  scrollbar-hidden   
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
            <p class="text-sm mt-3">
                {{ $profile->bio }}
            </p>
        </div>

    </div>
    <!--end menu profiles-->

    <div class="flex items-center gap-4 p-4 max-w-screen-xl mx-auto px-8">
        <a href="{{ route('edit_profile') }}" class="bg-[#387780] text-white p-4 rounded-full">
            Edit Profile
        </a>


        <!-- Modal toggle -->
        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
            class="bg-[#387780] text-white p-4 rounded-full">
            Edit Password
        </button>

        <!-- Main modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Terms of Service
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <form action="{{ route('up_password') }} " method="post">
                            @csrf
                            <div class="mx-5 mb-2">
                                <label for="current-password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Current Password
                                </label>
                                <input type="password" id="current-password" name="current_password"
                                    class="block w-full p-2 rounded-lg ...">
                            </div>
                            <div class="mx-5 mb-2">
                                <label for="new-password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    New Password
                                </label>
                                <input type="password" id="new-password" name="new_password"
                                    class="block w-full p-2 rounded-lg ...">
                            </div>
                            <div class="mx-5 mb-2">
                                <label for="confirm-password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Confirm Password
                                </label>
                                <input type="password" id="confirm-password" name="new_password_confirmation"
                                    class="block w-full p-2 rounded-lg ...">
                            </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="default-modal" type="submit"
                            class="text-white bg-gren hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                            accept</button>
                        <button data-modal-hide="default-modal" type="button"
                            class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <div class="mb-4 border-b border-gray-200 dark:border-gray-700 max-w-screen-xl mx-auto">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Upload</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">Album</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content  ">
        <div class="hidden p-4 rounded-lg  columns-1 gap-5  xl:p-2 lg:columns-5 mx-auto max-w-screen-xl mb-10"
            id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @foreach ($tampilUpload as $foto)
                <a href="/uploaded">

                    <img src="/foto/{{ $foto->url }}" alt="{{ $foto->judul_foto }}"
                        class="max-w-full max-h-full mx-auto mt-4">
                </a>
            @endforeach

        </div>
        <div class="  rounded-lg bg-gray-50 dark:bg-gray-800  grid grid-cols-1 gap-5 p-6 xl:p-2 md:grid-cols-4 mx-auto max-w-screen-xl mb-10"
            id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            @foreach ($tampilAlbum as $album)
                <a href="{{ route('album.show', $album->id) }}">
                    <div class="bg-green-200 min-h-[200px] p-10 shadow-xl">
                        <!-- Tampilkan informasi album, misalnya nama album -->
                        <h3>{{ $album->nama_album }}</h3>
                        <p>{{ $album->deskripsi }}</p>
                    </div>
                </a>
            @endforeach


        </div>

    </div>



    <script src="/../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endsection
@push('footerjsexternal')
    <script src="/js/profilother.js"></script>
@endpush
