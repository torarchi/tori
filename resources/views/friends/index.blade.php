@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4>Ваши друзья</h4>
            @if(!$friends->count())
                <p>У вас пока нет друзей</p>

            @else
                @foreach($friends as $user)
                    @include('user.components.userblock')
                @endforeach
            @endif
        </div>

        <div class="col-lg-6">
            <h5>Запросы в друзья</h5>

            @if(!$frequests->count())
                <p>У вас нет запросов в друзья</p>
            @else
                @foreach($frequests as $user)
                    @include('user.components.userblock')
                @endforeach
            @endif
        </div>
    </div>
@endsection
