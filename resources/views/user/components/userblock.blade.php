<div class="media d-flex mb-3">
    <div class="center d-flex justify-content-center align-items-center">
        <a class="pull-left" href="{{ route('profile.index', ['username' => $user->username]) }}">
            <img class="media-object" alt="{{ $user->getNameOrUsername() }}" src="{{ $user->getAvatarUrl() }}" style="border-radius: 15px" width="100" height="100">
        </a>
        <div class="media-left ms-3">
            <h3 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username]) }}" style="text-decoration: none; color: black;">{{ $user->getNameOrUsername() }}</a></h3>
            @if($user->location)
                <p>{{ $user->location }}</p>
            @endif
        </div>
    </div>
</div>
