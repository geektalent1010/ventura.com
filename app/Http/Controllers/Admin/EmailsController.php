<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EmailsController extends Controller
{
    public function index()
    {
        return view('admin.emails.index');
    }
}
