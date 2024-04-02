<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AlbumController extends Controller
{
//    public function __construct()
//    {
////        dd(111);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Album::create([
            'title' => $request->title
        ]);
        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album=Album::find($id);
        // $photos = $album->getMedia();
        $photos=Media::where('model_id',$id)->where('model_type','App\Models\Album')->get();
        return view('albums.show', compact('album', 'photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $album->update([
            'title' => $request->title
        ]);
        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album=Album::find($id);
        $album->delete();
        return redirect()->back();
    }

    public function upload(Request $request, Album $album)
    {
        if ($request->has('file')) {
            $album->addMedia($request->file)->toMediaCollection();
        }
        return redirect()->back();
    }

    public function showImage(Album $album, $id)
    {
        $media = $album->getMedia();
        $image = $media->where('id', $id)->first();
        return view('albums.image-show', compact('album', 'image'));
    }

    public function destroyImage(Album $album, $id)
    {
        $media = $album->getMedia();
        $image = $media->where('id', $id)->first();
        $image->delete();
        return redirect()->back();
    }

    public function removeImages(Request $request, $id)
    {
        $album=Album::find($id);
        if (Media::where('model_id',$id)->get()) {
            Media::where('model_id', $id)->update(['model_id'=>$request->album_id]);
        }
        $album->delete();
        return redirect()->back();
    }
}
