<script src="{{ asset('https://code.jquery.com/jquery-3.5.1.slim.min.js') }}"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-lXmTuA9HLenlCBi8W37aCy6RymU6KZKhDpiC8HgUE00ofOg3ONVTpqk5ckH8kYfJ"
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('.navbar-toggler').click(function () {
            $('.navbar-collapse').toggleClass('show');
        });
    });
</script>

<nav class="navbar navbar-expand-lg navbar-light" aria-label="navbar">
    <div class="container-fluid">
        @if(Auth::check())
            <h3><a class="navbar-brand me-5" href="{{ route('home') }}">Tori</a></h3>
        @endif

        <button class="navbar-toggler{{ Auth::check() ? '' : ' d-none' }}" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05"
                aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center"
                style="padding-right: 10px;">
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                           href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">{{ Auth::user()->getNameOrUsername() }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Новости</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('groups.index') }}">Группы</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('friend.index') }}">Друзья</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('profile.edit') }}">Аккаунт</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('signout') }}">Выйти</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


