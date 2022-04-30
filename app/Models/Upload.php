<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    public static function image($request, $filename, $path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image = $request->$filename;
        $imageName = $image->getClientOriginalName();
        return ["image" => $image, "imageName" => $imageName];
    }
}
