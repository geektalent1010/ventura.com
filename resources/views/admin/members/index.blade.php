@extends('layouts.admin', ['ACTIVE_TITLE' => 'MEMBERS'])

@section('title', __('- Members'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

<div class="admin-main-bg">
  <div class="container-fluid">
    <div class="row admin-members-section pt-1">
      <div class="col-md-4 d-flex flex-column">
        <div class="w-100 position-relative">
          <div class="search-input-section">
            <input type="text" class="form-control" name="searchKey" placeholder="Search Name, ID, Email">
            <div class="search-icon-section">
              <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
          </div>
          <div class="user-search-section mt-1"></div>
        </div>
        <form class="form-section" data-form="update-user-detail" autocomplete="off" method="POST" action="{{ route('admin.members.infoUpdate') }}">
          @csrf
          <input type="text" name="user_id" class="form-control" id="user-id" value="{{ $user->id }}" hidden>
        <div class="user-info-section mt-1">
          <div class="user-info-item mb-1">
            <div class="item-label">First Name</div>
            <div class="item-value">
              <div class="form-group">
                <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name" value="{{ $user->profile->first_name ?? '' }}" disabled>
                <label id="first-name-error" class="has-error" for="first_name" style="display: none"></label>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">Last Name</div>
            <div class="item-value">
              <div class="form-group">
                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name" value="{{ $user->profile->last_name ?? '' }}" disabled>
                <label id="last-name-error" class="has-error" for="last_name" style="display: none"></label>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">Street</div>
            <div class="item-value">
              <div class="form-group">
                <input type="text" name="street_name" class="form-control" id="streetName" placeholder="Street" value="{{ $user->profile->street ?? '' }}" disabled>
                <label id="street-name-error" class="has-error" for="street_name" style="display: none"></label>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">House Nr</div>
            <div class="item-value">
              <div class="form-group">
                <input type="text" name="house_number" class="form-control" id="houseNumber" placeholder="House/Building Number" value="{{ $user->profile->house_number ?? '' }}" disabled>
                <label id="house-number-error" class="has-error" for="house_number" style="display: none"></label>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">City</div>
            <div class="item-value">
              <input type="text" name="city" class="form-control" id="real-city" placeholder="City" value="{{ isset($user->profile->city) ? $user->profile->city : '' }}" hidden>
              <div class="form-group search-city">
                <input type="text" class="form-control" id="city" placeholder="City" value="{{ empty($city) ? '' : $city }}" disabled>
                <label id="city-error" class="has-error" for="city" style="display: none"></label>
              </div>
            </div>
            <div class="address-search-section"></div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">Area</div>
            <div class="item-value">
              <input type="text" name="state" class="form-control" id="real-state" placeholder="Area" value="{{ isset($user->profile->state) ? $user->profile->state : '' }}" hidden>
              <div class="form-group">
                <input type="text" class="form-control disabled" id="state" placeholder="Area" value="{{ empty($state) ? '' : $state }}" disabled>
                <label id="state-error" class="has-error" for="state" style="display: none"></label>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">Country</div>
            <div class="item-value">
              <input type="text" name="country" class="form-control" id="real-country" placeholder="Country" value="{{ isset($user->profile->country) ? $user->profile->country : '' }}" hidden>
              <div class="form-group">
                <input type="text" class="form-control disabled" id="country" placeholder="Country" value="{{ empty($country) ? '' : $country }}" disabled>
                <label id="country-error" class="has-error" for="country" style="display: none"></label>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">Phone</div>
            <div class="item-value">
              <div class="form-group">
                <input type="text" name="phone" class="form-control" id="mobileNumber" placeholder="Phone Number" value="{{ $user->phone ?? '' }}" disabled>
                <label id="mobile-number-error" class="has-error" for="phone" style="display: none"></label>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">E-mail</div>
            <div class="item-value">
              <div class="form-group">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="{{ $user->email ?? '' }}" disabled>
                <label id="email-error" class="has-error" for="email" style="display: none"></label>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">User Name</div>
            <div class="item-value">
              <div class="form-group">
                <input type="text" class="form-control disabled" id="username" placeholder="User Name" value="{{ $user->username }}" disabled>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">Password</div>
            <div class="item-value">
              <input type="password" name="changePassword" class="form-control" id="change-password" placeholder="Password" value="0" hidden>
              <div class="form-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="" disabled>
                <label id="password-error" class="has-error" for="password" style="display: none"></label>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">User ID</div>
            <div class="item-value">
              <div class="form-group">
                <input type="text" class="form-control disabled" id="customerId" placeholder="User ID" value="{{ $user->customer_id }}" disabled>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">Start</div>
            <div class="item-value">
              <div class="form-group">
                <input type="text" class="form-control disabled" id="startDate" placeholder="Start At" value="{{ date_format($user->created_at, 'm-d-Y' ) }}" disabled>
              </div>
            </div>
          </div>
          <div class="user-info-item mb-1">
            <div class="item-label">Package</div>
            <div class="item-value d-flex align-items-center">
              <div class="package-card">1</div>
              <div class="package-card active mx-1">6</div>
              <div class="package-card">12</div>
              <div class="button-section ml-4">
                <button class="btn btn-primary save-button edit-button" type="button">EDIT</button>
                <button class="btn btn-primary save-button button-submit d-none" data-button="submit">SAVE</button>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
      <div class="col-md-4 d-flex flex-column">
        <div class="title-section">PAYMENT TYPE</div>
        <div class="payment-card-section mt-1">
          <div class="row mx-0 px-0" style="grid-gap: 0.25rem;">
            <div class="payment-card active">CREDIT CARD</div>
            <div class="payment-card">PAYPAL</div>
            <div class="payment-card">BANK</div>
            <div class="payment-card">CRYPTO</div>
          </div>
        </div>
        <div class="title-section mt-1">TRANSACTIONS</div>
        <div class="transactions-section my-1">
          <div class="d-flex align-items-center">
            <div class="transaction-date">01-01-2024</div>
            <div class="transaction-in-out active">IN</div>
            <div class="transaction-price">€6,00</div>
            <div class="transaction-package">Package 12</div>
          </div>
          <div class="transaction-user py-2">Elon Musk</div>
          <div class="d-flex align-items-center">
            <div class="transaction-date">01-01-2024</div>
            <div class="transaction-in-out">OUT</div>
            <div class="transaction-price">€6,00</div>
            <div class="transaction-package">Commission</div>
          </div>
          <div class="transaction-user py-2">Wallet</div>
        </div>
      </div>
      <div class="col-md-4 d-flex flex-column">
        <div class="title-section red-bg cursor-pointer suspend-button" attr-data="{{ $user->status }}">{{ $user->status != 1 ? 'UNBLOCK' : 'BLOCK' }} USER</div>
        <div class="unblock-user-content mt-1">Tried to hack the system</div>
        <div class="title-section mt-1">REFERRALS</div>
        <div class="referrals-section my-1">
          <div class="d-flex align-items-center pb-2">
            <div class="referral-date">01-01-2024</div>
            <div class="referral-user">Elon Musk</div>
            <div class="referral-status">
              <div class="status active"><i class="fa-solid fa-circle"></i></div>
              <div class="value">12</div>
            </div>
          </div>
          <div class="d-flex align-items-center pb-2">
            <div class="referral-date">01-01-2024</div>
            <div class="referral-user">Donald Trump</div>
            <div class="referral-status">
              <div class="status"><i class="fa-solid fa-circle"></i></div>
              <div class="value">T</div>
            </div>
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
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  let timer = null;

  $('.main-bg').on('click', function() {
      $('.address-search-section').hide();
      $('.user-search-section').hide();
  })

  $('.search-city input[type="text"]').on('keyup', function() {
      const key = $(this).val();
      if (timer) {
          clearTimeout(timer)
      }
      timer = setTimeout(function() {
          if(key == '') {
              $('.address-search-section').hide();
          } else {
              var options = {
                  distance: 'CITY',
                  keyword: key,
              };
              $.ajax({
                  url: '{{ route("connect.address.search") }}',
                  method: "POST",
                  data: options,
                  success:function(res){
                      if (res.length) {
                          var html = '';
                          for(var resIndex = 0; resIndex < res.length; resIndex++) {
                              html +=
                                  '<div class="address py-3" attr-data="' + res[resIndex].address + '"  attr-name="' + res[resIndex].name + '">' + res[resIndex].name + '</div>';
                          }
                          $('.address-search-section').html(html);
                          $('.address-search-section').show();
                      }
                  },
                  error:function(err){
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
      $("#state").val(names[1]);
      $("#country").val(names[2]);
      $("#real-city").val(ids[0]);
      $("#real-state").val(ids[1]);
      $("#real-country").val(ids[2]);
      $('.address-search-section').hide();
  })

  $('.search-icon-section').on('click', function () {
      const key = $('.search-input-section input[type="text"]').val();
      if(key == '') {
          $('.user-search-section').hide();
      } else {
          var options = {
              keyword: key,
          };
          $.ajax({
              url: '{{ route("connect.search.filter") }}',
              method: "POST",
              data: options,
              success:function(res){
                  if (res.length) {
                      var html = '';
                      for(var resIndex = 0; resIndex < res.length; resIndex++) {
                          html +=
                              '<div class="user py-3" attr-data="' + res[resIndex].user_id + '">' + res[resIndex].first_name + ' ' + res[resIndex].last_name + '</div>';
                      }
                      $('.user-search-section').html(html);
                      $('.user-search-section').show();
                  }
              },
              error:function(err){
                  toastr['error']('Error');
              }
          })
      }
  });

  $('.search-input-section input[type="text"]').on('keyup', function () {
      const key = $(this).val();
      if (timer) {
          clearTimeout(timer)
      }
      timer = setTimeout(function() {
          if(key == '') {
              $('.user-search-section').hide();
          } else {
              var options = {
                  keyword: key,
              };
              $.ajax({
                  url: '{{ route("connect.search.filter") }}',
                  method: "POST",
                  data: options,
                  success:function(res){
                      if (res.length) {
                          var html = '';
                          for(var resIndex = 0; resIndex < res.length; resIndex++) {
                              html +=
                                  '<div class="user py-3" attr-data="' + res[resIndex].user_id + '">' + res[resIndex].first_name + ' ' + res[resIndex].last_name + '</div>';
                          }
                          $('.user-search-section').html(html);
                          $('.user-search-section').show();
                      }
                  },
                  error:function(err){
                      toastr['error']('Error');
                  }
              })
          }
      }, 1000);
  });

  $(document).on('click', '.user', function() {
      const userId = $(this).attr('attr-data');
      window.location.href = '{{ url('') }}/admin/members/' + userId;
  })

  const updateUserDetail = {
      init: function () {
          this.variables();
          this.addEventListeners();
      },
      variables: function () {
          this.form = $('[data-form="update-user-detail"]');
          this.editToggleButton = $('.edit-button');
          this.submitButton = $('[data-button="submit"]');
          this.firstNameInput = $('#firstName');
          this.firstNameError = $('#first-name-error');
          this.lastNameInput = $('#lastName');
          this.lastNameError = $('#last-name-error');
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
          // this.postalCodeInput = $('#postalCode');
          // this.postalCodeError = $('#postal-code-error');
          this.stateInput = $('#state');
          this.stateError = $('#state-error');
          this.countryInput = $('#country');
          this.countryError = $('#country-error');
          // this.usernameInput = $('#username');
          // this.usernameError = $('#username-error');
          this.passwordInput = $('#password');
          this.passwordError = $('#password-error');
          // this.passwordConfirmInput = $('#password-confirm');
          // this.passwordConfirmError = $('#password-confirm-error');
          this.scrollToError = '';
      },
      addEventListeners: function () {
          this.editToggleButton.on('click', function () {
              this.firstNameInput.attr('disabled', false);
              this.lastNameInput.attr('disabled', false);
              this.mobileNumberInput.attr('disabled', false);
              this.emailInput.attr('disabled', false);
              this.streetNameInput.attr('disabled', false);
              this.houseNumberInput.attr('disabled', false);
              this.cityInput.attr('disabled', false);
              this.passwordInput.attr('disabled', false);
          }.bind(this));
          this.firstNameInput.on('keyup', function () {
              this.validateFirstNameInput();
          }.bind(this));
          this.lastNameInput.on('keyup', function () {
              this.validateLastNameInput();
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
          // this.postalCodeInput.on('keyup', function () {
          //     this.validatePostalCodeInput();
          // }.bind(this));
          this.stateInput.on('keyup', function () {
              this.validateStateInput();
          }.bind(this));
          this.countryInput.on('keyup', function () {
              this.validateCountryInput();
          }.bind(this));
          // this.usernameInput.on('keyup', function () {
          //     this.validateUsernameInput();
          // }.bind(this));
          this.passwordInput.on('keyup', function () {
              this.validatePasswordInput();
          }.bind(this));
          // this.passwordConfirmInput.on('keyup', function () {
          //     this.validatePasswordConfirmInput();
          // }.bind(this));
          this.form.on('submit', function (event) {
              if (this.validateFirstNameInput() &&
                  this.validateLastNameInput() &&
                  this.validateMobileNumberInput() &&
                  this.validateEmailInput() &&
                  this.validateStreetNameInput() &&
                  this.validateHouseNumberInput() &&
                  this.validateCityInput() &&
                  // this.validatePostalCodeInput() &&
                  this.validateStateInput() &&
                  this.validateCountryInput()) {
                  $('.button-submit').attr('disabled', true);
                  return true;
              } else {
                  event.preventDefault();
                  this.scrollToElement(this.scrollToError);
                  this.scrollToError.focus();
              }
          }.bind(this));
      },
      scrollToElement: function (element) {
          $('body, html').animate({
              scrollTop: element.offset().top - 80
          }, 500);
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
      validateMobileNumberInput: function () {
          var validationMessage = '';
          var value = this.mobileNumberInput.val();

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
          var value = this.countryInput.val();

          if ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value))) {
              validationMessage = 'Now, that\'s a good country name.\n';
              this.countryError.addClass('valid');
              this.countryError.hide();
          } else if (value === '') {
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

          return ((/^[a-zA-Z\-0-9 ]{3,50}$/.test(value)) || (/^[\p{L}\d\- ]{3,50}$/u.test(value)));
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
                  validationMessage = 'The username seems to be exist !';
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
          $("#change-password").val(1);

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
              $("#change-password").val(0);
              this.validRegisterPassword();
          } else {
              validationMessage = 'Password must contain a <strong>letter</strong> and a <strong>number</strong>, and be minimum of <strong>7 characters</strong>.';
              $("#change-password").val(0);
              this.validRegisterPassword();
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
      // validatePasswordConfirmInput: function () {
      //     var validationMessage = '';
      //     var password = this.passwordInput.val();
      //     var password_confirm = this.passwordConfirmInput.val();
      //     if (password === '') {
      //         validationMessage = "Please fill out password first.";
      //         this.errorRegisterPasswordConfirm();
      //     }
      //     else if (password_confirm !== password) {
      //         validationMessage = "Password does not match";
      //         this.errorRegisterPasswordConfirm();
      //     }
      //     else  {
      //         this.validRegisterPasswordConfirm();
      //     }

      //     this.passwordConfirmError.html(validationMessage);
      //     this.scrollToError = this.passwordConfirmInput;

      //     return (/\d/.test(password_confirm)) && (/[a-zA-Z]/.test(password_confirm)) && (/^.{7,}$/.test(password_confirm));
      // },
      // validRegisterPasswordConfirm: function () {
      //     this.passwordConfirmError.addClass('valid');
      //     this.passwordConfirmError.hide();
      // },
      // errorRegisterPasswordConfirm: function () {
      //     this.passwordConfirmError.removeClass('valid');
      //     this.passwordConfirmError.show();
      // },
  };

  function onVerify(action, value) {
      return $.ajax({
          url: '{{ route('user.verify') }}',
          type: 'POST',
          data: {
              key: action,
              value: value
          }
      });
  }

  $('.edit-button').on('click', function() {
      $(this).addClass('d-none');
      $('.button-submit').removeClass('d-none');
  })

  $('.suspend-button').on('click', function() {
      var status = $(this).attr('attr-data');
      var send_data = {};
      send_data['id'] = '{{ $user->id }}';
      send_data['status'] = status != 1 ? 1 : 0;
      $.ajax({
          type: 'PUT',
          url: '{{ route('admin.members.statusUpdate') }}',
          data: send_data,
          success: function(data) {
              $('.suspend-button').html(status != 1 ? 'BLOCK USER' : 'UNBLOCK USER')
              $('.suspend-button').attr('attr-data', status != 1 ? 1 : 0);
              toastr['success'](data.success, 'Success');
          }
      })
  });

  $(document).ready(function () {
      updateUserDetail.init();
  });
</script>
@endsection