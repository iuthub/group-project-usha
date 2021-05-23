<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public function UserImageUpload($query) // Taking input image as parameter
    {
        $image_name = \Str::random(20);
        $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name . '.' . $ext;
        $upload_path = 'image/';    //Creating Sub directory in Public folder to put image
        $image_url = $upload_path . $image_full_name;
        $success = $query->move($upload_path, $image_full_name);

        return $image_url; // Just return image
    }

    public function UserOnlyImageUpload($query)
    {
        $image_name = \Str::random(20);
        $image_array_1 = explode(";", $query);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_full_name = $image_name . ".png";
        $upload_path = 'image/';    //Creating Sub directory in Public folder to put image
        $image_url = $upload_path . $image_full_name;
        $success = file_put_contents($upload_path . $image_full_name, $data);
        return $image_url;
    }
}