@extends('layouts.default')

@section('content')
    <style>
        textarea {
            resize: none;
        }

    </style>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-8 pt-3">
                <form role='form' action="{{ route('status.post') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-2 {{ $errors->has('status') ? 'has-error' : " " }}">
                        <textarea maxlength="250" rows="4" cols="50" placeholder="Что нового?" name="status" class="form-control" rows="2"></textarea>
                        @if($errors->has('status'))
                            <span class="help-block">
                                {{ $errors->first('status') }}
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-dark">Опубликовать</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>

                <hr>
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-8">
                @if(!$statuses->count())
                    <p>Лента новостей пуста</p>
                @else
                    @foreach($statuses as $status)
                        <div class="media d-flex mb-3 border-bottom border-gray ">
                            <div class="center d-flex justify-content-center align-items-top ">
                                <a class="pull-left"
                                   href="{{ route('profile.index', ['username' => $status->user->username ]) }}" >
                                    <img class="media-object" src="{{ $status->user->getAvatarUrl() }}"
                                         alt="{{ $status->user->getNameOrUsername() }}"
                                         style="width: 80px; height: 80px; padding: 5px; border-radius: 50px">
                                </a>
                            </div>

                            <div class="media-body ms-3 ">
                                <h4 class="media-heading"><a
                                        href="{{ route('profile.index', ['username' => $status->user->username ]) }}" style="text-decoration: none; color: black;" >{{ $status->user->getNameOrUsername() }}</a>
                                </h4>
                                <ul class="list-inline">
                                    <li>{{ $status->created_at->diffForHumans() }}</li>
                                </ul>
                                <p>{{ $status->body }}</p>

                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center mt-4">
                        {!! $statuses->render("pagination::bootstrap-4", ['always_show' => true, 'page' => $statuses->currentPage()]) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection
