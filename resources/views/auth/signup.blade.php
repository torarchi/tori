@extends('layouts.default')

@section('content')
    <h3>Регистрация</h3>
    <form method="post" action="{{ route('signup') }}">
        @csrf
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
            <label for="floatingInput">Email address</label>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name ="username" placeholder="Username" value="{{ old('username') }}">
            <label for="floatingInput">Username</label>
            @if ($errors->has('username'))
                <span class="text-danger">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="Password" name="password" placeholder="Password" value="{{ old('username') }}">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="checkbox mt-3 mb-3">
            <label>
                <input type="checkbox" value="remember-me" name="remember"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
    </form>
@endsection
