<div class="media d-flex mb-3">
    <div class="center d-flex justify-content-center align-items-center">
        <a class="pull-left" href="{{ route('groups.show', ['group' => $group->name]) }}">
            <img src="{{ $group->image }}" alt="group image" style="border-radius: 25px" width="100" height="100">
        </a>
        <div class="media-left ms-3">
            <h3 class="media-heading"><a href="{{ route('groups.show', ['group' => $group->id]) }}" style="text-decoration: none;">{{ $group->name }}</a></h3>
            <h5>Участники: <i style="color: indigo">{{ $group->users->count() }}</i></h5>
        </div>
    </div>
</div>
