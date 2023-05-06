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

        .status2 {
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
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

        img {
            max-width: 100%;
            height: auto;
        }

        .image-container {
            max-width: 250px;
        }

    </style>

    <h1 style="color: dodgerblue">{{ $group->name }}</h1>
    <div class="group-content">
        <div class="image-container">
            <img src="{{ $group->image }}" alt="group image" style="border-radius: 25px">
        </div>
        <h5>Участники: <i style="color: indigo">{{ $group->users->count() }}</i></h5>
        @if ($group->creator_id == auth()->id())
            <div class="status-form">
                <form action="{{ route('group_statuses.stores', $group) }}" method="POST">
                    @csrf
                    <textarea name="body" placeholder="Напишите что-то..." required style="resize: none"></textarea>
                    <button type="submit">Опубликовать</button>
                </form>
            </div>
        @endif
    </div>


    <div class="statuses">
        <h2>Посты</h2>
        @if ($statuses->count() > 0)
            @foreach ($statuses as $status)
                <div class="container status">
                    <div class="status2 d-flex">
                        <div class="first">
                            <p class="mb-2" style="word-wrap: break-word;">{{ $status->body }}</p>
                        </div>
                    </div>
                    <div class="second d-flex justify-content-end align-items-center">
                        <ul style="color: dodgerblue">
                            <li>{{ $status->created_at->diffForHumans() }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {{ $statuses->links("pagination::bootstrap-4") }}
            </div>
        @else
            <p>Нет постов.</p>
        @endif

    </div>
@endsection
