<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Cloudinary;

class CloudinaryUploadController extends Controller
{
    protected $cloudinary;

    public function __construct(Cloudinary $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

//     public function upload(Request $request)
// {
//     // Validasi request
//     $request->validate([
//         'file' => 'required|mimes:jpg,jpeg,png|max:10240',
//     ]);

//     // Upload file ke Cloudinary
//     $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

//     return response()->json([
//         'message' => 'File uploaded successfully',
//         // 'url' => $uploadedFileUrl,
//     ]);
// }
    public function upload(Request $request)
        {

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);


            $filePath = $request->file('image')->getRealPath();
            $result = $this->cloudinary->uploadApi()->upload($filePath);

            $url = $result['secure_url'];

            return response()->json(['url' => $url]);
        }
}
