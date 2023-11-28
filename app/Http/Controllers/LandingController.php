<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()) {
            return redirect()->route('dashboard');
        }

        return view('landing');
    }
}
