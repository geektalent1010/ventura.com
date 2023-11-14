<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function join() {
        return view('auth.join');
    }

    public function sendEmail(Request $request)
    {
        try { 
            $data = $request->only(['username', 'country', 'email']);
            Mail::to('mail@brandfields.com')->send(new ContactMail($data));
            return response()->json(['status' => true]);
        }
        catch (Exception $e) {
            return response()->json(['status' => false, 'message' => '']);
        }
    }
}
