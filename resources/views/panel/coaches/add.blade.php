@extends('layouts.app', ['ACTIVE_TITLE' => 'COACHES', 'ROUTES' => [
  ['ROUTE' => 'coaches.index', 'ACTIVE' => 'coaches', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'coaches.add', 'ACTIVE' => 'add', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'add'])

@section('title', __('- Coaches'))

@section('PAGE_LEVEL_STYLES')
<style type="text/css">
    select.phone-select {
        width: 140px;
        margin-right: 4px;
        padding-left: 28px !important;
        padding-right: 8px !important;
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
    }
    select.country-select {
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

    .addresstab div {
        color: #fff;
        border: none;
        outline: none;
        cursor: pointer;
        font-size: 18px;
        width: 100%;
        padding-left: 26px;
        padding-right: 20px;
    }
    .addresstab div:hover {
        background-color: #573fdb;
    }
    .important-note {
        font-weight: 500 !important;
    }
    .important-desc {
        font-size: 11px !important;
    }
</style>
@endsection

@section('PAGE_CONTENT')
<div class="register-input-container">
    <div class="container register-input-section pt-5">
        <div class="row justify-content-center">
            <div class="login-page mt-5">
                <div class="login-title text-center">
                    <p class="mb-1" style="font-size: 18px;">ADD A COACH</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <form class="form-section" data-form="register" autocomplete="off" method="POST" action="{{ route('add.coach') }}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif

                @csrf

                <input type="hidden" name="user_type" id="userType" value="0" />
                <input id="refererNumber" type="text" class="form-control" value="{{$referral_id}}" placeholder="Referer Number" disabled hidden>

                <div class="row mx-0 mt-4">
                    <div class="col-md-6">
                        <div class="login-page">
                            <div class="login-title info-title">
                                <span>NAME</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="login-page">
                            <div class="form-group">
                                <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name" tabindex="1" value="{{old('first_name')}}">
                                <label id="first-name-error" class="has-error" for="first_name" style="display: none"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-page">
                            <div class="form-group">
                                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name" tabindex="2" value="{{old('last_name')}}">
                                <label id="last-name-error" class="has-error" for="last_name" style="display: none"></label>
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
                                    <select class="form-control phone-select webkit_style" name="">
                                        @foreach ($phonecodes as $code)                                    
                                        <option value="+{{$code}}">+{{$code}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="phone" class="form-control" id="real-mobileNumber" placeholder="Phone Number" hidden>
                                    <input type="text" class="form-control" id="mobileNumber" placeholder="Phone Number" tabindex="3">
                                </div>
                                <label id="mobile-number-error" class="has-error" for="phone" style="display: none"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 company-details-section mx-0">
                    <div class="col-md-6">
                        <div class="login-page">
                            <div class="login-title info-title">
                                <span>EMAIL</span>
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
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" tabindex="4" value="{{old('email')}}">
                                <label id="email-error" class="has-error" for="email" style="display: none"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-page">
                            <div class="form-group">
                                <input type="text" name="website" class="form-control" id="website" placeholder="Website" tabindex="5" value="{{old('website')}}">
                                <label id="vat-number-error" class="has-error" for="website" style="display: none"></label>
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
                                <input type="text" name="street_name" class="form-control" id="streetName" placeholder="Street" tabindex="6" value="{{old('street_name')}}">
                                <label id="street-name-error" class="has-error" for="street_name" style="display: none"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-page">
                            <div class="form-group">
                                <input type="text" name="house_number" class="form-control" id="houseNumber" placeholder="House Number" tabindex="7" value="{{old('house_number')}}">
                                <label id="house-number-error" class="has-error" for="house_number" style="display: none"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-page">
                            <div class="form-group">
                                <input type="text" name="postal_code" class="form-control" id="postalCode" placeholder="Postal Code" tabindex="8" value="{{old('postal_code')}}">
                                <label id="postal-code-error" class="has-error" for="postal_code" style="display: none"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-page">
                            <input type="text" name="city" class="form-control" id="real-city" placeholder="City" hidden>
                            <div class="form-group search-city">
                                <input type="text" class="form-control" id="city" placeholder="City" tabindex="9" onchange="changeCity()">
                                <label id="city-error" class="has-error" for="city" style="display: none"></label>
                            </div>
                        </div>
                        <div class="addresstab">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-page">
                            <div class="form-group mb-0">
                                <input type="text" name="country" class="form-control" id="country" placeholder="Country" hidden>
                                <select class="form-control country-select webkit_style" name="">
                                    <option value="0">Country</option>
                                    @foreach ($countries as $country)                                    
                                    <option value="{{$country}}">{{$country}}</option>
                                    @endforeach
                                </select>
                                <label id="country-error" class="has-error" for="country" style="display: none"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center py-5">
                    <div class="login-page">
                        <div class="form-group row justify-content-center pb-5">
                            <div class="col-12 text-center">
                                <button class="btn btn-primary login-button button-submit" data-button="submit">
                                    {{ __('SEND') }}
                                </button>
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

        function create_custom_dropdowns() {
            $('select.country-select').each(function (i, select) {
                if (!$(this).next().hasClass('dropdown-select')) {
                    $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
                    var dropdown = $(this).next();
                    var options = $(select).find('option');
                    var selected = $(this).find('option:selected');
                    dropdown.find('.current').html(selected.data('display-text') || selected.text());
                    options.each(function (j, o) {
                        var display = $(o).data('display-text') || '';
                        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
                    });
                }
            });

            $('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');
        }

        // Open/close
        $(document).on('click', '.dropdown-select', function (event) {
            if($(event.target).hasClass('dd-searchbox')){
                return;
            }
            $('.dropdown-select').not($(this)).removeClass('open');
            $(this).toggleClass('open');
            if ($(this).hasClass('open')) {
                $(this).find('.option').attr('tabindex', 0);
                $(this).find('.selected').focus();
            } else {
                $(this).find('.option').removeAttr('tabindex');
                $(this).focus();
            }
        });

        // Close when clicking outside
        $(document).on('click', function (event) {
            if ($(event.target).closest('.dropdown-select').length === 0) {
                $('.dropdown-select').removeClass('open');
                $('.dropdown-select .option').removeAttr('tabindex');
            }
            event.stopPropagation();
        });

        function filter(){
            var valThis = $('#txtSearchValue').val();
            $('.dropdown-select ul > li').each(function(){
            var text = $(this).text();
                (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();         
        });
        };
        // Search

        // Option click
        $(document).on('click', '.dropdown-select .option', function (event) {
            $(this).closest('.list').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).data('display-text') || $(this).text();
            $(this).closest('.dropdown-select').find('.current').text(text);
            $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
            $("#real-country").val(text);
        });

        // Keyboard events
        $(document).on('keydown', '.dropdown-select', function (event) {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            // Space or Enter
            //if (event.keyCode == 32 || event.keyCode == 13) {
            if (event.keyCode == 13) {
                if ($(this).hasClass('open')) {
                    focused_option.trigger('click');
                } else {
                    $(this).trigger('click');
                }
                return false;
                // Down
            } else if (event.keyCode == 40) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    focused_option.next().focus();
                }
                return false;
                // Up
            } else if (event.keyCode == 38) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
                    focused_option.prev().focus();
                }
                return false;
                // Esc
            } else if (event.keyCode == 27) {
                if ($(this).hasClass('open')) {
                    $(this).trigger('click');
                }
                return false;
            }
        });

        $(document).ready(function () {
            // create_custom_dropdowns();
        });

        let timer = null;

        $('.register-input-section').on('click', function() {
            $('.addresstab').hide();
        })

        function changeCity() {
            $("#real-city").val(document.getElementById("city").value);
            if (document.getElementById("city").value == '') {
                $("#state").attr("disabled", false);
                $('.dropdown-select').show();
                $('#country').addClass('d-none');
            }
        }
        
        $('.search-cityyy input[type="text"]').on('keyup', function() {
            const key = $(this).val();
            if (timer) {
                clearTimeout(timer)
            }
            timer = setTimeout(function() {
                if(key == '') {
                    $('.addresstab').hide();
                } else {
                    var options = {
                        distance: 'CITY',
                        keyword: key,
                    };
                    $.ajax({
                        url: '{{ route("city.filter") }}',
                        method: "POST",
                        data: options,
                        success:function(res){                            
                            if (res.length) {
                                var html = '';
                                for(var resIndex = 0; resIndex < res.length; resIndex++) {
                                    html += 
                                        '<div class="address py-3" attr-data="' + res[resIndex].address + '"  attr-name="' + res[resIndex].name + '">' + res[resIndex].name + '</div>';
                                }
                                $('.addresstab').html(html);
                                $('.addresstab').show();
                            }
                            else {
                                $("#state").attr("disabled", false);
                                $('.dropdown-select').show();
                                $('#country').addClass('d-none');
                            }
                        },
                        error:function(err){
                            console.log("fail");
                            toastr['error']('Error');
                        }
                    })
                }
            }, 1000);
        })

        $(document).on('click', '.address', function() {
            const ids = $(this).attr('attr-data').split(',');
            const names = $(this).attr('attr-name').split(', ');
            $("#city").val(names[0]);
            // $("#state").val(names[1]);
            // $("#country").val(names[2]);
            $("#real-city").val(ids[0]);
            // $("#real-state").val(ids[1]);
            // $("#real-country").val(ids[2]);
            $('.addresstab').hide();
        })

        var user_type = 0;
        const register = {
            init: function () {
                this.variables();
                this.addEventListeners();
                this.firstInputFocus();
                // this.datePicker();
            },
            variables: function () {
                this.form = $('[data-form="register"]');
                this.submitButton = $('[data-button="submit"]');
                this.firstNameInput = $('#firstName');
                this.firstNameError = $('#first-name-error');
                this.lastNameInput = $('#lastName');
                this.lastNameError = $('#last-name-error');
                this.dateBirth = $('#dateBirth');
                this.companyNameInput = $('#companyName');
                this.companyNameError = $('#company-name-error');
                this.vatNumberInput = $('#vatNumber');
                this.vatNumberError = $('#vat-number-error');
                this.mobileNumberInput = $('#mobileNumber');
                this.mobileNumberError = $('#mobile-number-error');
                this.emailInput = $('#email');
                this.emailError = $('#email-error');
                this.streetNameInput = $('#streetName');
                this.streetNameError = $('#street-name-error');
                this.houseNumberInput = $('#houseNumber');
                this.houseNumberError = $('#house-number-error');
                this.cityInput = $('#city');
                this.cityError = $('#city-error');
                this.postalCodeInput = $('#postalCode');
                this.postalCodeError = $('#postal-code-error');
                this.stateInput = $('#state');
                this.stateError = $('#state-error');
                this.countryInput = $('#country');
                this.countryError = $('#country-error');
                this.usernameInput = $('#username');
                this.usernameError = $('#username-error');
                this.passwordInput = $('#password');
                this.passwordError = $('#password-error');
                this.scrollToError = '';
            },
            addEventListeners: function () {
                this.firstNameInput.on('keyup', function () {
                    this.validateFirstNameInput();
                }.bind(this));
                this.lastNameInput.on('keyup', function () {
                    this.validateLastNameInput();
                }.bind(this));
                this.companyNameInput.on('keyup', function () {
                    this.validateCompanyNameInput();
                }.bind(this));
                this.vatNumberInput.on('keyup', function () {
                    this.validateVatNumberInput();
                }.bind(this));
                this.mobileNumberInput.on('keyup', function () {
                    this.validateMobileNumberInput();
                }.bind(this));
                this.emailInput.on('keyup', function () {
                    this.validateEmailInput();
                }.bind(this));
                this.streetNameInput.on('keyup', function () {
                    this.validateStreetNameInput();
                }.bind(this));
                this.houseNumberInput.on('keyup', function () {
                    this.validateHouseNumberInput();
                }.bind(this));
                this.cityInput.on('keyup', function () {
                    this.validateCityInput();
                }.bind(this));
                this.postalCodeInput.on('keyup', function () {
                    this.validatePostalCodeInput();
                }.bind(this));
                this.stateInput.on('keyup', function () {
                    this.validateStateInput();
                }.bind(this));
                this.countryInput.on('keyup', function () {
                    this.validateCountryInput();
                }.bind(this));
                this.usernameInput.on('keyup', function () {
                    this.validateUsernameInput();
                }.bind(this));
                this.passwordInput.on('keyup', function () {
                    this.validatePasswordInput();
                }.bind(this));
                this.form.on('submit', function (event) {
                    if (this.validateFirstNameInput() &&
                        this.validateLastNameInput() &&
                        this.validateMobileNumberInput() &&
                        this.validateEmailInput() &&
                        this.validateStreetNameInput() &&
                        this.validateHouseNumberInput() &&
                        this.validateCityInput() &&
                        this.validatePostalCodeInput() &&
                        this.validateCountryInput()) {
                        $('.button-submit').attr('disabled', true);
                        return true;
                    } else {
                        event.preventDefault();
                        // this.scrollToElement(this.scrollToError);
                        this.scrollToError.focus();
                    }
                }.bind(this));
                $(document).on('keypress', function (e) {
                    if ((e.which === 13)) {
                        this.form.submit();
                    }
                }.bind(this));
            },
            scrollToElement: function (element) {
                $('body, html').animate({
                    scrollTop: element.offset().top - 80
                }, 500);
            },
            firstInputFocus: function () {
                setTimeout(function () {
                    this.firstNameInput.focus();
                }.bind(this), 300);
            },
            validateFirstNameInput: function () {
                var validationMessage = '';
                var value = this.firstNameInput.val();

                if ((/^[a-zA-Z\-0-9 ]{2,50}$/.test(value)) || (/^[\p{L}\d\- ]{2,50}$/u.test(value))) {
                    validationMessage = 'Now, that\'s a good name.\n';
                    this.firstNameError.addClass('valid');
                    this.firstNameError.hide();
                } else if (value === '') {
                    validationMessage = 'The name field is required.';
                    this.firstNameError.removeClass('valid');
                    this.firstNameError.show();
                } else {
                    validationMessage = 'The name must contain only letter and be minimum of 2 characters.';
                    this.firstNameError.removeClass('valid');
                    this.firstNameError.show();
                }

                this.firstNameError.html(validationMessage);
                this.scrollToError = this.firstNameInput;

                return ((/^[a-zA-Z\-0-9 ]{2,50}$/.test(value)) || (/^[\p{L}\d\- ]{2,50}$/u.test(value)));
            },
            validateLastNameInput: function () {
                var validationMessage = '';
                var value = this.lastNameInput.val();

                if ((/^[a-zA-Z\-0-9 ]{2,50}$/.test(value)) || (/^[\p{L}\d\- ]{2,50}$/u.test(value))) {
                    validationMessage = 'Now, that\'s a good last name.\n';
                    this.lastNameError.addClass('valid');
                    this.lastNameError.hide();
                } else if (value === '') {
                    validationMessage = 'The last name field is required.';
                    this.lastNameError.removeClass('valid');
                    this.lastNameError.show();
                } else {
                    validationMessage = 'The last name must contain only letter and be minimum of 2 characters.';
                    this.lastNameError.removeClass('valid');
                    this.lastNameError.show();
                }

                this.lastNameError.html(validationMessage);
                this.scrollToError = this.lastNameInput;

                return ((/^[a-zA-Z\-0-9 ]{2,50}$/.test(value)) || (/^[\p{L}\d\- ]{2,50}$/u.test(value)));
            },
            validateCompanyNameInput: function () {
                var validationMessage = '';
                var value = this.companyNameInput.val();

                if (user_type == 0) {
                    return true
                }

                if ((/^[a-zA-Z\-0-9 ]{2,50}$/.test(value)) || (/^[\p{L}\d\- ]{2,50}$/u.test(value))) {
                    validationMessage = 'Now, that\'s a good company name.\n';
                    this.companyNameError.addClass('valid');
                    this.companyNameError.hide();
                } else if (value === '') {
                    validationMessage = 'The company name field is required.';
                    this.companyNameError.removeClass('valid');
                    this.companyNameError.show();
                } else {
                    validationMessage = 'The company name must contain only letter and be minimum of 2 characters.';
                    this.companyNameError.removeClass('valid');
                    this.companyNameError.show();
                }

                this.companyNameError.html(validationMessage);
                this.scrollToError = this.companyNameInput;

                return ((/^[a-zA-Z\-0-9 ]{2,50}$/.test(value)) || (/^[\p{L}\d\- ]{2,50}$/u.test(value)));
            },
            validateVatNumberInput: function () {
                var validationMessage = '';
                var value = this.vatNumberInput.val();

                if (user_type == 0) {
                    return true
                }

                if ((/^[a-zA-Z\-0-9 ]{2,50}$/.test(value))) {
                    validationMessage = 'Now, that\'s a good vat number.\n';
                    this.vatNumberError.addClass('valid');
                    this.vatNumberError.hide();
                } else if (value === '') {
                    validationMessage = 'The vat number field is required.';
                    this.vatNumberError.removeClass('valid');
                    this.vatNumberError.show();
                } else {
                    validationMessage = 'The vat number must contain only letter and be minimum of 2 characters.';
                    this.vatNumberError.removeClass('valid');
                    this.vatNumberError.show();
                }

                this.vatNumberError.html(validationMessage);
                this.scrollToError = this.vatNumberInput;

                return ((/^[a-zA-Z\-0-9 ]{2,50}$/.test(value)));
            },
            validateMobileNumberInput: function () {
                var validationMessage = '';
                var value = $('.phone-select').val() + ' ' + this.mobileNumberInput.val();
                $("#real-mobileNumber").val(value);

                if ((/^[0-9 ]{7,50}$/.test(value.trim())) || (/^(\+)?[0-9 ]{6,50}$/.test(value.trim()))) {
                    validationMessage = 'Now, that\'s a good phone number.\n';
                    this.mobileNumberError.addClass('valid');
                    this.mobileNumberError.hide();
                } else if (value === '') {
                    validationMessage = 'Phone number is required.';
                    this.mobileNumberError.removeClass('valid');
                    this.mobileNumberError.show();
                } else {
                    validationMessage = 'Minimum 7 digits.';
                    this.mobileNumberError.removeClass('valid');
                    this.mobileNumberError.show();
                }

                this.mobileNumberError.html(validationMessage);
                this.scrollToError = this.mobileNumberInput;

                return ((/^[0-9 ]{7,50}$/.test(value.trim())) || (/^(\+)?[0-9 ]{6,50}$/.test(value.trim())));
            },
            validateEmailInput: function () {
                var validationMessage = '';
                var value = this.emailInput.val();
                var action = 'verifyEmail';
                let self = this;
                if (timer) {
                    clearTimeout(timer)
                }
                timer = setTimeout(async function() {
                    var response = await onVerify(action, value);
                    if (response.status) {
                        validationMessage = 'Email is in use already.';
                        self.emailError.removeClass('valid');
                        self.emailError.show();
                    } else {
                        if ((/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value))) {
                            validationMessage = 'Now, that\'s a good email.\n';
                            self.emailError.addClass('valid');
                            self.emailError.hide();
                        } else if (value === '') {
                            validationMessage = 'The email field is required.';
                            self.emailError.removeClass('valid');
                            self.emailError.show();
                        } else {
                            validationMessage = 'Email is not valid.';
                            self.emailError.removeClass('valid');
                            self.emailError.show();
                        }
                    }

                    self.emailError.html(validationMessage);
                    self.scrollToError = self.emailInput;
                }, 1000)

                return ((/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value)));
            },
            validateStreetNameInput: function () {
                var validationMessage = '';
                var value = this.streetNameInput.val();

                if ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value))) {
                    validationMessage = 'Now, that\'s a good street name.\n';
                    this.streetNameError.addClass('valid');
                    this.streetNameError.hide();
                } else if (value === '') {
                    validationMessage = 'Street name is required.';
                    this.streetNameError.removeClass('valid');
                    this.streetNameError.show();
                } else {
                    validationMessage = 'The street name must contain letter and number and be minimum of 3 characters.';
                    this.streetNameError.removeClass('valid');
                    this.streetNameError.show();
                }

                this.streetNameError.html(validationMessage);
                this.scrollToError = this.streetNameInput;

                return ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value)));
            },
            validateHouseNumberInput: function () {
                var validationMessage = '';
                var value = this.houseNumberInput.val();

                if ((/^.{1,50}$/.test(value))) {
                    validationMessage = 'Now, that\'s a good house number.\n';
                    this.houseNumberError.addClass('valid');
                    this.houseNumberError.hide();
                } else if (value === '') {
                    validationMessage = 'House number is required.';
                    this.houseNumberError.removeClass('valid');
                    this.houseNumberError.show();
                } else {
                    validationMessage = 'The house number must contain letter and number and be minimum of 3 characters.';
                    this.houseNumberError.removeClass('valid');
                    this.houseNumberError.show();
                }

                this.houseNumberError.html(validationMessage);
                this.scrollToError = this.houseNumberInput;

                return ((/^.{1,50}$/.test(value)));
            },
            validateCityInput: function () {
                var validationMessage = '';
                var value = this.cityInput.val();

                if ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value))) {
                    validationMessage = 'Now, that\'s a good city name.\n';
                    this.cityError.addClass('valid');
                    this.cityError.hide();
                } else if (value === '') {
                    validationMessage = 'The city name field is required.';
                    this.cityError.removeClass('valid');
                    this.cityError.show();
                } else {
                    validationMessage = 'The city name must contain letter and number and be minimum of 3 characters.';
                    this.cityError.removeClass('valid');
                    this.cityError.show();
                }

                this.cityError.html(validationMessage);
                this.scrollToError = this.cityInput;

                return ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value)));
            },
            validatePostalCodeInput: function () {
                var validationMessage = '';
                var value = this.postalCodeInput.val();

                if ((/^.{3,50}$/.test(value))) {
                    validationMessage = 'Now, that\'s a good zip code.\n';
                    this.postalCodeError.addClass('valid');
                    this.postalCodeError.hide();
                } else if (value === '') {
                    validationMessage = 'Zip code is required.';
                    this.postalCodeError.removeClass('valid');
                    this.postalCodeError.show();
                } else {
                    validationMessage = 'Minimum 3 characters / digits.';
                    this.postalCodeError.removeClass('valid');
                    this.postalCodeError.show();
                }

                this.postalCodeError.html(validationMessage);
                this.scrollToError = this.postalCodeInput;

                return ((/^.{3,50}$/.test(value)));
            },
            validateStateInput: function () {
                var validationMessage = '';
                var value = this.stateInput.val();

                if ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value))) {
                    validationMessage = 'Now, that\'s a good area name.\n';
                    this.stateError.addClass('valid');
                    this.stateError.hide();
                } else if (value === '') {
                    validationMessage = 'The area name field is required.';
                    this.stateError.removeClass('valid');
                    this.stateError.show();
                } else {
                    validationMessage = 'The area name must contain letter and number and be minimum of 3 characters.';
                    this.stateError.removeClass('valid');
                    this.stateError.show();
                }

                this.stateError.html(validationMessage);
                this.scrollToError = this.stateInput;

                return ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value)));
            },
            validateCountryInput: function () {
                var validationMessage = '';
                var value_from_dropdown = $('.current').text();
                var value = $('.country-select').val();
                $("#country").val(value);

                if ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value)) || (/^[a-zA-Z\-0-9 ]{3,50}$/.test(value_from_dropdown)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value_from_dropdown))) {
                    validationMessage = 'Now, that\'s a good country name.\n';
                    this.countryError.addClass('valid');
                    this.countryError.hide();
                } else if (value === '' || value_from_dropdown === '') {
                    validationMessage = 'Country is required.';
                    this.countryError.removeClass('valid');
                    this.countryError.show();
                } else {
                    validationMessage = 'Minimum 3 characters.';
                    this.countryError.removeClass('valid');
                    this.countryError.show();
                }

                this.countryError.html(validationMessage);
                this.scrollToError = this.countryInput;

                if (value !== '') {
                    return ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value)));
                }
                else {
                    return ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value_from_dropdown)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value_from_dropdown)));
                }
                
            },
            validateUsernameInput: function () {
                var validationMessage = '';
                var value = this.usernameInput.val();
                var action = 'verifyUsername';
                let self = this;
                if (timer) {
                    clearTimeout(timer)
                }
                timer = setTimeout(async function() {
                    var response = await onVerify(action, value);
                    if (response.status) {
                        validationMessage = 'This username is taken';
                        self.usernameError.removeClass('valid');
                        self.usernameError.show();
                    } else {
                        if ((/^.{6,50}$/.test(value))) {
                            validationMessage = 'Now, that\'s a good username.\n';
                            self.usernameError.addClass('valid');
                            self.usernameError.hide();
                        } else if (value === '') {
                            validationMessage = 'Username is required.';
                            self.usernameError.removeClass('valid');
                            self.usernameError.show();
                        } else {
                            validationMessage = 'Minimum 6 characters / digits.';
                            self.usernameError.removeClass('valid');
                            self.usernameError.show();
                        }
                    }

                    self.usernameError.html(validationMessage);
                    self.scrollToError = self.usernameInput;
                }, 1000)

                return ((/^.{6,50}$/.test(value)));
            },
            validatePasswordInput: function () {
                var validationMessage = '';
                var value = this.passwordInput.val();

                if ((/\d/.test(value)) && (/[a-zA-Z]/.test(value)) && (/^.{7,}$/.test(value))) {
                    validationMessage = 'Now, that\'s a secure password.\n';
                    this.validRegisterPassword();
                } else if ((/\d/.test(value)) && (/[a-zA-Z]/.test(value))) {
                    validationMessage = 'Password must contain a <strong><del>letter</del></strong> and a <strong><del>number</del></strong>, and be minimum of <strong>7 characters</strong>.';
                    this.errorRegisterPassword();
                } else if ((/^.{7,}$/.test(value)) && (/[a-zA-Z]/.test(value))) {
                    validationMessage = 'Password must contain a <strong><del>letter</del></strong> and a <strong>number</strong>, and be minimum of <strong><del>7 characters</del></strong>.';
                    this.errorRegisterPassword();
                } else if ((/^.{7,}$/.test(value)) && (/\d/.test(value))) {
                    validationMessage = 'Password must contain a <strong>letter</strong> and a <strong><del>number</del></strong>, and be minimum of <strong><del>7 characters</del></strong>.';
                    this.errorRegisterPassword();
                } else if ((/^.{7,}$/.test(value))) {
                    validationMessage = 'Password must contain a <strong>letter</strong> and a <strong>number</strong>, and be minimum of <strong><del>7 characters</del></strong>.';
                    this.errorRegisterPassword();
                } else if ((/\d/.test(value))) {
                    validationMessage = 'Password must contain a <strong>letter</strong> and a <strong><del>number</del></strong>, and be minimum of <strong>7 characters</strong>.';
                    this.errorRegisterPassword();
                } else if ((/[a-zA-Z]/.test(value))) {
                    validationMessage = 'Password must contain a <strong><del>letter</del></strong> and a <strong>number</strong>, and be minimum of <strong>7 characters</strong>.';
                    this.errorRegisterPassword();
                } else if (value === '') {
                    validationMessage = 'Password must contain a <strong>letter</strong> and a <strong>number</strong>, and be minimum of <strong>7 characters</strong>.';
                    this.errorRegisterPassword();
                } else {
                    validationMessage = 'Password must contain a <strong>letter</strong> and a <strong>number</strong>, and be minimum of <strong>7 characters</strong>.';
                    this.errorRegisterPassword();
                }

                this.passwordError.html(validationMessage);
                this.scrollToError = this.passwordInput;

                return (/\d/.test(value)) && (/[a-zA-Z]/.test(value)) && (/^.{7,}$/.test(value));
            },
            validRegisterPassword: function () {
                this.passwordError.addClass('valid');
                this.passwordError.hide();
            },
            errorRegisterPassword: function () {
                this.passwordError.removeClass('valid');
                this.passwordError.show();
            },
            // datePicker: function () {
            //     this.dateBirth.datepicker({
            //         autoclose: true,
            //         todayHighlight: true,
            //         endDate: '-18y',
            //         format: 'yyyy-mm-dd',
            //         showOnFocus: true
            //     }).on('hide', function () {
            //         if (!this.firstHide) {
            //             if (!$(this).is(":focus")) {
            //                 this.firstHide = true;
            //                 // this will inadvertently call show (we're trying to hide!)
            //                 this.focus();
            //             }
            //         } else {
            //             this.firstHide = false;
            //         }
            //     }).on('show', function () {
            //         if (this.firstHide) {
            //             // careful, we have an infinite loop!
            //             $(this).datepicker('hide');
            //         }
            //     })
            // },
            addLoader: function () {
                this.submitButton.addClass('loader');
            },
            removeLoader: function () {
                this.submitButton.removeClass('loader');
            }
        };

        $(document).ready(function () {
            register.init();

            const currentDate = new Date();
            $('#date').val(`${currentDate.getDate()}-${currentDate.getMonth() + 1}-${currentDate.getFullYear() - 18}`);
            $('#date').combodate({
                minYear: 1900,
                maxYear: currentDate.getFullYear() - 18,
            });
            $('select.day').addClass('webkit_style');
            $('select.month').addClass('webkit_style');
            $('select.year').addClass('webkit_style');

        });

        function onVerify(action, value) {
            return $.ajax({
                url: '{{ route('auth.verify') }}',
                type: 'POST',
                data: {
                    key: action,
                    value: value
                }
            });
        }

    </script>
@endsection