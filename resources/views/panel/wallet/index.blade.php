@extends('layouts.app', ['ACTIVE_TITLE' => 'WALLET', 'ROUTES' => [
  ['ROUTE' => 'wallet.index', 'ACTIVE' => 'wallet', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'wallet'])

@section('title', __('- Stories'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

<div class="main-bg">
    <div class="row m-0 p-0 w-100 wallet-section">
        <div class="row justify-content-center m-0 w-100">
            <div class="col-md-6 p-0">
                <div class="row justify-content-center dark-color-section px-4 m-0 pt-4 pb-2">
                    <p class="text-bold">COMMISSIONS</p>
                </div>
                <div class="row justify-content-between odd-color-section px-4 m-0 pt-4 pb-2">
                    <p>TOTAL</p>
                    <p class="text-bold">€2.500,00</p>
                </div>
                <div class="row justify-content-between odd-color-section px-4 m-0 pt-4 pb-2">
                    <p>PENDING</p>
                    <p class="text-bold">€2.000,00</p>
                </div>
                <div class="row justify-content-between success-color-section px-4 m-0 pt-4 pb-2">
                    <p class="text-bold">AVAILABLE</p>
                    <p class="text-bold">€500,00</p>
                </div>
                <div class="row justify-content-center panel-color-section px-4 m-0 pt-4 pb-2">
                    <p class="text-bold">TRANSFER</p>
                </div>
                <div class="row justify-content-between odd-color-section px-4 m-0 pt-4 pb-2">
                    <p>AMOUNT</p>
                    <p class="text-gray">€0,00</p>
                </div>
                <div class="row justify-content-center panel-color-section px-4 m-0 pt-4 pb-2">
                    <p class="text-bold">TRANSFER METHOD</p>
                </div>
                <div class="odd-color-section px-4 m-0 pt-5 pb-4">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="dot-section dis-selected"></div>
                            <p>BANK TRANSFER</p>
                        </div>
                        <div class="edit-section">
                            <a href="">
                                <img class="active" src="{{ asset('images/svg/Stories.svg') }}">
                            </a>
                            <a href="" class="ml-2">
                                <img class="" src="{{ asset('images/svg/TrashCan.svg') }}">
                            </a>
                        </div>
                    </div>
                    <p class="text-gray wallet-address">IBAN</p>
                </div>
                <div class="odd-color-section px-4 m-0 pt-5 pb-4">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="dot-section selected"></div>
                            <p>CRYPTO WALLET ID</p>
                        </div>
                        <div class="edit-section">
                            <a href="">
                                <img class="active" src="{{ asset('images/svg/Stories.svg') }}">
                            </a>
                            <a href="" class="ml-2">
                                <img class="" src="{{ asset('images/svg/TrashCan.svg') }}">
                            </a>
                        </div>
                    </div>
                    <p class="text-gray wallet-address">0xabe3c71fde060780034db713a4f9da30ce93d6f6</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center mt-4 mb-2 btn-section w-100 p-0 m-0">
            <button class="btn btn-primary profile-update-btn">SAVE</button>
        </div>
        <div class="row justify-content-center align-items-center mt-2 mb-5 btn-section w-100 p-0 m-0">
            <button class="btn btn-primary profile-update-btn">REQUEST</button>
        </div>
    </div>
</div>

@endsection

@section('PAGE_END')
@endsection