@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <h2 class="mb-4">Авторизация</h2>
                <form class="p-4 border border-2 border-primary rounded" style="max-width: 400px;" method="post" action="{{ route('signin') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="Password" name="password" placeholder="Password" value="{{ old('username') }}">
                        <label for="Password">Password</label>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="remember-me" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button class="w-100 btn btn-primary" type="submit">Sign in</button>
                </form>
            </div>
        </div>
    </div>


@endsection
