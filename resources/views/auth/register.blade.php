@extends('auth.master_auth')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="form-auth">
        @csrf

        <div class="form-label-group">
            <input id="inputName" type="text"
                   placeholder="Name"
                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                   name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
            @endif
            <label for="inputName">Name</label>
        </div>

        <div class="form-label-group">
            <input id="inputEmail" type="email"
                   placeholder="Email address"
                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
            <label for="inputEmail">Email address</label>

        </div>

        <div class="form-label-group">
            <input id="inputPassword" type="password"
                   placeholder="Password"
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
            <label for="inputPassword">Password</label>

        </div>

        <div class="form-label-group">
            <input id="input-password-confirm" type="password" class="form-control"
                   placeholder="Confirm Password"
                   name="password_confirmation" required>

            <label for="input-password-confirm">{{ __('Confirm Password') }}</label>

        </div>

        <div class="form-label-group">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
        <div class="text-md-center">
            <p>
                <h6>Already on Twittery? Log in <a href="{{route('login')}}">here</a></h6>
            </p>
        </div>
        <div class="auth-separator">
            <h6>
                <span>or</span>
            </h6>
        </div>        <a class="btn btn-lg btn-twitter btn-block text-uppercase" href="{{ url('/auth/redirect/twitter') }}"><i
                    class="fab fa-twitter mr-2"></i> Sign in with Twitter</a>
    </form>

@endsection






{{--<div class="container">--}}
{{--<div class="row justify-content-center">--}}
{{--<div class="col-md-8">--}}
{{--<div class="card">--}}
{{--<div class="card-header">{{ __('Register') }}</div>--}}
{{--<div class="card-body">--}}
{{--<hr>--}}
{{--<div class="form-group row mb-0">--}}
{{--<div class="col-md-8 offset-md-4">--}}
{{--<a href="{{ url('/auth/redirect/twitter') }}" class="btn btn-primary"><i--}}
{{--class="fa fa-twitter"></i> Twitter</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
