<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function join()
    {
        return view('auth.join');
    }

    public function sendEmail(Request $request)
    {
        try {
            $data = $request->only(['username', 'country', 'email']);
            Mail::to('mail@brandfields.com')->send(new ContactMail($data));

            return response()->json(['status' => true]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => '']);
        }
    }
}
