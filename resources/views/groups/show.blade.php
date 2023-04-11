@extends('layouts.default')

@section('content')
    <style>
        .profile-link {
            display: flex;
            flex-direction: row;
            align-items: center;
            text-decoration: none;
            color: #333;
            padding: 10px;
        }

        .profile-name {
            font-weight: bold;
            margin-right: 10px;
        }

        .profile-username {
            font-style: italic;
            color: #999;
        }

        .status-form {
            margin-top: 20px;
        }

        .status-form input,
        .status-form textarea {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .status-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .statuses {
            margin-top: 20px;
        }

        .status {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .status p {
            margin: 0;
            margin-bottom: 10px;
        }

        .status .meta {
            color: #999;
            font-size: 12px;
        }
    </style>
    <h1>{{ $group->name }}</h1>

    <h2>Участники: <i>{{ $group->users->count() }}</i> </h2>

    @if ($group->creator_id == auth()->id())
        <div class="status-form">
            <form action="{{ route('group_statuses.stores', $group) }}" method="POST">
                @csrf
                <textarea name="body" placeholder="Напишите что-то..." required></textarea>
                <button type="submit">Опубликовать</button>
            </form>
        </div>
    @endif

    <div class="statuses">
        <h2>Посты</h2>
        @if ($group->statuses->count() > 0)
            @foreach ($group->statuses as $status)
                <div class="status">
                    <p>{{ $status->body }}</p>
                </div>
            @endforeach
                <div class="d-flex justify-content-center">
                    {!! $statuses->links("pagination::bootstrap-4", ['always_show' => true, 'page' => $statuses->currentPage()]) !!}
                </div>
        @else
            <p>Нет статусов.</p>
        @endif
    </div>
@endsection
