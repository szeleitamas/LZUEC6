@extends('layout.app')
@section('content')

<a href="{{ route('test.action') }}" class="btn btn-primary">Művelet</a>

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

    <table class="table list" id="list-games-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Csoport</th>
                <th scope="col">Forduló</th>
                <th scope="col">Hazai csapat</th>
                <th scope="col">Vendég csapat</th>
                <th scope="col">Hazai játékos</th>
                <th scope="col">Vendég játékos</th>
                <th scope="col">Hazai egyéni1 pont</th>
                <th scope="col">Vendég egyéni1 pont</th>
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
            <td>{{ $game->homeTeam->name }}</td>
            <td>{{ $game->awayTeam->name }}</td>
            @if ($game->homePlayer1_id)
            <td>{{ $game->homePlayer1_id }}</td>
            @else
            <td>-</td>
            @endif
            @if ($game->awayPlayer1_id)
            <td>{{ $game->awayPlayer1_id }}</td>
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
            <td>
                <a href="{{ route('test.edit', $game->id) }}" class="edit btn btn-primary btn-sm">Szerkesztés</a>
            </td>


        </tbody>
        @endforeach
    </table>

</div>

@endsection
