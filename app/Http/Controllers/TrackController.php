<?php

namespace App\Http\Controllers;

use inertia\Inertia;
use App\Models\Track;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::where('display', true)->orderBy('title')->get();

        return inertia::render('Track/Index', [
            'tracks' => $tracks,
        ]);
    }

    public function create()
    {
        return inertia::render('Track/Create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=> ['string','required','max:255'],
            'artist'=> ['string','required','max:255'],
            'display'=> ['boolean','required'],
            'image'=> ['image','required'],
            'music'=> ['file','required','extensions:mp3,wav'],
        ]);

        $uuid = Str::uuid();

        $extensionImage = $request->image->extension();
        $imagePath = $request->image->storeAs('track/images', $uuid . '.' . $extensionImage);

        $extensionMusic = $request->music->extension();
        $musicPath = $request->music->storeAs('track/musics', $uuid . '.' . $extensionMusic);

        Track::create([
            'uuid'=> 'trk-' . $uuid,
            'title'=> $request->title,
            'artist'=> $request->artist,
            'display'=> $request->display,
            'image'=> $imagePath,
            'music'=> $musicPath,
        ]);

        return redirect()->route('track.index');
    }

    public function edit(Track $track)
    {
        return Inertia::render('Track/Edit', [
            'track' => $track,
        ]);
    }
    public function update(Request $request, Track $track)
    {
        $request->validate([
            'title'=> ['string','required','max:255'],
            'artist'=> ['string','required','max:255'],
            'display'=> ['boolean','required'],
        ]);

        $track->title = $request->title;
        $track->artist = $request->artist;
        $track->display = $request->display;
        $track->save();

        return redirect()->route('track.index');
    }

    public function destroy(Track $track)
    {
        $track->delete();
        return redirect()->route('track.index');
    }
}