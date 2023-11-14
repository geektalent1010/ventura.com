<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Requests;
use App\Notification;
use App\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();
        $friendIds = Friend::where('user_id', '=', $authUser->id)->pluck('connected_user_id')->toArray();
        
        $requests = Requests::where('user_id', '=', $authUser->id)->where('is_active', '=', 1)->get();
        $lastRequest = Requests::where('user_id', '=', $authUser->id)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->first();
        if (isset($authUser->notification)) {
            if (isset($lastRequest) && $lastRequest->id != $authUser->notification->last_read_request_id) {
                $notification = $authUser->notification;
                $notification->last_read_request_id = $lastRequest->id;
                $notification->save();
            }
        } else {
            if (isset($lastRequest)) {
                Notification::create([
                    'user_id' => $authUser->id,
                    'last_read_request_id' => $lastRequest->id
                ]);
            }
        }
        // $searchSetting = SearchSettings::where('user_id', $authUser->id)->where('type', 0)->first();
        // $users = [];
        // if (isset($searchSetting)) {
        //     $ages = isset($searchSetting->age) ? explode(",", $searchSetting->age) : [];
            
        //     $users = Profile::whereHas('user', function($query) {
        //             $query->where('user_type', 0);
        //         })
        //         ->where(function ($query) use ($ages) {
        //             /** @var Builder $query */
        //             foreach($ages as $age)
        //             {
        //                 $terms = explode("-", $age);
        //                 $query->orWhere(function($query) use($terms){
        //                     $query->whereYear('birthday', '<=', date('Y') - $terms[0]);
        //                     $query->whereYear('birthday', '>=', date('Y') - $terms[1]);
        //                 });
        //             }
        //         })
        //         ->where(function ($query) use ($searchSetting) {
        //             /** @var Builder $query */
        //             if ($searchSetting->interest_based === 'YES') {
        //                 $interests = isset($searchSetting->categories) ? explode(",", $searchSetting->categories) : [];
        //                 foreach($interests as $interest)
        //                 {
        //                     $query->orWhere('other_interests', 'LIKE', '%'.$interest.'%');
        //                 }
        //             }
        //             if (isset($searchSetting->gender)) {
        //                 $query->orWhere('gender', '=', $searchSetting->gender);
        //             }

        //             if ($searchSetting->distance && $searchSetting->distance != 'GLOBAL') {
        //                 $addressArray = explode(",", $searchSetting->address);
        //                 switch ($searchSetting->distance) {
        //                     case 'CITY':
        //                         $query->where('city', '=', $addressArray[0])
        //                             ->where('state', '=', $addressArray[1])
        //                             ->where('country', '=', $addressArray[2]);
        //                         break;
        //                     case 'AREA':
        //                         $query->where('state', '=', $addressArray[0])
        //                             ->where('country', '=', $addressArray[1]);
        //                         break;
        //                     case 'COUNTRY':
        //                         $query->where('country', '=', $addressArray[0]);
        //                         break;
        //                     default:
        //                         break;
        //                 }
        //             }
        //         })
        //         ->where('user_id', '<>', $authUser->id)
        //         ->whereNotIn('user_id', $friendIds)->orderBy('first_name', 'asc')->get();
        // } else {
        //     $users = Profile::whereHas('user', function($query) {
        //             $query->where('user_type', 0);
        //         })
        //         ->where('user_id', '<>', $authUser->id)->whereNotIn('user_id', $friendIds)->orderBy('first_name', 'asc')->get();
        // }
        $users = Profile::whereHas('user', function($query) {
                $query->where('user_type', 0);
            })
            ->where('user_id', '<>', $authUser->id)->whereNotIn('user_id', $friendIds)->orderBy('first_name', 'asc')->get();

        return view('panel.connects.index', compact('users', 'requests'));
    }

    public function filter(Request $request)
    {
        $authUser = $request->user();
        $friendIds = Friend::where('user_id', '=', $authUser->id)->pluck('connected_user_id')->toArray();
        $data = Profile::query()
            ->when($keyword = $request->get('keyword'), function ($query) use ($keyword) {
                /** @var Builder $query */
                $query->where(function ($query) use ($keyword) {
                    /** @var Builder $query */
                    $query->whereRaw('concat(first_name," ",last_name) LIKE ?', "{$keyword}%");
                });
            })
            ->where('user_id', '<>', $authUser->id)
            ->whereNotIn('user_id', $friendIds)
            ->get();

        return response()->json($data);
    }

	public function addressFilter(Request $request)
    {
        $distance = $request->get('distance');
        $keyword = $request->get('keyword');
        $data = [];
        // if ($distance == 'CITY') {
        //     $cities = City::query()
        //         ->where('name', 'LIKE', "%{$keyword}%") 
        //         ->get();
        //     if (count($cities)) {
        //         foreach($cities as $city)
        //         {
        //             $name = $city->name . ', ' . $city->state->name . ', ' . $city->state->country->name;
        //             $address = $city->id . ',' . $city->state->id . ',' . $city->state->country->id;
        //             array_push($data, array('name' => $name, 'address' => $address));
        //         }
        //     }
        // } else if ($distance == 'AREA') {
        //     $states = State::query()
        //         ->where('name', 'LIKE', "%{$keyword}%") 
        //         ->get();
        //     if (count($states)) {
        //         foreach($states as $state)
        //         {
        //             $name = $state->name . ', ' . $state->country->name;
        //             $address = $state->id . ',' . $state->country->id;
        //             array_push($data, array('name' => $name, 'address' => $address));
        //         }
        //     }
        // } else if ($distance == 'COUNTRY') {
        //     $countries = Country::query()
        //         ->where('name', 'LIKE', "%{$keyword}%") 
        //         ->get();
        //     if (count($countries)) {
        //         foreach($countries as $country)
        //         {
        //             array_push($data, array('name' => $country->name, 'address' => $country->id));
        //         }
        //     }
        // }

        return response()->json($data);
    }

    public function request($userID)
    {
        $data['user'] = User::find($userID);
        if (!isset($data['user']) || $userID == Auth::user()->id) {
            return redirect()->route('connect.index');
        }

        return view('panel.connects.request', $data);
    }

    public function send(Request $request) {
        $authUser = $request->user();
        $existingRequest = Requests::where('user_id', $request->user_id)->where('requester', $request->user()->id)->first();
        $friend = Friend::where('user_id', '=', $authUser->id)->where('connected_user_id', $request->user_id)->first();
        if (isset($existingRequest))
            return response()->json(['error' => 'The request already has been sent.']);
        if (isset($friend))
            return response()->json(['error' => 'You already have been connected.']);
        Requests::create([
            'requester' => $request->user()->id,
            'user_id' => $request->user_id,
            'context' => $request->message,
        ]);

        return response()->json(['success' => 'The request successfully send.']);
    }
}
