<nav class="py-3 bg-body-tertiary border-bottom navbar fixed-top">
    <div class="container d-flex flex-wrap">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>


        <ul class="nav me-auto">
            <li class="nav-item">
                <a class="nav-link link-body-emphasis px-2" aria-current="page" href="{{ route('homepage') }}">Bajnokság állása</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-body-emphasis px-2" aria-current="page" href="{{ route('gamesLots.index') }}">Sorsolás</a>
            </li>

            @auth
            <li class="nav-item">
                <a class="nav-link link-body-emphasis px-2 active" aria-current="page" href="{{ route('games.index') }}">Eredményrögzítés</a>
            </li>
            @endauth

            {{-- Admin és csapatkapitány szerepkörű felhasználó beléptetésének engedélyezése a csapatok nevű menüponthoz --}}
            @if (Auth::check())
            @if (Auth::user()->user->roles->sortBy('id')->firstOrFail()->id === 2)
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Csapatok
                </button>
                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis px-2" aria-current="page" href="{{ route('teams.index') }}">Csapatok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis px-2" aria-current="page" href="{{ route('teamCaptains.index') }}">Csapatkapitány</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis px-2" href="{{ route('players.index') }}">Játékosok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis px-2" aria-current="page" href="{{ route('dataRecorders.index') }}">Adatrögzítők</a>
                    </li>
                </ul>
            </div>
            @endif
            @endif

            {{-- Admin szerepkörű felhasználó beléptetésének engedélyezése a törzsadatok nevű menüponthoz --}}
            @if (Auth::check())
            @if (Auth::user()->user->roles->sortBy('id')->firstOrFail()->id === 1)
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Törzsadatok
                </button>
                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis px-2" href="{{ route('admins.index') }}">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis px-2" href="{{ route('roles.index') }}">Szerepkörök</a>
                    </li>
                    <li class="nav-item">
                        <hr class="dropdown-divider">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis px-2" href="{{ route('groups.index') }}">Osztályok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis px-2" href="{{ route('turns.index') }}">Fordulók</a>
                    </li>
                    <li class="nav-item">
                        <hr class="dropdown-divider">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis px-2" href="{{ route('tracks.index') }}">Pályák</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-body-emphasis px-2" href="{{ route('days.index') }}">Napok</a>
                    </li>
                </ul>
            </div>
            @endif
            @endif

            {{-- Admin szerepkörű felhasználó beléptetésének engedélyezése a listák nevű menüponthoz --}}
            @if (Auth::check())
            @if (Auth::user()->user->roles->sortBy('id')->firstOrFail()->id === 1)
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Listák
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link link-body-emphasis px-2" href="{{ route('teamList.index') }}">Csapatok</a>
                    </li>
                    <li>
                        <a class="nav-link link-body-emphasis px-2" href="{{ route('playerList.index') }}">Játékosok</a>
                    </li>
                    <li>
                        <a class="nav-link link-body-emphasis px-2" href="{{ route('teamLot.index') }}">Sorsolás</a>
                    </li>
                </ul>
            </div>
            @endif
            @endif

            {{-- Bejelentkezett felhasználó login-registration-logout engedélyezés és megtagadás  --}}
            @auth
            <li class="nav-item">
                <a class="nav-link link-body-emphasis px-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Kilépés</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link link-body-emphasis px-2" href="{{ route('login.create') }}">Bejelentkezés</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-body-emphasis px-2" href="{{ route('registration.create') }}">Regisztráció</a>
            </li>
            @endauth

        </ul>

        {{--Jobb oldal bejelentkezett név és szerepkör kiíratás--}}
        <span class="navbar-text">
            @auth
            {{ Auth::user()->user->name }} /
            {{ Auth::user()->user->roles->sortBy('id')->first()->name }}
            @endauth
        </span>

    </div>
</nav>
