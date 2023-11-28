@extends('layouts.app', ['ACTIVE_TITLE' => 'MY PAGE', 'ROUTES' => [
  ['ROUTE' => 'profile', 'ACTIVE' => 'profile', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'profile.detail', 'ACTIVE' => 'detail', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'detail'])

@section('title', __('- Individual Profile'))

@section('PAGE_LEVEL_STYLES')
    <style type="text/css">
        select.country-select {
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
        }

        select.phone-select {
            width: 140px;
            margin-right: 4px;
            padding-left: 28px !important;
            padding-right: 8px !important;
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
        }

        .login-page .form-group .combodate {
            display: block;
            width: 100%;
        }

        .login-page .form-group select.day, .login-page .form-group select.month, .login-page .form-group select.year {
            background: #04246b40;
            border: none;
            -webkit-border-radius: 10rem;
            -moz-border-radius: 10rem;
            -ms-border-radius: 10rem;
            border-radius: 10rem;
            box-shadow: none;
            height: 44px;
            font-weight: 400;
            outline: medium none;
            padding-left: 28px;
            padding-right: 12px;
            font-size: 16px;
            line-height: 1.4;
            color: #fff;
            -webkit-transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            width: 32% !important;
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
        }

        .register-input-container {
            width: 100%;
            background: linear-gradient(to right, #00c6ff, #0072b8);
        }

        .pt-2\.5 {
            padding-top: 12px;
        }

        .form-section {
            width: 680px;
        }

        .info-title {
            margin-bottom: 12px;
            padding-left: 40px;
        }

        label.has-error {
            padding: 8px 24px 0 16px;
            font-size: 14px;
            color: #00ffff;
            text-align: left;
            font-family: 'DinPro Light', sans-serif;
            margin: 0;
        }

        label.valid {
            padding: 8px 24px 0 16px;
            font-size: 14px;
            color: #00ffff;
            text-align: left;
            font-family: 'DinPro Light', sans-serif;
            margin: 0;
        }

        @media only screen and (max-width: 767.98px) {
            .form-section {
                width: 100%;
            }
        }

        .addresstab {
            display: none;
            width: 100%;
            z-index: 1000;
            background: #2d23a3;
            position: absolute;
            padding-top: 12px;
            padding-bottom: 12px;
            max-height: 250px;
            overflow-y: auto;
            margin-top: -12px;
        }

        .important-note {
            font-weight: 500 !important;
        }

        .important-desc {
            font-size: 11px !important;
        }

        .copy-btn {
            width: 100%;
            max-width: 300px;
            height: 44px;
            background: #04246b;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            -webkit-border-radius: 10rem;
            -moz-border-radius: 10rem;
            -ms-border-radius: 10rem;
            border-radius: 10rem;
            font-size: 16px !important;
            font-family: 'DinPro', sans-serif !important;
            border: 0.1rem solid #04246b;
            cursor: pointer;
        }

        .copy-btn:hover {
            background: #00ffff !important;
            color: #04246b !important;
            border-color: #00ffff !important;
        }

        .copy-btn:focus, .copy-btn:active {
            background: #00ffff !important;
            color: #04246b !important;
            border-color: #00ffff !important;
            outline: none;
            box-shadow: none;
        }

        .copy-btn.disabled, .copy-btn:disabled, .copy-btn[disabled] {
            opacity: 1 !important;
        }

        select:disabled {
            color: white !important;
        }
    </style>
@endsection

@section('PAGE_CONTENT')
    <div class="register-input-container">
        <div class="container register-input-section pt-5">
            <div class="row justify-content-center">
                <div class="login-page mt-5">
                    <div class="login-title text-center">
                        <p class="mb-1 registration-title">MY DETAILS</p>
                    </div>
                    <div class="login-title text-center mb-2 mt-4">
                        <span style="font-size: 16px;">MY REFERRAL LINK<br>https://www.ventura.pro/{{ $user->customer_id ?? '123456' }}</span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center btn-section w-100 p-0 m-0 mb-5">
                        <a class="btn btn-primary copy-btn" onclick="copyLink(this,event)"
                           attr_href="{{ url('/') }}/{{ $user->customer_id }}">COPY LINK</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <form class="form-section" data-form="register" autocomplete="off" method="POST">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br/>
                            @endforeach
                        </div>
                    @endif

                    @csrf

                    <div class="row mx-0 mt-4">
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="login-title info-title">
                                    <span>FIELDS IN BLUE ARE EDITABLE</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="text" name="first_name" class="form-control" id="firstName"
                                           placeholder="First Name" tabindex="1" value="{{ $user->profile->first_name }}"
                                           readonly>
                                    <label id="first-name-error" class="has-error" for="first_name"
                                           style="display: none"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="text" name="last_name" class="form-control" id="lastName"
                                           placeholder="Last Name" tabindex="2" value="{{ $user->profile->last_name }}"
                                           readonly>
                                    <label id="last-name-error" class="has-error" for="last_name"
                                           style="display: none"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 mt-4">
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="login-title info-title">
                                    <span>DATE OF BIRTH</span>
                                </div>
                            </div>
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="text" id="date" data-format="DD-MM-YYYY" data-template="D MMM YYYY"
                                           name="birthday" value="{{ $user->profile->birthday }}" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="login-title info-title">
                                    <span>GENDER</span>
                                </div>
                            </div>
                            <div class="login-page">
                                <div class="form-group d-flex pt-2.5 pl-3">
                                    <label class="checkbox-container">
                                        <input type="radio" name="gender"
                                               {{ $user->profile->gender == 'f' ? 'checked' : '' }} id="gender-female"
                                               value="f"/>
                                        <span class="checkbox-circle"></span>
                                        <span class="checkbox-name">{{ __('FEMALE') }}</span>
                                    </label>
                                    <label class="checkbox-container pl-5">
                                        <input type="radio" name="gender" id="gender-male"
                                               {{ $user->profile->gender == 'm' ? 'checked' : '' }} value="m"/>
                                        <span class="checkbox-circle"></span>
                                        <span class="checkbox-name">{{ __('MALE') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 mt-4">
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="login-title info-title">
                                    <span class="registration-phone-label">PHONE NUMBER</span>
                                </div>
                            </div>
                            <div class="login-page">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <select class="form-control phone-select webkit_style" name="" disabled>
                                            <option value="0">{{ explode(" ", $user->profile->phone)[0] }}</option>
                                        </select>
                                        <input type="text" name="phone" class="form-control" id="real-mobileNumber"
                                               placeholder="Phone Number" hidden>
                                        <input type="text" class="form-control" id="mobileNumber"
                                               placeholder="Phone Number" tabindex="6"
                                               value="{{ count(explode(" ", $user->profile->phone)) >= 1 ?: [1] }}" readonly>
                                    </div>
                                    <label id="mobile-number-error" class="has-error" for="phone"
                                           style="display: none"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="login-title info-title">
                                    <span class="registration-email-lable">EMAIL</span>
                                </div>
                            </div>
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                                           tabindex="7" value="{{ $user->email }}" readonly>
                                    <label id="email-error" class="has-error" for="email" style="display: none"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 company-details-section mx-0">
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="login-title info-title">
                                    <span>THE COMPANY YOU REPRESENT</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="login-title info-title">
                                    <span>WEBSITE</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="text" name="company_name" class="form-control" id="companyName"
                                           placeholder="Company Name" tabindex="4"
                                           value="{{ $user->profile->company_name }}" readonly>
                                    <label id="company-name-error" class="has-error" for="company_name"
                                           style="display: none"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="text" name="site_url" class="form-control" id="vatNumber"
                                           placeholder="Website" tabindex="5" value="{{ $user->profile->site_url }}"
                                           readonly>
                                    <label id="vat-number-error" class="has-error" for="site_url"
                                           style="display: none"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mx-0">
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="login-title info-title">
                                    <span>ADDRESS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="text" name="street_name" class="form-control" id="streetName"
                                           placeholder="Street" tabindex="8" value="{{ $user->profile->street }}"
                                           readonly>
                                    <label id="street-name-error" class="has-error" for="street_name"
                                           style="display: none"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="text" name="house_number" class="form-control" id="houseNumber"
                                           placeholder="House Number" tabindex="9"
                                           value="{{ $user->profile->house_number }}" readonly>
                                    <label id="house-number-error" class="has-error" for="house_number"
                                           style="display: none"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="text" name="postal_code" class="form-control" id="postalCode"
                                           placeholder="Postal Code" tabindex="11"
                                           value="{{ $user->profile->postal_code }}" readonly>
                                    <label id="postal-code-error" class="has-error" for="postal_code"
                                           style="display: none"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <input type="text" name="city" class="form-control" id="real-city" placeholder="City"
                                       hidden value="{{ isset($user->profile->city) ? $user->profile->city : '' }}">
                                <div class="form-group search-city">
                                    <input type="text" class="form-control" id="city" placeholder="City" tabindex="10"
                                           value="{{ empty($cityname) ? isset($user->profile->city) ? $user->profile->city : 'City' : $cityname }}"
                                           readonly>
                                    <label id="city-error" class="has-error" for="city" style="display: none"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="form-group">
                                    <select class="form-control country-select webkit_style" name="" disabled>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                    @if ($country->id == $user->profile->country ) selected @endif>{{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mx-0">
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="login-title info-title">
                                    <span>LOGIN DETAILS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" id="username"
                                           placeholder="User Name" tabindex="14" value="{{ $user->username }}" readonly>
                                    <label id="username-error" class="has-error" for="username"
                                           style="display: none"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="login-page">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="Password" tabindex="15" readonly>
                                    <label id="password-error" class="has-error" for="password"
                                           style="display: none"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center pb-5 mt-4 mx-0">
                        <div class="login-page">
                            <div class="form-group row justify-content-center pb-5">
                                <div class="col-12 text-center">
                                    <a class="btn btn-primary login-button d-flex justify-content-center align-items-center"
                                       href="{{ route('profile.detail.edit') }}">
                                        {{ __('EDIT') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('PAGE_LEVEL_SCRIPTS')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            const currentDate = new Date();
            $('#date').val(`${$('#date').val().split("-")[2]}-${$('#date').val().split("-")[1]}-${$('#date').val().split("-")[0]}`);
            $('#date').combodate({
                minYear: 1900,
                maxYear: currentDate.getFullYear() - 18,
            });
            $('select.day').addClass('webkit_style');
            $('select.month').addClass('webkit_style');
            $('select.year').addClass('webkit_style');

            $('select.day').prop('disabled', true);
            $('select.month').prop('disabled', true);
            $('select.year').prop('disabled', true);
        });

        function copyLink(element, event) {
            event.preventDefault();
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).attr('attr_href')).select();
            document.execCommand("copy");
            $temp.remove();
            alert('Copied to Clipboard');
        }
    </script>
@endsection
