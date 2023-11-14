@extends('layouts.app', ['ACTIVE_TITLE' => 'SALES', 'ROUTES' => [
  ['ROUTE' => 'incentives.index', 'ACTIVE' => 'incentives', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'incentives.shares', 'ACTIVE' => 'shares', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'shares'])

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
                            <p class="story-card-title mb-0">MY SHARES</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between rank-section m-0">
                    <div class="left-section text-center">GLOBAL SHARES</div>
                </div>
                @php
                    $totalMyCommission = 0;
                @endphp
                @for ($index = 5; $index > 0; $index--)
                    <div>
                        <div class="row justify-content-center bold-section px-0 m-0">
                            <div class="left-section">FLOOR {{ $index }}</div>
                            @php
                                $floorByChannel1 = isset($rankCounts[$index]) ? $rankCounts[$index] : 0;
                                $floorByChannel2 = isset($advancedRankCounts[$index]) ? $advancedRankCounts[$index] : 0;
                                $totalFloor = $floorByChannel1 + $floorByChannel2;
                            @endphp
                            <div class="center-section">{{ $totalFloor }}</div>
                            <div class="row right-section">
                                <div>€ {{ $totalShareCommissions }}</div>
                            </div>
                        </div>
                        <div class="row justify-content-center normal-section px-0 m-0">
                            <div class="left-section">
                                <div class="disable-text">MY SHARES</div>
                            </div>
                            @php
                                $shareByChannel1 = isset($authUser->rank) && $authUser->rank->rank->level >= $index ? 1 : 0;
                                $shareByChannel2 = isset($authUser->advancedRank) && $authUser->advancedRank->rank->level >= $index ? 1 : 0;
                                $totalMyCommission += $totalFloor > 0 ? $totalShareCommissions / $totalFloor * ($shareByChannel1 + $shareByChannel2) : 0;
                            @endphp
                            <div class="center-section {{ isset($authUser->rank) && $authUser->rank->rank->level >= $index ? 'active' : ''}}">
                                {{ $shareByChannel1 + $shareByChannel2 }}
                            </div>
                            <div class="row right-section">
                                <div class="disable-text">€ {{ $totalFloor > 0 ? $totalShareCommissions / $totalFloor * ($shareByChannel1 + $shareByChannel2) : '0' }}</div>
                            </div>
                        </div>
                    </div>
                @endfor
                <div class="row justify-content-center total-section px-0 m-0">
                    <div class="left-section">TOTAL</div>
                    <div class="row right-section">
                        <div>€ {{ floor($totalMyCommission * 100) / 100 }}</div>
                    </div>
                </div>


                
                {{--<div class="row justify-content-center rank-section px-0 m-0">
                    <div class="left-section">STATUS</div>
                    <div class="center-section {{ isset($authUser->rank) ? 'active' : '' }}"></div>                    
                    <div class="row right-section">
                        <div>
                            <img class="ml-2" src="{{ asset('images/svg/IconRANK.svg') }}">
                            <p>{{ isset($authUser->rank) ? $authUser->rank->rank->level : '0'}}</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center pools-section px-0 m-0">
                    <div class="left-section">PERSONAL SALES</div>
                    <div class="row right-section d-flex align-items-center" id="incentivehead1">
                        <div>{{ $authUser->referrers->count() }}</div>
                        <div class="personal-panel-extend">
                            <a href="#" class="option-icon collapsed" data-toggle="collapse" data-target="#incentive1" aria-expanded="true" aria-controls="incentive1"></a>
                        </div>
                    </div>
                </div>
                <div id="incentive1" class="personal-sales-panel collapse" aria-labelledby="incentivehead1" data-parent="#incentives">
                    @foreach ($authUser->referrers as $child)
                        <div class="row personal-item-section m-0">
                            <div class="left-section">
                                <div class="status-section {{ isset($child->rank) ? 'active' : ''}}"></div>
                                <div class="ml-3">{{ $child->getFullname() }}</div>
                            </div>
                            <div class="right-section">
                                <!-- <div class="center-section">0</div> -->
                                <img class="" src="{{ asset('images/svg/IconRANK.svg') }}">
                                <p>{{ isset($child->rank) ? $child->rank->rank->level : '0'}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row justify-content-center personal-section px-0 m-0">
                    <div class="left-section">SALES FLOORS</div>
                    <div class="row right-section d-flex align-items-center font-weight-bold" id="incentivehead2">
                        <div>{{ isset($authUser->rank) ? $authUser->rank->rank->level : ''}}</div>
                        <div class="floor-panel-extend">
                            <a href="#" class="option-icon collapsed" data-toggle="collapse" data-target="#incentive2" aria-expanded="true" aria-controls="incentive2"></a>
                        </div>
                    </div>
                </div>
                <div id="incentive2" class="floors-panel collapse" aria-labelledby="incentivehead2" data-parent="#incentives">
                    @for ($index = 5; $index > 0; $index--)
                        <div>
                            <div class="row justify-content-center bold-section px-0 m-0">
                                <div class="left-section">FLOOR {{ $index }}</div>
                                <div class="center-section">{{ isset($rankCounts[$index]) ? $rankCounts[$index] : '0' }}</div>
                                <div class="row right-section">
                                    <div>€ {{ $totalShareCommissions }}</div>
                                </div>
                            </div>
                            <div class="row justify-content-center normal-section px-0 m-0">
                                <div class="left-section">
                                    <div class="disable-text">YOUR SHARE</div>
                                </div>
                                <div class="center-section {{ isset($authUser->rank) && $authUser->rank->rank->level >= $index ? 'active' : ''}}">
                                </div>
                                <div class="row right-section">
                                    <div class="disable-text">€ {{ isset($rankCounts[$index]) ? $totalShareCommissions / $rankCounts[$index] : '0' }}</div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>--}}
            </div>
        </div>
    </div>
</div>

@endsection


@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
@endsection