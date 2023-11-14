<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class GroupsController extends Controller
{
    public function index(Request $request)
    {
        $authUser = $request->user();
        $users = User::where('id', '<>', $request->user()->id)->get();

        return view('panel.teams.index', compact('users', 'authUser'));
    }

    public function create_group(Request $request)
    {
        $id = Auth::user()->id;
        $data['is_me'] = $id === Auth::user()->id;
        $data['user'] = User::find($id);
        if (!isset($data['user']))
            $data['user'] = Auth::user();

        return view('panel.teams.create', $data);
    }
}
