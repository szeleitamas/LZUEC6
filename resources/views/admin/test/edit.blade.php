@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ route('test.index') }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>{{ $game->homeTeam->name }} - {{ $game->awayTeam->name }} eredmény felvitele</h3>
    </div>

    <form action="{{ route('test.update', $game->id) }}" method="POST" class="auth ms-auto me-auto mt-auto">
        @csrf

        <table class="table-list caption-top">
            <caption>Egyéni mérkőzés 1.</caption>

            <tbody>
                <tr>
                <td>{{ $game->homeTeam->name }}</td>
                <td>
                    <select id="homeTeamPlayer1_id" name="homeTeamPlayer1_id" class="form-control">
                        <option value="">Válassz játékost</option>
                        @foreach ($game->homeTeam->users as $homeTeamPlayer1)
                        <option value="{{ $homeTeamPlayer1->id }}">{{ $homeTeamPlayer1->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                <select id="homePlayer1Point" name="homePlayer1Point" class="form-control">
                        <option value="">Elért pont</option>
                        @for($point=1; $point<=9; $point++)
                        <option value="{{ $point }}">{{ $point }}</option>
                        @endfor
                    </select>
                </td>
                </tr>

                <tr>
                <td>{{ $game->awayTeam->name }}</td>
                <td>
                    <select id="awayTeamPlayer1_id" name="awayTeamPlayer1_id" class="form-control">
                        <option value="">Válassz játékost</option>
                        @foreach ($game->awayTeam->users as $awayTeamPlayer1)
                        <option value="{{ $awayTeamPlayer1->id }}">{{ $awayTeamPlayer1->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                <select id="awayPlayer1Point" name="awayPlayer1Point" class="form-control">
                        <option value="">Elért pont</option>
                        @for($point=1; $point<=9; $point++)
                        <option value="{{ $point }}">{{ $point }}</option>
                        @endfor
                    </select>
                </td>
                </tr>
            </tbody>
        </table>

        <table class="table-list caption-top">
            <caption>Egyéni mérkőzés 2.</caption>

            <tbody>
                <tr>
                <td>{{ $game->homeTeam->name }}</td>
                <td>
                    <select id="homeTeamPlayer2_id" name="homeTeamPlayer2_id" class="form-control">
                        <option value="">Válassz játékost</option>
                        @foreach ($game->homeTeam->users as $homeTeamPlayer2)
                        <option value="{{ $homeTeamPlayer2->id }}">{{ $homeTeamPlayer2->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                <select id="homePlayer2Point" name="homePlayer2Point" class="form-control">
                        <option value="">Elért pont</option>
                        @for($point=1; $point<=9; $point++)
                        <option value="{{ $point }}">{{ $point }}</option>
                        @endfor
                    </select>
                </td>
                </tr>

                <tr>
                <td>{{ $game->awayTeam->name }}</td>
                <td>
                    <select id="awayTeamPlayer2_id" name="awayTeamPlayer2_id" class="form-control">
                        <option value="">Válassz játékost</option>
                        @foreach ($game->awayTeam->users as $awayTeamPlayer2)
                        <option value="{{ $awayTeamPlayer2->id }}">{{ $awayTeamPlayer2->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                <select id="awayPlayer2Point" name="awayPlayer2Point" class="form-control">
                        <option value="">Elért pont</option>
                        @for($point=1; $point<=9; $point++)
                        <option value="{{ $point }}">{{ $point }}</option>
                        @endfor
                    </select>
                </td>
                </tr>
            </tbody>
        </table>

        <div>
            <input type="submit" class="btn btn-primary" value="Mentés">
        </div>
    </form>
</div>





@endsection
