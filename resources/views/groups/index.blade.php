@extends('layouts.default')

@section('content')
    <style>

        img {
            max-width: 100%;
            height: auto;
        }
        /* Set a max-width for the container to control the image size */
        .image-container {
            max-width: 50px;
        }

    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card" style="border: none;">
                    <div class="card-header" style="background: transparent"><h4>Группы</h4></div>

                    <div class="card-body" >
                        <a href="{{ route('groups.create') }}" class="btn btn-primary mb-3">Создать группу</a>
                        <ul class="list-group">
                            @foreach ($groups as $group)
                                <li class="list-group-item d-flex justify-content-between align-items-center"  >
                                    <div class="image-container">
                                        <img src="{{ $group->image }}" alt="group image">
                                    </div>
                                    <a href="{{ route('groups.show', $group) }}">{{ $group->name }}</a>
                                    @if ($group->creator_id == Auth::user()->id)
                                        <form action="{{ route('groups.destroy', $group) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Удалить группу</button>
                                        </form>
                                    @elseif (optional($group->members)->contains(Auth::user()))
                                        {{-- Show leave group button --}}
                                        <form action="{{ route('groups.leave', $group) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Выйти</button>
                                        </form>
                                    @else
                                        <form action="{{ route('groups.join', $group) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Присоединиться</button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="d-flex justify-content-center mt-4">
                    {!! $groups->render("pagination::bootstrap-4", ['always_show' => true, 'page' => $groups->currentPage()]) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
