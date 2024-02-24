@extends('pages.user_2', ['title' => 'index'])

@push('cssjsexternal')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('contentUser')
    <div class="py-20 flex flex-col lg:flex-row mx-auto max-w-5xl gap-6 px-5 ">
        <!-- Your existing code here... -->
        <div class="bg-white   shadow-xl rounded-lg w-full h-36 lg:w-52 lg:h-[288px]">

            <div class="bg-gray-200 w-14 h-14 rounded-full flex justify-center items-center text-center mx-auto mt-5">
                <img src="{{ file_exists(public_path('profile/' . $profile->profile)) ? asset('/profile/' . $profile->profile) : asset('assets/users.png') }}"
                    class="w-14 h-14 rounded-full" alt="">



            </div>
            <div class="text-xs mx-auto text-center mt-1">
                <div>
                    Welcome {{ Auth::user()->username }}
                </div>
                <div>
                    {{ Auth::user()->email }}
                </div>
            </div>

        </div>

        {{-- <i class="${x.idUserLike === x.useractive ?  'bi-suit-heart text-red-900': 'bi-suit-heart'}  bi bi-suit-heart-fill mr-2 "></i> --}}
        <!-- main content-->
        @csrf
        <div class="flex flex-col gap-4" id="indexdata">
        </div>
        <!--end main content-->
    </div>

    @include('sweetalert::alert')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2"></script> <!-- Include Alpine.js library --> --}}
@endsection

@push('footerjsexternal')
    <script src="/js/index.js"></script>
@endpush
