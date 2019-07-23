@extends('auth.master_auth')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="form-auth">
        @csrf
        <div class="form-label-group">
            <input id="inputEmail" type="email"
                   placeholder="Email address"
                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
            <label for="inputEmail">Email address</label>
        </div>

        <div class="form-label-group">
            <input id="inputPassword" type="password" placeholder="Password"
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
            <label for="inputPassword">Password</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Remember password</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">LogIn</button>
{{--        <div class="text-md-center">--}}
{{--            <p>--}}
{{--            <h6>New on Twittery? Register <a href="{{route('register')}}">here</a>--}}
{{--            </h6>--}}
{{--            </p>--}}
{{--        </div>--}}
        <div class="auth-separator">
            <h6>
                <span>or</span>
            </h6>
        </div>

        <a class="btn btn-lg btn-twitter btn-block text-uppercase" href="{{ url('/auth/redirect/twitter') }}"><i
                    class="fab fa-twitter mr-2"></i> Log in with Twitter</a>
    </form>
@endsection


