@extends('pages.user', ['title' => 'edit profile'])
@section('contentUser')
    <div class="py-20 max-w-screen-md mx-auto flex flex-col lg:flex-row justify-center gap-4 px-5">
        <div
            class="bg-white shadow-xl w-full rounded-lg h-60 flex flex-col justify-center items-center lg:w-[266px] lg:h-[288px] px-2">
            <div class="bg-slate-700 rounded-full w-24 h-24 ">

            </div>
            <form action="{{ route('up_profile') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- <form action="{{ route('up_fotoprofile') }}" method="POST" enctype="multipart/form-data"> --}}

                {{-- @csrf --}}

                <div class="mx-2">
                    <input
                        class="block mt-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" name="profile" type="file">
                </div>
                {{-- </form> --}}
        </div>


        <div class="bg-white shadow-xl rounded-lg w-full h-[525px] lg:w-[555px] lg:h-[500px] ">
            <div class="ml-[13px] p-4">Edit Profile</div>
            <div class="p-2">

                <div class="mx-5 mb-2">
                    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        lengkap
                    </label>
                    <input type="text" id="small-input" name="username" value="{{ $profile->username }}"
                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mx-5 mb-2">
                    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email
                    </label>
                    <input type="email" id="small-input" name="email" value="{{ $profile->email }}"
                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mx-5 mb-2">
                    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">bio
                    </label>
                    <input type="text" id="small-input" name="bio" value="{{ $profile->bio }}"
                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mx-5 mb-2">
                    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nomor
                        telp
                    </label>
                    <input type="number" id="small-input" name="no_telepon" value="{{ $profile->no_telepon }}"
                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mx-5 mb-2">
                    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">alamat
                    </label>
                    <input type="text" id="small-input" name="alamat" value="{{ $profile->alamat }}"
                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mx-5 mb-2">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Default</button>
                </div>
                </form>
            </div>

        </div>

    </div>

    <!--menu profiles-->
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endsection
