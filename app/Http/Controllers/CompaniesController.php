<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Profile;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class CompaniesController extends Controller
{
    public function index($userID = null)
    {
        $userId = $userID ? $userID : auth()->user()->id;
        $user = User::find($userId);
        $data['authUser'] = auth()->user();
        $data['companies'] = User::where('id', '<>', $data['authUser']->id)->where('user_type', '=', 1)->get();

        $data['city'] = City::find($user->profile->city) ? City::find($user->profile->city)->name : '';
        $data['state'] = State::find($user->profile->state) ? State::find($user->profile->state)->name : '';
        $data['country'] = Country::find($user->profile->country) ? Country::find($user->profile->country)->name : '';

        return view('panel.companies.index', $data);
    }

    public function likes(Request $request)
    {
        $authUserId = auth()->user()->id;
        $profile = Profile::find($request->id);
        $followers = [];
        $like = true;
        if ($profile->followers && count(explode(',', $profile->followers)) > 0) {
            $followers = explode(',', $profile->followers);
            if (in_array($authUserId, $followers)) {
                $index = array_search($authUserId, $followers);
                array_splice($followers, $index, 1);
                $like = false;
            } else {
                $followers[] = $authUserId;
            }
        } else {
            $followers[] = $authUserId;
        }
        $profile->followers = implode(',', $followers);
        $profile->save();

        return response()->json(['like' => $like, 'followers' => count($followers)]);
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

        return view('panel.companies.add', ['sponsor' => $sponsor, 'referral_id' => $referralCookie, 'countries' => $countries, 'phonecodes' => $phonecodes]);

    }

    public function addNewCompany(Request $request)
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
            'user_type' => 1,
            'username' => 'company--' . $customer_id,
            'password' => ' ',
            'status' => 0,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'first_name' => ' ',
            'last_name' => ' ',
            'company_name' => $request->company_name,
            'main_interests' => $request->products,
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

        return redirect(route('companies.index'));
    }
}
