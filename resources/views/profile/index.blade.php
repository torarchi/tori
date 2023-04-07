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
            </div>
            <hr>
            <div class="row">
                <div class="friendswith d-flex align-items-end">
                    @if(Auth::user()->hasFriendRequestPending($user))
                        <p>{{ $user->getNameOrUsername() }} ещё не принял ваш запрос в друзья</p>
                    @elseif(Auth::user()->hasFriendRequestReceived($user))
                        <a href="{{ route('friend.accept', ['username' => $user->username]) }}"
                           class="btn btn-submit btn-green">Принять запрос</a>

                    @elseif(Auth::user()->isFriendWith($user))
                        <div class="container1">
                            <div class="row">
                                <form action="{{ route('friend.delete', ['username' => $user->username]) }}"
                                      method="post">
                                    <input type="submit" value="Удалить из друзей" class="btn btn-delete">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </div>
                        </div>

                    @elseif(Auth::user()->id !== $user->id)
                        <div class="container1 mb-2">
                            <a href="{{ route('friend.add', ['username' => $user->username]) }}"
                               class="btn btn-primary">Добавить в
                                друзья</a>
                        </div>

                    @endif

                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-md-4 d-flex ">
                        <h5 class="mb-3">Друзья</h5>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex justify-content-start mb-4">
                            <div class="item-container">
                                <span
                                    class=" fw-bold fs-5 fs-md-4 fs-lg-3 text-start">{{ number_format($user->friends()->count()) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <h5 class="mb-3">Посты</h5>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex justify-content-start mb-4">
                            <div class="item-container">
                                <span
                                    class="fw-bold fs-5 fs-md-4 fs-lg-3 text-start">{{ $totalStatusesCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->id == $user->id)
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <h5>Поиск</h5>
                        </div>
                        <div class="col-md-6 col-lg-12">
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
            @else
                <div class="row mt-2" style="display: none;">
                    <div class="col-lg-4">
                        <h5>Поиск</h5>
                    </div>
                    <div class="col-md-6col-lg-12">
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
        @endif


        <div class="col-lg-8 mt-3">
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
                            <ul class="list-inline">
                                <li>{{ $status->created_at->diffForHumans() }}</li>
                            </ul>
                            <p>{{ $status->body }}</p>

                            @auth
                                @if (auth()->user()->id === $user->id)
                                    <form action="{{ route('status.remove', ['id' => $status->id ]) }}"
                                          METHOD="post">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-outline-dark rounded-circle lh-1">X</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    {!! $statuses->render("pagination::bootstrap-4", ['always_show' => true, 'page' => $statuses->currentPage()]) !!}
                </div>
            @endif
        </div>
        @endsection
    </div>

