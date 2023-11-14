<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function manual(Request $request)
    {
        $data['user'] = Auth::user();
        return view('panel.files.manual', $data);
    }
    public function marketing(Request $request)
    {
        return view('panel.files.marketing');
    }
    public function invoices(Request $request)
    {
        return view('panel.files.invoices');
    }
}
