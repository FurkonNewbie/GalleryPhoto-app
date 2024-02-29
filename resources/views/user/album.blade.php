@extends('pages.user', ['title' => 'Album'])
@section('contentUser')
    <div class="max-w-screen-xl mx-auto gap-5 columns-1 lg:columns-5 p-3">
        @foreach ($album->foto as $foto)
            <div class="flex flex-col">
                <img class="mb-2" src="/foto/{{ $foto->url }}" alt="">
                <p>{{ $foto->deskripsi }}</p>
            </div>
        @endforeach
    </div>
@endsection
