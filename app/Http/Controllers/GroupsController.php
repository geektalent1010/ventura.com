<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index(Request $request)
    {
        $authUser = $request->user();
        $users = User::where('id', '<>', $request->user()->id)->get();

        return view('panel.teams.index', compact('users', 'authUser'));
    }

    public function createGroup(Request $request)
    {
        $id = auth()->user()->id;
        $data['is_me'] = $id === auth()->user()->id;
        $data['user'] = User::find($id);
        if ( ! isset($data['user'])) {
            $data['user'] = auth()->user();
        }

        return view('panel.teams.create', $data);
    }
}
