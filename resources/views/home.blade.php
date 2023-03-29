@extends('layouts.default')

@section('content')

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Tori</h1>
                <p class="lead text-muted">Социальная сеть</p>
            </div>
        </div>


        <div class="d-grid gap-5 d-sm-flex justify-content-sm-center">
            <a class="nav-link text-dark btn-lg px-4" href="{{ route('signup') }}">Регистрация</a>
            <a class="nav-link text-dark btn-lg px-4" href="{{ route('signin') }}">Авторизация</a>
        </div>

    </section>

@endsection
