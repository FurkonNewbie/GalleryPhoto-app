@extends('pages.user', ['title' => 'report'])
@section('contentUser')
    <div class="max-w-screen-md mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 p-6 pt-32">

        <div class="flex items-center justify-center w-full">
            <img src="/foto/{{ $foto->url }}" alt="{{ $foto->judul_foto }}" class="h-96 w-auto">
        </div>
        <div class="">

            <form method="post" action="/report/{{ $foto->id }}">
                @csrf
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Report</label>
                <textarea id="message" rows="4" name="deskripsi"
                    class="block h-72 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2"
                    placeholder="Write your thoughts here..."></textarea>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Report
                </button>
            </form>
        </div>
    </div>
@endsection
