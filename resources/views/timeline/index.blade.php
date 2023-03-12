@extends('layouts.default')

@section('content')
    <style>
        textarea {
            height: auto;
            resize: none;
        }

    </style>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6 pt-3">
                <form role='form' action="{{ route('status.post') }}" method="post">
                    <div class="form-group mb-2 {{ $errors->has('status') ? 'has-error' : " " }}">
                        <textarea placeholder="Что нового?" name="status" class="form-control" rows="2"></textarea>
                        @if($errors->has('status'))
                            <span class="help-block">
                            {{ $errors->first('status') }}
                        </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Опубликовать</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
                <hr>
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6">
                @if(!$statuses->count())
                    <p>Лента новостей пуста</p>
                @else
                    @foreach($statuses as $status)
                        <div class="media  d-flex mb-3 border border-gray ">
                            <div class="center d-flex justify-content-center align-items-center ">
                                <a class="pull-left"
                                   href="{{ route('profile.index', ['username' => $status->user->username ]) }}">
                                    <img class="media-object" src="{{ $status->user->getAvatarUrl() }}"
                                         alt="{{ $status->user->getNameOrUsername() }}"
                                         style="width: 100px; height: 100px; padding: 5px">
                                </a>
                            </div>

                            <div class="media-body ms-3">
                                <h4 class="media-heading"><a
                                        href="{{ route('profile.index', ['username' => $status->user->username ]) }}">{{ $status->user->getNameOrUsername() }}</a>
                                </h4>
                                <p>{{ $status->body }}</p>
                                <ul class="list-inline">
                                    <li>{{ $status->created_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    {!! $statuses->render() !!}
                @endif
            </div>
        </div>
    </div>
@endsection
