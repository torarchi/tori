@extends('layouts.default')

@section('content')

    <style>
        .btn-green {
            background-color: green;
            color: white;
        }

        .btn-delete {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
        }

    </style>

    <div class="row">
        <div class="col-lg-5 mt-3">
            @include('user.components.userblock')
            <hr>

            @if(!$statuses->count())
                <p>{{ $user->getFirstNameOrUsername() }} еще ничего не опубликовал</p>
            @else
                @foreach($statuses as $status)
                    <div class="media d-flex mb-3 border-bottom border-gray">
                        <div class="center d-flex justify-content-center align-items-top">
                            <a class="pull-left"
                               href="{{ route('profile.index', ['username' => $status->user->username ]) }}">
                                <img class="media-object" src="{{ $status->user->getAvatarUrl() }}"
                                     alt="{{ $status->user->getNameOrUsername() }}"
                                     style="width: 100px; height: 100px; padding: 5px">
                            </a>
                        </div>
                        <div class="media-body media-left ms-3">
                            <h4 class="media-heading">
                                <a href="{{ route('profile.index', ['username' => $status->user->username ]) }}"
                                   style="text-decoration: none; color: black;">
                                    {{ $status->user->getNameOrUsername() }}
                                </a>
                            </h4>

                            <p>{{ $status->body }}</p>
                            <ul class="list-inline">
                                <li>{{ $status->created_at->diffForHumans() }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        <div class="col-lg-4">
            @if(Auth::user()->hasFriendRequestPending($user))
                <p>{{ $user->getNameOrUsername() }} ещё не принял ваш запрос в друзья</p>
            @elseif(Auth::user()->hasFriendRequestReceived($user))
                <a href="{{ route('friend.accept', ['username' => $user->username]) }}"
                   class="btn btn-submit btn-green">Принять запрос</a>

            @elseif(Auth::user()->isFriendWith($user))
                <p>Вы с {{ $user->getNameOrUsername() }} друзья</p>
                <form action="{{ route('friend.delete', ['username' => $user->username]) }}" method="post">
                    <input type="submit" value="Удалить из друзей" class="btn btn-delete">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            @elseif(Auth::user()->id !== $user->id)
                <a href="{{ route('friend.add', ['username' => $user->username]) }}" class="btn btn-primary">Добавить в
                    друзья</a>
            @endif

            <h5>Друзья {{ $user->getFirstNameOrUsername() }}</h5>

            @foreach($user->friends() as $user)
                @include('user.components.userblock')
            @endforeach
        </div>
    </div>
@endsection
