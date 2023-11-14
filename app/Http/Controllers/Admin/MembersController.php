<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Profile;
use App\City;
use App\State;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
{
    public function index($userID = Null)
    {
        $id = $userID ? $userID : Auth::user()->id;
        $data['is_me'] = $id == Auth::user()->id;
        $data['user'] = $user = User::find($id);
        $data['authUser'] = Auth::user();
        if (!isset($user))
            return redirect()->route('dashboard');
        
        $data['city'] = City::find($user->profile->city) ? City::find($user->profile->city)->name : '';
        $data['state'] = State::find($user->profile->state) ? State::find($user->profile->state)->name : '';
        $data['country'] = Country::find($user->profile->country) ? Country::find($user->profile->country)->name : '';
        return view('admin.members.index', $data);
    }

    public function updateUserDetailInfo(Request $request) {
        $user = User::find($request->user_id);
        // $user->username = $request->username;
        if ($request->changePassword == 1) {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        $profile = $user->profile;
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->country = $request->country;
        $profile->street = $request->street_name;
        $profile->house_number = $request->house_number;
        // $profile->postal_code = $request->postal_code;
        $profile->save();
        
        return redirect()->route('members.index', ['userID' => $request->user_id])->with('success', 'Member Profile successfully updated');
    }

    public function updateAccountStatus(Request $request) {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => $request->status == 1 ? 'This account successfully unblocked' : 'This account successfully blocked']);
    }
}
