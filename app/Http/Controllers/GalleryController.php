<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FotoGallery;
use App\Models\VideoGallery;

class GalleryController extends Controller
{
    protected $publicStorage = '/img/uploads/';

    public function getFoto()
    {
        $data = FotoGallery::orderBy('created_at', 'asc')->get();
        return response()->json($data);
    }
    public function postFoto(Request $request)
    {
        $this->validate($request, [
            'filenames.*' => 'mimes:jpeg'
        ]);

        $uploadedFiles = $request->pics;

        foreach ($uploadedFiles as $file){
            $foto = new FotoGallery;

            $name = time().'-'.$file->getClientOriginalName();
            $file->move(public_path().$this->publicStorage, $name);

            $foto->file = $name;
            $foto->type = $request->type;
            $foto->year = $request->year;
            $foto->save();
        }
    }
    public function deleteFoto($id)
    {
        $foto = FotoGallery::find($id);
        if($foto->delete()){
            unlink(public_path($this->publicStorage.$foto->file));
        }
    }

    public function getVideo()
    {
        $data = VideoGallery::orderBy('created_at', 'asc')->get();
        return response()->json($data);
    }
    public function postVideo(Request $request)
    {
        $video = new VideoGallery;
        $video->url = $request->url;
        $video->save();
    }
    public function deleteVideo($id)
    {
        $video = VideoGallery::find($id);
        $video->delete();
    }
}
