@extends('layouts.applogin')

@section('title')
    Verify email
@endsection
@section('content')
<main class="verify-container">
    <div class="container">
      <div class="d-flex align-items-center">
        <div class="col-12 text-center mt-4">

        <img src="{{ url('/frontend/images/logo.png')}}" class="logoVerify">
          <p class="mt-4 registering">Thank you for registering!</p>

                @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                @endif

          <img src="{{{ url('/frontend/images/email.png')}}}" class="emailVerify">

          <h3 class="verify">Verify your email address</h3>

          <p class="mb-0">Please click on the link that has just been sent to your email account to verify your email and <br>
          continue the transaction process.</p>

            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <p class="mb-5 mt-0">haven't you received the email?
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('send another email') }}</button>
                </p>    
            </form>
          
          <a href="/" class="backHome"><span><img src="{{ url('/frontend/images/back.png')}}" class="mr-2"></span>Back to Homepage</a>
        </div>
      </div>
    </div>
  </main>
@endsection
