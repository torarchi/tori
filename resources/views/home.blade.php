@extends('layouts.default')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="margin-top: 5%;">
        <section class="py-5 text-center">
            <div class="container">
                <div class="row py-lg-5">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="fw-light">Tori</h1>
                        <p class="lead text-muted">Социальная сеть</p>
                    </div>
                </div>

                <div class="d-grid gap-3 gap-sm-5 d-sm-flex justify-content-sm-center">
                    <a class="btn btn-dark btn-lg px-3 py-2" href="{{ route('signup') }}">Регистрация</a>
                    <a class="btn btn-outline-dark btn-lg px-3 py-2 ms-0 ms-sm-3" href="{{ route('signin') }}">Авторизация</a>
                </div>
            </div>
        </section>
    </div>


@endsection
