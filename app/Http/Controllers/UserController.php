<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Friend;
use App\Models\Profile;
use App\Models\State;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the My Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($userID = null)
    {
        $userId = $userID ? $userID : auth()->user()->id;
        $data['authUser'] = auth()->user();
        $data['is_me'] = $userId == auth()->user()->id;
        $data['user'] = $user = User::find($userId);
        if (! isset($user)) {
            return redirect()->route('profile');
        }
        $friendIds = Friend::where('user_id', '=', $user->id)->pluck('connected_user_id')->toArray();
        $data['friends'] = User::where('user_type', '=', 0)->whereIn('id', $friendIds)->get();
        $data['groups'] = Team::where('user_id', '=', $user->id)->pluck('name')->toArray();
        $data['city'] = City::find($user->profile->city) ? City::find($user->profile->city)->name : '';
        $data['state'] = State::find($user->profile->state) ? State::find($user->profile->state)->name : '';
        $data['country'] = Country::find($user->profile->country) ? Country::find($user->profile->country)->name : '';

        if ($user->user_type === 1) {
            return view('panel.company.profile', $data);
        } elseif ($user->user_type === 2) {
            return view('panel.coaches.profile', $data);
        } else {
            return view('panel.individual.profile', $data);
        }
    }

    public function edit()
    {
        $data['user'] = $user = auth()->user();
        $friendIds = Friend::where('user_id', '=', $user->id)->pluck('connected_user_id')->toArray();
        $data['friends'] = User::where('user_type', '=', 0)->whereIn('id', $friendIds)->get();
        $city = '';
        $state = '';
        $country = '';
        $addressStatus = false;

        $data['address'] = $city.', '.$state.', '.$country;
        $data['selected_address'] = $user->profile->city.','.$user->profile->state.','.$user->profile->country;
        $data['addressStatus'] = $addressStatus;

        $data['city'] = City::find($user->profile->city) ? City::find($user->profile->city)->name : '';
        $data['state'] = State::find($user->profile->state) ? State::find($user->profile->state)->name : '';
        $data['country'] = Country::find($user->profile->country) ? Country::find($user->profile->country)->name : '';

        if ($user->user_type !== 1) {
            return view('panel.individual.edit', $data);
        } else {
            return view('panel.company.edit', $data);
        }
    }

    public function detail()
    {
        $user = auth()->user();
        $city = City::find($user->profile->city) ? City::find($user->profile->city)->name : '';
        $country = Country::find($user->profile->country) ? Country::find($user->profile->country)->name : '';

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

        $countries = Country::where('active', 1)->get();
        $phonecodes = Country::where('active', 1)->where('phonecode', '<>', 0)->orderBy('phonecode', 'asc')->select('phonecode')->distinct()->get()->all();

        return view('panel.individual.detail.index', ['user' => $user, 'cityname' => $city, 'countryname' => $country, 'sponsor' => $sponsor, 'referral_id' => $referralCookie, 'countries' => $countries, 'phonecodes' => $phonecodes]);
    }

    public function cityFilter(Request $request)
    {
        $distance = $request->get('distance');
        $keyword = $request->get('keyword');
        $data = [];
        if ($distance == 'CITY') {
            $cities = City::query()
                ->where('name', 'LIKE', "%{$keyword}%")
                ->select('name')->distinct()->get()->all();
            if (count($cities)) {
                foreach ($cities as $city) {
                    array_push($data, ['name' => $city, 'address' => $city]);
                }
            }
        } elseif ($distance == 'AREA') {
            $states = State::query()
                ->where('name', 'LIKE', "%{$keyword}%")
                ->get();
            if (count($states)) {
                foreach ($states as $state) {
                    $name = $state->name.', '.$state->country->name;
                    $address = $state->id.','.$state->country->id;
                    array_push($data, ['name' => $name, 'address' => $address]);
                }
            }
        } elseif ($distance == 'COUNTRY') {
            $countries = Country::query()
                ->where('name', 'LIKE', "%{$keyword}%")
                ->get();
            if (count($countries)) {
                foreach ($countries as $country) {
                    array_push($data, ['name' => $country->name, 'address' => $country->id]);
                }
            }
        }

        return response()->json($data);
    }

    public function editDetail()
    {
        $user = auth()->user();
        $city = City::find($user->profile->city) ? City::find($user->profile->city)->name : '';
        $country = Country::find($user->profile->country) ? Country::find($user->profile->country)->name : '';

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

        $countries = Country::where('active', 1)->get();
        $phonecodes = Country::where('active', 1)->where('phonecode', '<>', 0)->orderBy('phonecode', 'asc')->select('phonecode')->distinct()->get()->all();

        return view('panel.individual.detail.edit', ['user' => $user, 'cityname' => $city, 'countryname' => $country, 'sponsor' => $sponsor, 'referral_id' => $referralCookie, 'countries' => $countries, 'phonecodes' => $phonecodes]);
    }

    public function updateUserDetailInfo(Request $request)
    {
        $user = auth()->user();
        // $user->username = $request->username;
        if ($request->changePassword == 1) {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->save();

        $orgDate = $request->birthday;
        $date = str_replace('/', '-', $orgDate);
        $birthday = date('Y-m-d', strtotime($date));

        $profile = $user->profile;
        $profile->phone = $request->phone;
        $profile->gender = $request->gender;
        $profile->birthday = $birthday;
        $profile->company_name = $request->company_name;
        $profile->site_url = $request->site_url;
        $profile->city = $request->city;
        $profile->country = $request->country;
        $profile->street = $request->street_name;
        $profile->house_number = $request->house_number;
        $profile->postal_code = $request->postal_code;
        $profile->display_options = $request->display_options ? implode(',', $request->display_options) : null;
        $profile->save();

        return redirect()->route('profile.detail')->with('success', 'Profile successfully updated');
    }

    public function setting()
    {
        $data['user'] = $user = auth()->user();

        if ($user->user_type !== 0) {
            return view('panel.company.setting', $data);
        } else {
            return view('panel.individual.setting', $data);
        }
    }

    public function updateProfileAddress(Request $request)
    {
        $profile = auth()->user()->profile;
        if ($request->address) {
            $addressArray = explode(',', $request->address);
            $profile->city = $addressArray[0];
            $profile->state = $addressArray[1];
            $profile->country = $addressArray[2];
        }
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateMainInterested(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->main_interests = $request->main_interests;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateOtherInterested(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->other_interests = $request->other_interests;
        $profile->gender = $request->gender;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function uploadProfileAvatar(Request $request)
    {
        $profile = auth()->user()->profile;
        $file = $request->file('file');
        $filename = $profile->user->username.'-'.$request->field.'.jpg';

        if (! file_exists(base_path().'/public/uploads/'.$profile->user->username)) {
            mkdir(base_path().'/public/uploads/'.$profile->user->username, 0777, true);
        }
        $file->move(base_path().'/public/uploads/'.$profile->user->username, $filename);
        switch ($request->field) {
            case 'thumbnail1':
                $profile->other_avatar_url1 = $filename;
                break;
            case 'thumbnail2':
                $profile->other_avatar_url2 = $filename;
                break;
            case 'thumbnail3':
                $profile->other_avatar_url3 = $filename;
                break;
            case 'thumbnail4':
                $profile->other_avatar_url4 = $filename;
                break;
            case 'thumbnail5':
                $profile->other_avatar_url5 = $filename;
                break;
            case 'thumbnail6':
                $profile->other_avatar_url6 = $filename;
                break;
            case 'thumbnail7':
                $profile->other_avatar_url7 = $filename;
                break;
            case 'thumbnail8':
                $profile->other_avatar_url8 = $filename;
                break;
            case 'banner_img':
                $profile->banner_img_url = $filename;
                break;
            case 'company_logo':
                $profile->logo_url = $filename;
                break;
            case 'main_avatar':
                $profile->main_avatar_url = $filename;
                break;
            default:
                break;
        }
        $profile->save();

        return response()->json(['success' => 'Profile avatar successfully uploaded']);
    }

    public function removeProfileAvatar(Request $request)
    {
        $profile = auth()->user()->profile;
        $filename = '';

        switch ($request->field) {
            case 'thumbnail1':
                $filename = $profile->other_avatar_url1;
                $profile->other_avatar_url1 = null;
                break;
            case 'thumbnail2':
                $filename = $profile->other_avatar_url2;
                $profile->other_avatar_url2 = null;
                break;
            case 'thumbnail3':
                $filename = $profile->other_avatar_url3;
                $profile->other_avatar_url3 = null;
                break;
            case 'thumbnail4':
                $filename = $profile->other_avatar_url4;
                $profile->other_avatar_url4 = null;
                break;
            case 'thumbnail5':
                $filename = $profile->other_avatar_url5;
                $profile->other_avatar_url5 = null;
                break;
            case 'thumbnail6':
                $filename = $profile->other_avatar_url6;
                $profile->other_avatar_url6 = null;
                break;
            case 'thumbnail7':
                $filename = $profile->other_avatar_url7;
                $profile->other_avatar_url7 = null;
                break;
            case 'thumbnail8':
                $filename = $profile->other_avatar_url8;
                $profile->other_avatar_url8 = null;
                break;
            case 'banner_img':
                $filename = $profile->banner_img_url;
                $profile->banner_img_url = null;
                break;
            case 'company_logo':
                $filename = $profile->logo_url;
                $profile->logo_url = null;
                break;
            default:
                $filename = $profile->main_avatar_url;
                $profile->main_avatar_url = null;
                break;
        }
        if (file_exists(base_path().'/public/uploads/'.$profile->user->username.'/'.$filename)) {
            unlink(base_path().'/public/uploads/'.$profile->user->username.'/'.$filename);
        }
        $profile->save();

        return response()->json(['success' => 'Profile avatar successfully removed']);
    }

    public function updateStoryContent(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->story_content = $request->story_content;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateJobTitle(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->job_title = $request->job_title;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateCity(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->city = $request->city;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateCountry(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->country = $request->country;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateStreet(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->street = $request->street;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateCode(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->postal_code = $request->code;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateEmail(Request $request)
    {
        $user = User::find($request->id);
        $user->email = $request->email;
        $user->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updatePhone(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->phone = $request->phone;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateSite(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->site_url = $request->site;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function verify(Request $request)
    {
        if ($request->input('key') == 'verifyEmail') {
            return response()->json(['status' => User::where('email', $request->input('value'))->where('id', '<>', $request->user()->id)->exists()]);
        } elseif ($request->input('key') == 'verifyUsername') {
            return response()
                ->json(['status' => User::where('username', $request->input('value'))
                    ->where('id', '<>', $request->user()->id)
                    ->exists(),
                ]);
        }
    }
}
