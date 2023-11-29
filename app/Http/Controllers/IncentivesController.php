<?php

namespace App\Http\Controllers;

use App\Models\AdvancedRank;
use App\Models\Rank;
use App\Models\RankAchievementHistory;
use App\Models\RankUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncentivesController extends Controller
{
    public function index(Request $request)
    {
        $authUser = auth()->user();
        $rank = $this->calculateRank($authUser, false);
        if ($rank) {
            $this->distribute($authUser, $rank, false);
            if ($rank->level > 1) {
                $rank = $this->calculateRank($authUser, true);
                if ($rank) {
                    $this->distribute($authUser, $rank, true);
                }
            }
        }

        $childrenByChannel1 = $authUser->referrersForChannel1()->map(function ($child) {
            $child['referrersCount'] = $child->referrers->count();

            return $child;
        });

        $totalSales = $this->calculateSales() * 120;
        $totalShareCommissions = $totalSales * Rank::where(
            'is_active',
            '1'
        )->sum('profit') / 100 / Rank::where('is_active', '1')->count();
        $groupByRank = RankUser::select('rank_id', DB::raw('count(*) as rank_count'))
            ->groupBy('rank_id')
            ->get();
        $groupByRankForChannel2 = AdvancedRank::select('rank_id', DB::raw('count(*) as rank_count'))
            ->groupBy('rank_id')
            ->get();
        $rankCounts = $advancedRankCounts = [];
        $totalMyShareCommission = 0;
        foreach ($groupByRank as $group) {
            $rankCounts[$group->rank_id] = $group->rank_count;
        }
        foreach ($groupByRankForChannel2 as $group) {
            $advancedRankCounts[$group->rank_id] = $group->rank_count;
        }

        foreach (Rank::where('is_active', '1')->orderBy('level', 'desc')->get() as $floor) {
            $floorByChannel1 = $rankCounts[$floor->level] ?? 0;
            $floorByChannel2 = $advancedRankCounts[$floor->level] ?? 0;
            $totalFloor = $floorByChannel1 + $floorByChannel2;
            $shareByChannel1 = isset($authUser->rank) && $authUser->rank->rank->level >= $floor->level ? 1 : 0;
            $shareByChannel2 = isset($authUser->advancedRank) && $authUser->advancedRank->rank->level >= $floor->level ? 1 : 0;
            $totalMyShareCommission += $totalFloor > 0 ? $totalShareCommissions / $totalFloor * ($shareByChannel1 + $shareByChannel2) : 0;
        }
        $totalMyShareCommission = floor($totalMyShareCommission * 100) / 100;

        // Direct enrollment commission percent is 20%
        // To do: Create Commissions table and add DirectEnrollmentCommission module
        $totalDirectCommissions = $this->calculateDirects($authUser) * 120 * 0.2;

        return view('panel.incentives.index', [
            'authUser' => $authUser,
            'totalMyShareCommission' => $totalMyShareCommission,
            'totalDirectCommissions' => $totalDirectCommissions,
        ]);
    }

    public function shares(Request $request)
    {
        $authUser = auth()->user();
        $totalSales = $this->calculateSales() * 120;
        $totalShareCommissions = $totalSales * Rank::where(
            'is_active',
            '1'
        )->sum('profit') / 100 / Rank::where('is_active', '1')->count();

        $groupByRank = RankUser::select('rank_id', DB::raw('count(*) as rank_count'))
            ->groupBy('rank_id')
            ->get();
        $groupByRankForChannel2 = AdvancedRank::select('rank_id', DB::raw('count(*) as rank_count'))
            ->groupBy('rank_id')
            ->get();
        $rankCounts = $advancedRankCounts = [];
        foreach ($groupByRank as $group) {
            $rankCounts[$group->rank_id] = $group->rank_count;
        }
        foreach ($groupByRankForChannel2 as $group) {
            $advancedRankCounts[$group->rank_id] = $group->rank_count;
        }

        return view('panel.incentives.shares', [
            'authUser' => $authUser,
            'totalShareCommissions' => $totalShareCommissions,
            'rankCounts' => $rankCounts,
            'advancedRankCounts' => $advancedRankCounts,
        ]);
    }

    public function teams(Request $request)
    {
        $user_id = $request->get('user_id');
        $viewer = auth()->user();
        if (isset($user_id)) {
            $viewer = User::find($user_id);
        }

        return view('panel.incentives.teams', ['viewer' => $viewer]);
    }

    public function calculateRank(User $user, $channel2)
    {
        return Rank::where('is_active', '1')->orderBy('id', 'desc')->get()->filter(fn ($rank) => $this->isQualifiedByFloor($rank, $user, $channel2))->first();
    }

    public function isQualified(Rank $rank, User $user)
    {
        $checkChildren = function ($ranksToCheck) use ($user) {

            if ($user->referrers->count() < $ranksToCheck['minCount']) {
                return false;
            }

            /** @var Collection $children */
            $children = $user->referrers->filter(function ($child) use ($ranksToCheck) {
                /** @var User $child */
                return $child->referrers->count() >= $ranksToCheck['count_by_partner'];
            });

            return ! ($children->count() < $ranksToCheck['partners']);
        };

        $ranksToCheck = [
            'minCount' => $rank->customers,
            'partners' => $rank->partners,
            'count_by_partner' => $rank->partner_group,
        ];

        return ! ( ! $checkChildren($ranksToCheck));
    }

    public function isQualifiedByFloor(Rank $rank, User $user, $channel2)
    {
        $checkChildren = function ($ranksToCheck) use ($user) {
            $referrersForChannel1 = $user->referrersForChannel1();

            if ($referrersForChannel1->count() < $ranksToCheck['minCount']) {
                return false;
            }

            $referrals = new User();
            $getAllReferrals = $referrals->getReferrals($referrersForChannel1);
            $fetchedAllReferrals = $referrals->fetchReferrals($getAllReferrals);

            return ! (count($fetchedAllReferrals) < $ranksToCheck['channel1']);
        };
        $checkChildrenForChannel2 = function ($ranksToCheck) use ($user) {
            $referrersForChannel2 = $user->referrersForChannel2();

            if ($referrersForChannel2->count() < $ranksToCheck['minCount']) {
                return false;
            }

            $referrals = new User();
            $getAllReferrals = $referrals->getReferrals($referrersForChannel2);
            $fetchedAllReferrals = $referrals->fetchReferrals($getAllReferrals);

            return ! (count($fetchedAllReferrals) < $ranksToCheck['channel2']);
        };

        $ranksToCheck = [
            'level' => $rank->level,
            'minCount' => $rank->customers,
            'channel1' => $rank->channel1,
            'channel2' => $rank->channel2,
        ];

        if ($channel2) {
            if ( ! $checkChildrenForChannel2($ranksToCheck)) {
                return false;
            }
        } else {
            if ( ! $checkChildren($ranksToCheck)) {
                return false;
            }
        }

        return true;
    }

    public function distribute(User $user, $rank, $channel2): void
    {
        if ($channel2) {
            $existingRank = AdvancedRank::where('user_id', $user->id)->first();
            if ( ! $existingRank || ($rank->id !== $existingRank->rank_id)) {
                if ($existingRank) {
                    AdvancedRank::where('user_id', $user->id)->update([
                        'rank_id' => $rank->id,
                    ]);
                } else {
                    AdvancedRank::create([
                        'user_id' => $user->id,
                        'rank_id' => $rank->id,
                    ]);
                }
            }
        } else {
            $existingRank = RankUser::where('user_id', $user->id)->first();
            if ( ! $existingRank || ($rank->id !== $existingRank->rank_id)) {
                if ($existingRank) {
                    RankUser::where('user_id', $user->id)->update([
                        'rank_id' => $rank->id,
                    ]);
                } else {
                    RankUser::create([
                        'user_id' => $user->id,
                        'rank_id' => $rank->id,
                    ]);
                }

                RankAchievementHistory::create([
                    'user_id' => $user->id,
                    'rank_id' => $rank->id,
                ]);
            }
        }
    }

    public function calculateSales()
    {
        $usersInThisMonths = User::whereMonth('created_at', Carbon::now()->month)
            ->get();

        return $usersInThisMonths->count();
    }

    public function calculateDirects(User $user)
    {
        $myReferralsInThisMonths = User::where('sponsor_id', $user->id)->whereMonth('created_at', Carbon::now()->month)
            ->get();

        return $myReferralsInThisMonths->count();
    }

    public function fetch(Request $request)
    {
        $levels = $request->get('levels');
        $levels = isset($levels) ? explode(',', $levels) : [];

        $result = User::query()
            ->whereHas('profile', function ($query) use ($request): void {
                /** @var Builder $query */
                if ($keyword = $request->get('keyword')) {
                    $query->whereRaw('concat(first_name," ",last_name) LIKE ?', "{$keyword}%");
                }
            });
        if (count($levels)) {
            $result = $result
                ->whereHas('rank', function ($query) use ($levels): void {
                    /** @var Builder $query */
                    $query->whereIn('rank_id', $levels);
                });
        }

        $data['rankUsers'] = $result->get();

        return view('panel.incentives.partials.result', $data);
    }
}
