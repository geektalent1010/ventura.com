@extends('layouts.landing')

@section('title', __('- Log In'))

@section('PAGE_LEVEL_STYLES')
@endsection

@section('PAGE_CONTENT')
<div class="main-bg-login d-flex justify-content-center align-items-center">
    <div class="row justify-content-center">
        <div class="enquiry-send-form">
            <div class="login-page">
                <div class="login-title text-center mb-4">
                    <p>ALMOST...</p>
                    <span class="join-desc">We will open up soon for registrations.<br>Leave your name, country, email address<br>and we’ll keep you in the loop.</span>
                </div>                
                <form id="enquiryform">
                    @csrf

                    <div class="form-group row justify-content-center">
                        <div class="col-12">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Your Name" required autocomplete="username" autofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-12">
                            <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="country" placeholder="Your Country" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center mb-0">
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary login-button send-button">
                                {{ __('Send') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="login-page enquiry-success-form d-none">
            <img class="w-100" src="{{ asset('images/svg/ThankYou.svg') }}" alt="ThankYou svg">
            <div class="enquiry-desc text-center">
                <p class="mb-1">YOUR ENQUIRY</p>
                <p>IS BEING PROCESSED</p>
                <span class="desktop">A member of our team will be in touch shortly</span>
                <span class="mobile">A member of our team<br>will be in touch shortly</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script>
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $("#enquiryform").submit(function(e) {
        e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route('enquiry.send') }}',
                data: $("#enquiryform").serialize(),
                success:function(data){
                if (data.status) {
                    if (!$('.enquiry-send-form').hasClass('d-none')) {
                        $('.enquiry-send-form').addClass('d-none');
                    }
                    $('.enquiry-success-form').removeClass('d-none');
                } else {
                    toastr['error'](data.message, 'Error');
                }
                },
                error:function(data){
                console.log(data);
                }
            });
        });

    });
</script>
@endsection