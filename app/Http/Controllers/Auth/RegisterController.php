<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\City;
use App\State;
use App\Country;
use App\Rank;
use App\RankUser;
use App\AdvancedRank;
use App\RankAchievementHistory;
use App\Mail\Welcome;
use App\Mail\ReferralEmail;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Mail;
use App\Mail\ContactMail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $sponsor_set_by_cookie = false;
        $sponsor = null;
        $referralCookie = \Cookie::get('referral_id');

        if ($referralCookie) {
            $sponsor_user = User::where('customer_id', $referralCookie)->first();
            if ($sponsor_user) {
                $sponsor = $sponsor_user;
                $sponsor_set_by_cookie = true;
            }
        }
        
        $countries = Country::where('active', 1)->get();
        $phonecodes = Country::where('active', 1)->where('phonecode', '<>', 0)->orderBy('phonecode','asc')->select('phonecode')->distinct()->get()->pluck('phonecode')->all();

        if ($sponsor_set_by_cookie) {
            return view('auth.register')
                    ->with('sponsor', $sponsor)
                    ->with('referral_id', $referralCookie)
                    ->with('countries', $countries)
                    ->with('phonecodes', $phonecodes);
        }

        return view('auth.join');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $referralCookie = \Cookie::get('referral_id');

        if ($referralCookie) {
            $introducer = User::where('customer_id', $referralCookie)->first();
        }

        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user, $introducer)) {
            return redirect()->route('dashboard');
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user, $introducer)
    {
        // send email logic
        
        $userData = [
            'first_name' => $user->profile->first_name,
            'last_name' => $user->profile->last_name,
            'customer_id' => $user->customer_id
        ];
        
        try {
            Mail::to($user->email)->send(new Welcome($userData));

            $introducerName = $introducer->profile->first_name . ' ' . $introducer->profile->last_name;
            Mail::to($introducer->email)->send(new ReferralEmail($userData, $introducerName));

            // echo 'Message has been sent. ';
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$e->ErrorInfo}";
            return false;
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:5|max:50|unique:users',
            'email' => 'required|string|email|min:6|max:64|unique:users',
            'password' => 'required|string|min:7|max:64',

            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'birthday' => 'required',
            'gender' => 'required',
            'phone' => 'required|min:7',
            'street_name' => 'required',
            'house_number' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            // 'state' => 'required',
            'country' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $sponsor_user = null;

        if ($referralCookie = \Cookie::get('referral_id')) {
            $sponsor_user = User::where('customer_id', $referralCookie)->first();
        }

        if (!isset($sponsor_user)) {
            return redirect(route('register'))
                ->withErrors([
                    'message' => trans('auth.sponsor_failed')
                ]);
        }


        // 6 digit random number, unique in DB
        $attempt = 1;
        $attempt_max = 5;
        $customer_id = null;
        do {
            $customer_id = rand(100000,999999);
            $attempt++;
        } while (User::where('customer_id', $customer_id)->exists() && $attempt <= $attempt_max);

        if ($attempt > $attempt_max) {
            \Log::error("Could not generate unique customer_id");
            abort(500, 'Could not generate unique Customer ID. Please contact Support.');
            return redirect(route('register'))
                ->withErrors([
                    'message' => 'Could not generate unique Customer ID. Please contact Support.'
                ]);
        }
        
        $user = User::create([
            'customer_id' => $customer_id,
            'sponsor_id' => isset($sponsor_user) ? $sponsor_user->id : 0,
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type' => $data['user_type'],
            'channel' => \Cookie::get('channel_id') ? \Cookie::get('channel_id') : 1
        ]);

        $orgDate = $data['birthday'];
        $date = str_replace('/', '-', $orgDate);
        $birthday = date("Y-m-d", strtotime($date));

        Profile::create([
            'user_id'       => $user->id,
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'birthday'      => $birthday,
            'phone'         => $data['phone'],
            'company_name'  => $data['company_name'],
            'vat_number'    => $data['vat_number'],
            'gender'        => $data['gender'],
            'street'        => $data['street_name'],
            'house_number'  => $data['house_number'],
            'postal_code'   => $data['postal_code'],
            'city'          => $data['city'],
            // 'state'         => $data['state'],
            'country'       => $data['country'],
            'interest_based'=> 'f,m',
        ]);

        if (isset($sponsor_user)) {
            if ($channel_id = \Cookie::get('channel_id')) {
                $rank = $this->calculateRank($sponsor_user, $channel_id == 2);
                if ($rank) $this->distribute($sponsor_user, $rank, $channel_id == 2);
            } else {
                $rank = $this->calculateRank($sponsor_user, false);
                if ($rank) $this->distribute($sponsor_user, $rank, false);
            }
        }

        return $user;
    }

    public function verify(Request $request) {
        if ($request->input('key') == 'verifyEmail') {
            return response()->json(['status' => User::where('email', $request->input('value'))->exists()]);
        } else if ($request->input('key') == 'verifyUsername') {
            return response()->json(['status' => User::where('username', $request->input('value'))->exists()]);
        }
    }

    public function addressFilter(Request $request)
    {
        $distance = $request->get('distance');
        $keyword = $request->get('keyword');
        $data = [];
        if ($distance == 'CITY') {
            $cities = City::query()
                ->where('name', 'LIKE', "%{$keyword}%")
                ->select('name')->distinct()->get()->pluck('name')->all();
            if (count($cities)) {
                foreach($cities as $city)
                {
                    array_push($data, array('name' => $city, 'address' => $city));
                }
            }
        } else if ($distance == 'AREA') {
            $states = State::query()
                ->where('name', 'LIKE', "%{$keyword}%") 
                ->get();
            if (count($states)) {
                foreach($states as $state)
                {
                    $name = $state->name . ', ' . $state->country->name;
                    $address = $state->id . ',' . $state->country->id;
                    array_push($data, array('name' => $name, 'address' => $address));
                }
            }
        } else if ($distance == 'COUNTRY') {
            $countries = Country::query()
                ->where('name', 'LIKE', "%{$keyword}%") 
                ->get();
            if (count($countries)) {
                foreach($countries as $country)
                {
                    array_push($data, array('name' => $country->name, 'address' => $country->id));
                }
            }
        }

        return response()->json($data);
    }
    
    function calculateRank(User $user, $channel2)
    {
        return Rank::where('is_active', '1')->orderBy('id', 'desc')->get()->filter(function ($rank) use ($user, $channel2) {
            return $this->isQualifiedByFloor($rank, $user, $channel2);
        })->first();
    }

    function isQualified(Rank $rank, User $user)
    {
        $checkChildren = function ($ranksToCheck) use ($user, $rank) {
            
            if ($user->referrers->count() < $ranksToCheck['minCount']) return false;

            /** @var Collection $children */
            $children = $user->referrers->filter(function ($child) use ($ranksToCheck) {
                /** @var User $child */
                return ($child->referrers->count() >= $ranksToCheck['count_by_partner']);
            });

            if ($children->count() < $ranksToCheck['partners']) return false;

            return true;
        };

        $ranksToCheck = [
            'minCount' => $rank->customers,
            'partners' => $rank->partners,
            'count_by_partner' => $rank->partner_group,
        ];

        if (!$checkChildren($ranksToCheck)) return false;

        return true;
    }

    function isQualifiedByFloor(Rank $rank, User $user, $channel2)
    {
        $checkChildren = function ($ranksToCheck) use ($user, $rank) {
            $referrersForChannel1 = $user->referrers->filter(function ($child) {
                /** @var User $child */
                return $child->channel == 1;
            });
            
            if ($referrersForChannel1->count() < $ranksToCheck['minCount']) return false;

            if ($rank->level > 1) {
                /** @var Collection $children */
                $childrenByChannel1 = $referrersForChannel1->map(function ($child) {
                    $child['referrersCount'] = $child->referrers->count();
                
                    return $child;
                });
    
                if ($childrenByChannel1->sum('referrersCount') + $referrersForChannel1->count() < $ranksToCheck['channel1']) return false;
            }

            return true;
        };
        $checkChildrenForChannel2 = function ($ranksToCheck) use ($user, $rank) {
            $referrersForChannel2 = $user->referrers->filter(function ($child) {
                /** @var User $child */
                return $child->channel == 2;
            });
            
            if ($referrersForChannel2->count() < $ranksToCheck['minCount']) return false;

            if ($rank->level > 1) {
                /** @var Collection $children */
                $childrenByChannel2 = $referrersForChannel2->map(function ($child) {
                    $child['referrersCount'] = $child->referrers->count();
                
                    return $child;
                });
    
                if ($childrenByChannel2->sum('referrersCount') + $referrersForChannel2->count() < $ranksToCheck['channel2']) return false;
            }

            return true;
        };

        $ranksToCheck = [
            'level'    => $rank->level,
            'minCount' => $rank->customers,
            'channel1' => $rank->channel1,
            'channel2' => $rank->channel2,
        ];

        if ($channel2) {
            if (!$checkChildrenForChannel2($ranksToCheck)) return false;
        } else {
            if (!$checkChildren($ranksToCheck)) return false;
        }

        return true;
    }

    function distribute(User $user, $rank, $channel2)
    {
        if ($channel2) {
            $existingRank = AdvancedRank::where('user_id', $user->id)->first();
            if (!$existingRank || ($rank->id != $existingRank->rank_id)) {
                if ($existingRank)
                    AdvancedRank::where('user_id', $user->id)->update([
                        'rank_id' => $rank->id
                    ]);
                else
                    AdvancedRank::create([
                        'user_id' => $user->id,
                        'rank_id' => $rank->id
                    ]);
            }
        } else {
            $existingRank = RankUser::where('user_id', $user->id)->first();
            if (!$existingRank || ($rank->id != $existingRank->rank_id)) {
                if ($existingRank)
                    RankUser::where('user_id', $user->id)->update([
                        'rank_id' => $rank->id
                    ]);
                else
                    RankUser::create([
                        'user_id' => $user->id,
                        'rank_id' => $rank->id
                    ]);

                RankAchievementHistory::create([
                    'user_id' => $user->id,
                    'rank_id' => $rank->id
                ]);
            }
        }
    }

    public function sendEnquiry(Request $request)
    {
        try { 
            $data = $request->only(['username', 'country', 'email']);
            Mail::to('info@branfields.com')->send(new ContactMail($data));
            return response()->json(['status' => true]);
        }
        catch (Exception $e) {
            return response()->json(['status' => false, 'message' => '']);
        }
    }
}
