<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Video_model;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video_model::latest()->paginate(12);

        return view('guest.galeri.video.index', compact('videos'));
    }
}
