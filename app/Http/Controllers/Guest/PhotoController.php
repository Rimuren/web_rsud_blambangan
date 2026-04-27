<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Photo_model;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo_model::latest()->paginate(12);

        return view('guest.galeri.foto.index', compact('photos'));
    }
}
