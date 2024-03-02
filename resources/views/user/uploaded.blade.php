@extends('pages.user', ['title' => 'uploaded'])
@section('contentUser')
    <div class="relative overflow-x-auto pt-32 max-w-screen-xl mx-auto ">
        <table class="w-auto lg:w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                        judul foto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        album
                    </th>
                    <th scope="col" class="px-6 py-3 rounded-e-lg">
                        desc
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datafoto as $index => $foto)
                    <tr class="bg-white dark:bg-gray-800">
                        <td class="px-6 py-4">
                            {{ $index + 1 }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $foto->judul_foto }}
                        </th>
                        <td class="px-6 py-4">
                            {{ optional($foto->album)->nama_album }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex ">
                                <div class="mx-2">
                                    <a href="">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                                <div class="mx-2">
                                    <a href="{{ route('edit_upload.edit', $foto) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                                <div class="mx-2">
                                    <form action="{{ route('photos.destroy', $foto) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this photo?')"
                                            class="text-red-600">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach


            </tbody>

        </table>
    </div>
@endsection
