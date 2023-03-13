<nav class="navbar navbar-expand" aria-label="navbar">
    <div class="container-fluid">
        <a class="navbar-brand me-5" href="{{ route('home') }}">Tori</a>
        <form class="d-flex" role="search" action="{{ route('search-results') }}">
            <div class="input-group">
                <span class="input-group-text border-0 bg-white">
                    <img src="https://cdn-icons-png.flaticon.com/512/3917/3917754.png" width="16" height="16" alt="Поиск">
                </span>
                <input class="border-0" type="text" name="query" placeholder="Поиск" aria-label="Поиск">
            </div>
        </form>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05"
                aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                           href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">{{ Auth::user()->getNameOrUsername() }}</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('friend.index') }}">Друзья</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('profile.edit') }}">Профиль</a>
                </li>
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('signout') }}">Выйти</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('signup') }}">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('signin') }}">Авторизация</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

