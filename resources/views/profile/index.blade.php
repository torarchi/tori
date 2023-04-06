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
    <div class="container">
        <div class="row">
            <div class="media d-flex justify-content-between mb-3">
                <div class="center d-flex justify-content-center align-items-center">
                    <a class="pull-left" href="{{ route('profile.index', ['username' => $user->username]) }}">
                        <img class="media-object" alt="{{ $user->getNameOrUsername() }}"
                             src="{{ $user->getAvatarUrl() }}" width="100" height="100">
                    </a>
                    <div class="media-left ms-3">
                        <h3 class="media-heading"><a
                                href="{{ route('profile.index', ['username' => $user->username]) }}"
                                style="text-decoration: none; color: black;">{{ $user->getNameOrUsername() }}</a></h3>
                        @if($user->location)
                            <p>{{ $user->location }}</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="friendswith d-flex align-items-end">
                        @if(Auth::user()->hasFriendRequestPending($user))
                            <p>{{ $user->getNameOrUsername() }} ещё не принял ваш запрос в друзья</p>
                        @elseif(Auth::user()->hasFriendRequestReceived($user))
                            <a href="{{ route('friend.accept', ['username' => $user->username]) }}"
                               class="btn btn-submit btn-green">Принять запрос</a>

                        @elseif(Auth::user()->isFriendWith($user))
                            <div class="container">
                                <div class="row">
                                    <p>Вы с {{ $user->getNameOrUsername() }} друзья</p>
                                </div>
                                <div class="row">
                                    <form action="{{ route('friend.delete', ['username' => $user->username]) }}"
                                          method="post">
                                        <input type="submit" value="Удалить из друзей" class="btn btn-delete">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </div>
                            </div>

                        @elseif(Auth::user()->id !== $user->id)
                            <a href="{{ route('friend.add', ['username' => $user->username]) }}"
                               class="btn btn-primary">Добавить в
                                друзья</a>
                        @endif

                    </div>
                </div>
            </div>
            <hr>

            <div class="col-lg-7 mt-3">

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
                                         style="width: 75px; height: 75px; padding: 5px; border-radius: 40px">
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
                                @auth
                                    @if (auth()->user()->id === $user->id)
                                        <form action="{{ route('status.remove', ['id' => $status->id ]) }}"
                                              METHOD="post">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="col-lg-5">
                <div class="row">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Друзья</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 d-flex">
                            <div class="item-container">
                                <div class="d-flex justify-content-center">
                                    <span
                                        class="badge rounded-pill bg-primary fw-bold fs-5 fs-md-4 fs-lg-3">{{ number_format($user->friends()->count()) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6">
                        <h5>Посты</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 d-flex">
                        <div class="d-flex justify-content-center">
                            <span
                                class="badge rounded-pill bg-primary fw-bold fs-5 fs-md-4 fs-lg-3">{{ number_format($statuses->count()) }}</span>
                        </div>
                    </div>
                </div>


                <div class="row mt-5">
                    <h5>Поиск</h5>
                    <div class="col-lg-6">
                        <form class="d-flex justify-content-center align-items-center mx-auto" role="search"
                              action="{{ route('search-results') }}">
                            <div class="input-group">
                                <label class="visually-hidden" for="search">Search:</label>
                                <input class="form-control rounded" id="search" type="text" name="query"
                                       placeholder="..." aria-label="Search">
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
        @endsection
    </div>


