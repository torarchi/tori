@extends('layouts.default')

@section('content')
    <h3>Ваш результат "{{ Request::input('query') }}"</h3>

    @if (!$users->count())
        <h2>Нет результатов</h2>
    @else
    <div class="row">
        <div class="col-lg-12">

            @foreach($users as $user)
                @include('user.components.userblock')
            @endforeach

        </div>
    </div>
    @endif
@endsection
