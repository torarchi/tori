@extends('layouts.default')

@section('content')
    <h3>Ваш результат "{{ Request::input('query') }}"</h3>

    @if (!$users->count() && !$groups->count())
        <h2>Нет результатов</h2>
    @else
        @if ($users->count())
            <h4>Пользователи:</h4>
            <div class="row">
                <div class="col-lg-12">
                    @foreach($users as $user)
                        @include('user.components.userblock')
                    @endforeach
                </div>
            </div>
        @endif

        @if ($groups->count())
            <h4>Группы:</h4>
            <div class="row">
                <div class="col-lg-12">
                    @foreach($groups as $group)
                        @include('user.components.groupblock')
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection
