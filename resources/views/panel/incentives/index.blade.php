@extends('layouts.app', ['ACTIVE_TITLE' => 'STATS', 'ROUTES' => [
  ['ROUTE' => 'incentives.index', 'ACTIVE' => 'incentives', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'incentives.shares', 'ACTIVE' => 'shares', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'incentives'])

@section('title', __('- Stats'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex">
    <div class="row m-0 p-0 w-100 incentives-section">
        <div class="row justify-content-center m-0 w-100">
            <div class="col-md-6 p-0 accordion" id="incentives">
                <div class="statusItem">
                    <div class="story-content-wrp">
                        <div class="my-story-card">
                            <p class="story-card-title mb-0">MY SALES CHANNELS</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between rank-section m-0">
                    <div class="left-section">CHANNEL 1</div>
                    <div class="center-section {{ isset($authUser->rank) ? 'active' : '' }}"></div>
                </div>
                <div class="row justify-content-between pools-section m-0">
                    <div class="left-section">PERSONAL SALES</div>
                    <div class="center-section text-center">{{ $authUser->referrersForChannel1()->count() }}</div>
                    <div class="right-section" id="incentivehead1">
                        <div class="personal-panel-extend">
                            <a href="#" class="option-icon collapsed" data-toggle="collapse" data-target="#incentive1" aria-expanded="true" aria-controls="incentive1"></a>
                        </div>
                    </div>
                </div>
                <div id="incentive1" class="personal-sales-panel collapse" aria-labelledby="incentivehead1" data-parent="#incentives">
                    @foreach ($authUser->referrersForChannel1() as $child)
                        <div class="row personal-item-section m-0">
                            <div class="left-section">
                                <div>{{ $child->getFullname() }}</div>
                            </div>
                            <div class="left-section text-center">
                            {{ $child->referrers->count() }}
                            </div>
                            <div class="left-section">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="mr-3">
                                        @php
                                            $referrals = new App\Models\User();
                                            $referrersForChild = $child->referrers;
                                            $getAllReferrals = $referrals->getReferrals($referrersForChild);
                                            $fetchedAllReferrals = $referrals->fetchReferrals($getAllReferrals);
                                        @endphp
                                        {{ count($fetchedAllReferrals) }}
                                    </div>
                                    <div class="status-section active"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="floor-section">
                    @foreach (App\Models\Rank::where('is_active', '1')->orderBy('level', 'asc')->get() as $floor)
                    <div class="floor-item {{ isset($authUser->rank) && $authUser->rank->rank->level >= $floor->level ? 'active' : '' }}">
                        <div class="text-center">FLOOR {{ $floor->level }}</div>
                        <div class="text-center font-weight-bold">{{ $floor->channel1 }}</div>
                    </div>
                    @endforeach
                </div>
                <div class="row justify-content-between pools-section m-0">
                    <div class="left-section">TOTAL SALES</div>
                    <div class="center-section text-center">
                        @php
                            $referrals = new App\Models\User();
                            $referrersForChannel1 = $authUser->referrersForChannel1();
                            $getAllReferrals = $referrals->getReferrals($referrersForChannel1);
                            $fetchedAllReferrals = $referrals->fetchReferrals($getAllReferrals);
                        @endphp
                        {{ count($fetchedAllReferrals) }}
                    </div>
                    <div class="right-section"></div>
                </div>

                @if (isset($authUser->advancedRank))
                    <div class="mt-5"></div>
                    <div class="row justify-content-between rank-section m-0">
                        <div class="left-section">CHANNEL 2</div>
                        <div class="center-section {{ isset($authUser->advancedRank) ? 'active' : '' }}"></div>
                    </div>
                    <div class="row justify-content-between pools-section m-0">
                        <div class="left-section">PERSONAL SALES</div>
                        <div class="center-section text-center">{{ $authUser->referrersForChannel2()->count() }}</div>
                        <div class="right-section" id="incentivehead2">
                            <div class="personal-panel-extend">
                                <a href="#" class="option-icon collapsed" data-toggle="collapse" data-target="#incentive2" aria-expanded="true" aria-controls="incentive2"></a>
                            </div>
                        </div>
                    </div>
                    <div id="incentive2" class="personal-sales-panel collapse" aria-labelledby="incentivehead2" data-parent="#incentives">
                        @foreach ($authUser->referrersForChannel2() as $child)
                            <div class="row personal-item-section m-0">
                                <div class="left-section">
                                    <div>{{ $child->getFullname() }}</div>
                                </div>
                                <div class="left-section text-center">
                                    {{ $child->referrers->count() }}
                                </div>
                                <div class="left-section">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="mr-3">
                                            @php
                                                $referrals = new App\Models\User();
                                                $referrersForChild = $child->referrers;
                                                $getAllReferrals = $referrals->getReferrals($referrersForChild);
                                                $fetchedAllReferrals = $referrals->fetchReferrals($getAllReferrals);
                                            @endphp
                                            {{ count($fetchedAllReferrals) }}
                                        </div>
                                        <div class="status-section active"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="floor-section">
                        @foreach (App\Models\Rank::where('is_active', '1')->orderBy('level', 'asc')->get() as $floor)
                        <div class="floor-item {{ isset($authUser->advancedRank) && $authUser->advancedRank->rank->level >= $floor->level ? 'active' : '' }}">
                            <div class="text-center">FLOOR {{ $floor->level }}</div>
                            <div class="text-center font-weight-bold">{{ $floor->channel2 }}</div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row justify-content-between pools-section m-0">
                        <div class="left-section">TOTAL SALES</div>
                        <div class="center-section text-center">
                            @php
                                $referrals = new App\Models\User();
                                $referrersForChannel2 = $authUser->referrersForChannel2();
                                $getAllReferrals = $referrals->getReferrals($referrersForChannel2);
                                $fetchedAllReferrals = $referrals->fetchReferrals($getAllReferrals);
                            @endphp
                            {{ count($fetchedAllReferrals) }}
                        </div>
                        <div class="right-section"></div>
                    </div>
                @endif

                <div class="commissionItem">
                    <div class="story-content-wrp">
                        <div class="my-story-card">
                            <p class="story-card-title mb-0">MY INCENTIVES THIS MONTH</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center personal-section px-0 m-0">
                    <div class="left-section">DIRECT SALES COMMISSIONS</div>
                    <div class="row right-section">
                        <div>€ {{ $totalDirectCommissions }}</div>
                    </div>
                </div>
                <div class="row justify-content-center bright-section px-0 m-0">
                    <div class="left-section">PROFIT SHARE COMMISSIONS</div>
                    <div class="row right-section">
                        <div>€ {{ $totalMyShareCommission }}</div>
                    </div>
                </div>
                <div class="row justify-content-center total-section px-0 m-0">
                    <div class="left-section">TOTAL</div>
                    <div class="row right-section">
                        <div>€ {{ $totalMyShareCommission + $totalDirectCommissions }}</div>
                    </div>
                </div>
                <div class="commissionItem">
                    <div class="story-content-wrp">
                        <div class="my-story-card">
                            <p class="story-card-title mb-0">MY INCENTIVES LIFETIME</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center personal-section px-0 m-0">
                    <div class="left-section">DIRECT SALES COMMISSIONS</div>
                    <div class="row right-section">
                        <div>€ {{ $totalDirectCommissions }}</div>
                    </div>
                </div>
                <div class="row justify-content-center bright-section px-0 m-0">
                    <div class="left-section">PROFIT SHARE COMMISSIONS</div>
                    <div class="row right-section">
                        <div>€ {{ $totalMyShareCommission }}</div>
                    </div>
                </div>
                <div class="row justify-content-center total-section px-0 m-0">
                    <div class="left-section">TOTAL</div>
                    <div class="row right-section">
                        <div>€ {{ $totalMyShareCommission + $totalDirectCommissions }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
@endsection
