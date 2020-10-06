<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SummernoteUploadController extends Controller
{
    public function save(Request $request)
    {
        $destinationPath = '/media/summernote/';

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpeg,png,jpg|max:5000'], ['image.mimes' => 'Slika može biti formata: jpeg,png,jpg!']);
            $imageName = $request['image']->getClientOriginalName();
            $filenameCover = time() . $imageName;
            $request['image']->move(public_path() . $destinationPath, $filenameCover);
            return $destinationPath . $filenameCover;
        } else {
            return $request;
        }
    }
}
