<?php
namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Models\Picmot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ImageController extends Controller{
    public function upload_image(UploadImageRequest $request){
        return view("motionwaiting");        
        //dd($files);
    }

    public function motion_wait(){
        return view("motionwaiting");
    }
}
  