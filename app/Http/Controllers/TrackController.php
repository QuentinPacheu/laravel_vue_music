<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::all();

        return Inertia::render('Track/Index', [
            'tracks' => $tracks,
    ]);
    }

    public function create()
    {
        return Inertia::render('Track/Create');
    }

    public function store(Request $request)
    {
            $request->validate([
                'title'=> ['string','required','max:255'],
                'artist'=> ['string','required','max:255'],
                'display'=> ['boolean','required'],
                'image'=> ['image','required'],
                'music'=> ['file','required','extensions:mp3,wav'],
            ]);

            Track::created([
                'title'=> $request->title,
                'artist'=> $request->artist,
                'display'=> $request->display,
            ]);
    }
}
