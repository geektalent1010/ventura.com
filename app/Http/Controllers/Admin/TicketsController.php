<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TicketsController extends Controller
{
    public function index()
    {
        return view('admin.tickets.index');
    }
}
