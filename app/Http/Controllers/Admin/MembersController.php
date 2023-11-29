<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MembersController extends Controller
{
    public function index($userID = null)
    {
        $id = $userID ? $userID : auth()->user()->id;
        $data['is_me'] = $id === auth()->user()->id;
        $data['user'] = $user = User::find($id);
        $data['authUser'] = auth()->user();
        if ( ! isset($user)) {
            return redirect()->route('dashboard');
        }

        $data['city'] = City::find($user->profile->city) ? City::find($user->profile->city)->name : '';
        $data['state'] = State::find($user->profile->state) ? State::find($user->profile->state)->name : '';
        $data['country'] = Country::find($user->profile->country) ? Country::find($user->profile->country)->name : '';

        return view('admin.members.index', $data);
    }

    public function updateUserDetailInfo(Request $request)
    {
        $user = User::find($request->user_id);
        // $user->username = $request->username;
        if (1 === $request->changePassword) {
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

    public function updateAccountStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 1 === $request->status ? 'This account successfully unblocked' : 'This account successfully blocked']);
    }
}
