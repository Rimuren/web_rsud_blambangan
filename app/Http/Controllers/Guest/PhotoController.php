<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->paginate(12);

        return view('guest.galeri.foto.index', compact('photos'));
    }
}
