@extends('layouts.applogin')

@section('title')
    Register
@endsection

@section('content')
<main class="login-container">
    <div class="container">
        <div class="row page-login d-flex align-items-center">

            <div class="section-left col-12 col-md-6">
            <h1>Join us to explore <br>
                the wider world</h1>
                <img src="{{ url('/frontend/images/images-register.png')}}" alt="" class="w-75 d-none d-sm-flex">
            </div> 

            <div class="section-right col-12 col-md-4">
                <div class="card">

                    {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ url('/frontend/images/logo.png')}}" alt="" class="w-50 mb-4">
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
      
                            <div class="form-group">
                                <label>{{ __('Name') }}</label>
      
                                {{-- <div class="col-md-6"> --}}
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
      
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                {{-- </div> --}}
                            </div>
      
                            <div class="form-group">
                                <label>{{ __('Username') }}</label>
      
                                {{-- <div class="col-md-6"> --}}
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
      
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                {{-- </div> --}}
                            </div>
      
                            <div class="form-group">
                                <label>{{ __('E-Mail Address') }}</label>
      
                                {{-- <div class="col-md-6"> --}}
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
      
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                {{-- </div> --}}
                            </div>
      
                            <div class="form-group">
                                <label>{{ __('Password') }}</label>
      
                                {{-- <div class="col-md-6"> --}}
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
      
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                {{-- </div> --}}
                            </div>
      
                            <div class="form-group">
                                <label>{{ __('Confirm Password') }}</label>
      
                                {{-- <div class="col-md-6"> --}}
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                {{-- </div> --}}
                            </div>
      
                            {{-- <div class="form-group row mb-0"> --}}
                                {{-- <div class="col-md-6 offset-md-4"> --}}
                                    <button type="submit" class="btn btn-register btn-block mt-4">
                                        {{ __('Register') }}
                                    </button>
                                {{-- </div> --}}
                            {{-- </div> --}}
                        </form>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
