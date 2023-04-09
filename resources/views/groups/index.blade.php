@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Groups</div>

                    <div class="card-body">
                        <a href="{{ route('groups.create') }}" class="btn btn-primary mb-3">Create Group</a>
                        <ul class="list-group">
                            @foreach ($groups as $group)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('groups.show', $group) }}">{{ $group->name }}</a>
                                    @if ($group->user_id == Auth::user()->id)
                                        <form action="{{ route('groups.destroy', $group) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    @elseif (optional($group->members)->contains(Auth::user()))
                                        {{-- Show leave group button --}}
                                        <form action="{{ route('groups.leave', $group) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Leave Group</button>
                                        </form>
                                    @else
                                        <form action="{{ route('groups.join', $group) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Join</button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
