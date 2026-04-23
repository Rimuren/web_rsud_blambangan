@extends('layouts.guest.guest')

@section('title', 'Photo Gallery')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">

    {{-- Header --}}
    <div class="flex items-center gap-2 mb-6 pb-4 border-b">
        <h1 class="text-lg font-bold tracking-widest uppercase">
            Photo Gallery
        </h1>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse($photos as $photo)
        <div class="border rounded-lg overflow-hidden bg-white hover:shadow">

            <img src="{{ $photo->gambar ? asset('storage/'.$photo->gambar) : asset('images/placeholder.jpg') }}"
                alt="{{ $photo->judul }}"
                class="w-full h-56 object-cover">

            <div class="p-3">
                <p class="font-semibold">{{ $photo->judul }}</p>

                <p class="text-xs text-gray-500 line-clamp-2">
                    {{ $photo->deskripsi }}
                </p>

                <span class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded">
                    {{ $photo->kategori }}
                </span>
            </div>

        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <p class="text-gray-500">Belum ada foto</p>
        </div>
        @endforelse

    </div>

    {{ $photos->links() }}

</div>
@endsection