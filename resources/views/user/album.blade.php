@extends('pages.user', ['title' => 'Album'])
@section('contentUser')
    <div class="max-w-screen-xl mx-auto gap-5 columns-1 lg:columns-5 p-3">
        @foreach ($album->foto as $foto)
            <img class="mb-2" src="/foto/{{ $foto->url }}" alt="{{ $foto->deskripsi }}">
        @endforeach
    </div>
@endsection
