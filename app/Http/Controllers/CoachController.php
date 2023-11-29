<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class CoachController extends Controller
{
    public function index($userID = null)
    {
        $userId = $userID ? $userID : auth()->user()->id;
        $user = User::find($userId);
        $data['authUser'] = auth()->user();

        $data['coaches'] = User::where('id', '<>', $data['authUser']->id)->where('user_type', '=', 2)->get();

        return view('panel.coaches.index', $data);
    }

    public function add($userID = null)
    {
        $sponsor_set_by_cookie = false;
        $sponsor = null;
        $referralCookie = Cookie::get('referral_id');

        if ($referralCookie) {
            $sponsor_user = User::where('customer_id', $referralCookie)->first();
            if ($sponsor_user) {
                $sponsor = $sponsor_user;
                $sponsor_set_by_cookie = true;
            }
        }

        $countries = Country::where('active', 1)->pluck('Name')->toArray();
        $phonecodes = Country::where('active', 1)->where('phonecode', '<>', 0)->orderBy('phonecode', 'asc')->select('phonecode')->distinct()->get()->all();

        return view('panel.coaches.add', ['sponsor' => $sponsor, 'referral_id' => $referralCookie, 'countries' => $countries, 'phonecodes' => $phonecodes]);

    }

    public function addNewCoach(Request $request)
    {
        $sponsor_user = null;

        if ($referralCookie = Cookie::get('referral_id')) {
            $sponsor_user = User::where('customer_id', $referralCookie)->first();
        }

        if ( ! isset($sponsor_user)) {

        }

        // 6 digit random number, unique in DB
        $attempt = 1;
        $attempt_max = 5;
        $customer_id = null;
        do {
            $customer_id = rand(100000, 999999);
            $attempt++;
        } while (User::where('customer_id', $customer_id)->exists() && $attempt <= $attempt_max);

        if ($attempt > $attempt_max) {
            Log::error('Could not generate unique customer_id');
            abort(500, 'Could not generate unique Customer ID. Please contact Support.');

            return redirect(route('coaches.add'))
                ->withErrors([
                    'message' => 'Could not generate unique Customer ID. Please contact Support.',
                ]);
        }

        $user = User::create([
            'customer_id' => $customer_id,
            'sponsor_id' => isset($sponsor_user) ? $sponsor_user->id : 0,
            'email' => $request->email,
            'user_type' => 2,
            'username' => 'coach--' . $customer_id,
            'password' => ' ',
            'status' => 0,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'street' => $request->street_name,
            'house_number' => $request->house_number,
            'postal_code' => $request->postal_code,
            'site_url' => $request->website,
            'city' => $request->city,
            'country' => $request->country,
            'birthday' => '2000-01-01',
            'gender' => 'f',
        ]);

        return redirect(route('coaches.index'));
    }
}
