@extends('layout.app')
@section('content')

<div class="container p-4">
    <div class="text-center">
        <h3>Felvitt eredmények</h3>
    </div>

    <div class="mt-5">
        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <table class="table list table-hover" id="table-teamsPointRecord-list">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Csoport</th>
                <th scope="col">Forduló</th>
                <th scope="col">Hazai csapat</th>
                <th scope="col">Vendég csapat</th>
                <th scope="col">Hazai egyéni1 játékos</th>
                <th scope="col">Vendég egyéni1 játékos</th>
                <th scope="col">Hazai egyéni1 pont</th>
                <th scope="col">Vendég egyéni1 pont</th>
                <th scope="col">Hazai egyéni2 játékos</th>
                <th scope="col">Vendég egyéni2 játékos</th>
                <th scope="col">Hazai egyéni2 pont</th>
                <th scope="col">Vendég egyéni2 pont</th>
                <th scope="col">Hazai páros1 játékos</th>
                <th scope="col">Hazai páros2 játékos</th>
                <th scope="col">Vendég páros1 játékos</th>
                <th scope="col">Vendég páros2 játékos</th>
                <th scope="col">Hazai páros pont</th>
                <th scope="col">Vendég páros pont</th>
                <th scope="col">Műveletek</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 0; ?>
            @foreach($games as $game)
            <?php $i++; ?>
            <th scope="row">{{ $i }}</th>
            <td>{{ $game->group->name }}</td>
            <td>{{ $game->turn_id }}</td>
            @if ($game->homeTeam)
            <td>{{ $game->homeTeam->name }}</td>
            @else
            <td>-</td>
            @endif
            @if ($game->awayTeam)
            <td>{{ $game->awayTeam->name }}</td>
            @else
            <td>-</td>
            @endif
            @if ($game->homePlayer1_id)
            @foreach ($game->homeTeam->users->where('id', $game->homePlayer1_id) as $user)
            <td>{{ $user->name }}</td>
            @endforeach
            @else
            <td>-</td>
            @endif

            @if ($game->awayPlayer1_id)
            @foreach ($game->awayTeam->users->where('id', $game->awayPlayer1_id) as $user)
            <td>{{ $user->name }}</td>
            @endforeach
            @else
            <td>-</td>
            @endif

            @if ($game->homePlayer1Point)
            <td>{{ $game->homePlayer1Point }}</td>
            @else
            <td>-</td>
            @endif
            @if ($game->awayPlayer1Point)
            <td>{{ $game->awayPlayer1Point }}</td>
            @else
            <td>-</td>
            @endif

            @if ($game->homePlayer2_id)
            @foreach ($game->homeTeam->users->where('id', $game->homePlayer2_id) as $user)
            <td>{{ $user->name }}</td>
            @endforeach
            @else
            <td>-</td>
            @endif

            @if ($game->awayPlayer2_id)
            @foreach ($game->awayTeam->users->where('id', $game->awayPlayer2_id) as $user)
            <td>{{ $user->name }}</td>
            @endforeach
            @else
            <td>-</td>
            @endif

            @if ($game->homePlayer2Point)
            <td>{{ $game->homePlayer2Point }}</td>
            @else
            <td>-</td>
            @endif
            @if ($game->awayPlayer2Point)
            <td>{{ $game->awayPlayer2Point }}</td>
            @else
            <td>-</td>
            @endif

            @if ($game->homePPlayer1_id)
            @foreach ($game->homeTeam->users->where('id', $game->homePPlayer1_id) as $user)
            <td>{{ $user->name }}</td>
            @endforeach
            @else
            <td>-</td>
            @endif

            @if ($game->homePPlayer2_id)
            @foreach ($game->homeTeam->users->where('id', $game->homePPlayer2_id) as $user)
            <td>{{ $user->name }}</td>
            @endforeach
            @else
            <td>-</td>
            @endif

            @if ($game->awayPPlayer1_id)
            @foreach ($game->awayTeam->users->where('id', $game->awayPPlayer1_id) as $user)
            <td>{{ $user->name }}</td>
            @endforeach
            @else
            <td>-</td>
            @endif

            @if ($game->awayPPlayer2_id)
            @foreach ($game->awayTeam->users->where('id', $game->awayPPlayer2_id) as $user)
            <td>{{ $user->name }}</td>
            @endforeach
            @else
            <td>-</td>
            @endif

            @if ($game->homePPlayerPoint)
            <td>{{ $game->homePPlayerPoint }}</td>
            @else
            <td>-</td>
            @endif
            @if ($game->awayPPlayerPoint)
            <td>{{ $game->awayPPlayerPoint }}</td>
            @else
            <td>-</td>
            @endif


            <td>
                <a href="{{ route('games.edit', $game->id) }}" class="edit btn btn-primary btn-sm">Rögzítés</a>
            </td>


        </tbody>
        @endforeach
    </table>

</div>

@endsection
