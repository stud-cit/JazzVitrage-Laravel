<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FotoGallery;
use App\Models\VideoGallery;
use Intervention\Image\ImageManagerStatic as Image;

class GalleryController extends Controller
{
    protected $publicStorage = '/img/uploads/';

    // Фото

    function getFoto() {
        $data = FotoGallery::orderBy('year', 'desc')->get();
        return response()->json($data);
    }
    function getFotoYear($year) {
        $data = FotoGallery::orderBy('created_at', 'asc')->where('year', '=', $year)->get();
        return response()->json($data);
    }
    function getJazzFoto() {
        $data = FotoGallery::orderBy('year', 'desc')->where('type', 'Джаз-Вітраж')->get();
        return response()->json($data);
    }
    function putFotoYear(Request $request) {
        foreach($request->id as $key => $value) {
            FotoGallery::where("foto_id", $value)->update(["year" => $request->year]);
        }
    }
    function postFoto(Request $request) {
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
            $img = Image::make(public_path().$this->publicStorage.$name);
            $img->save(public_path().$this->publicStorage.$name, 50);
        }
    }
    function deleteFoto(Request $request) {
        foreach($request->id as $key => $value) {
            $foto = FotoGallery::find($value);
            if($foto->delete()){
                unlink(public_path($this->publicStorage.$foto->file));
            }
        }
    }

    // Видео

    function getVideo() {
        $data = VideoGallery::orderBy('year', 'desc')->get();
        return response()->json($data);
    }
    function getVideoYear($year) {
        $data = VideoGallery::orderBy('created_at', 'asc')->where('year', $year)->get();
        return response()->json($data);
    }
    function postVideo(Request $request) {
        $model = new VideoGallery();
        $response = $model->create($request->all());
        return response()->json($response);
    }
    function putVideoYear(Request $request) {
        foreach($request->id as $key => $value) {
            VideoGallery::where("video_id", $value)->update(["year" => $request->year]);
        }
    }
    function deleteVideo(Request $request) {
        foreach($request->id as $key => $value) {
            VideoGallery::find($value)->delete();
        }
    }
}
