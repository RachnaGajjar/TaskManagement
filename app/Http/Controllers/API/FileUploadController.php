<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Validator;
class FileUploadController extends Controller
{
    //
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'file' => 'required|mimes:doc,docx,pdf,txt,csv|max:2048',
      ]);
      if($validator->fails()) 
      {          
            return response()->json(['error'=>$validator->errors()], 401);                        
        } 
     if($file = $request->file('file')) {
        $path = $file->store('public/files');
        $name = $file->getClientOriginalName();

        //store your file into directory and db
        $save = new File();
        $save->name = $file;
        $save->path= $path;
        $save->save();
          
        return response()->json([
            "success" => true,
            "message" => "File successfully uploaded",
            "file" => $file
        ]);

    }


}
}