<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validasi request (pastikan file ada dan sesuai dengan tipe file yang diinginkan)
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', // contoh validasi: hanya file gambar dan pdf dengan ukuran max 2MB
        ]);

        // Ambil file dari request
        $file = $request->file('file');

        // Simpan file di direktori 'public/uploads'
        $path = $file->store('uploads', 'public');

        // Response dengan URL file yang di-upload
        return response()->json([
            'message' => 'File uploaded successfully',
            'file_path' => asset('storage/' . $path)
        ]);
    }
}
