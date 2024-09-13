<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validasi input JSON
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
        ]);


        $email = $request->input('email');
        $messageContent = $request->input('message');

        Mail::raw($messageContent, function ($message) use ($email) {
            $message->to($email)
                    ->subject('Pesan Baru dari Warehouse');
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Email sent successfully'
        ]);
    }
}
