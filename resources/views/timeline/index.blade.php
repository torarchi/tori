@extends('layouts.default')

@section('content')
    <style>
        textarea {
            resize: none;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center align-items-center pt-3">
            <div class="col-lg-8">
                <form role='form' action="{{ route('status.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2 {{ $errors->has('status') ? 'has-error' : '' }}">
                        <textarea maxlength="250" rows="4" cols="50" placeholder="Что нового?" name="status"
                                  class="form-control"></textarea>
                        @if($errors->has('status'))
                            <span class="text-danger">
                                {{ $errors->first('status') }}
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-dark">Опубликовать</button>
                </form>

                <hr>

                <div class="mt-4">
                    @if($statuses->count() == 0)
                        <p>Лента новостей пуста</p>
                    @else
                        @foreach($statuses as $status)
                            <div class="media mb-3 border-bottom border-gray">
                                <a class="me-3" href="{{ route('profile.index', ['username' => $status->user->username ]) }}">
                                    <img class="rounded-circle" src="{{ $status->user->getAvatarUrl() }}" alt="{{ $status->user->getNameOrUsername() }}" width="80" height="80">
                                </a>
                                <div class="media-body">
                                    <h4 class="mb-2"><a href="{{ route('profile.index', ['username' => $status->user->username ]) }}" class="text-decoration-none text-dark">{{ $status->user->getNameOrUsername() }}</a></h4>
                                    <ul class="list-inline mb-2">
                                        <li class="list-inline-item">{{ $status->created_at->diffForHumans() }}</li>
                                    </ul>
                                    <p class="mb-2" style="word-wrap: break-word;">{{ $status->body }}</p>
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
    </div>
@endsection
