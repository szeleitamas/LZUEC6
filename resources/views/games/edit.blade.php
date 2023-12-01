@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ route('games.index') }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>{{ $game->homeTeam->name }} - {{ $game->awayTeam->name }} eredmény felvitele</h3>
    </div>

    <form action="{{ route('games.update', $game->id) }}" method="POST" class="auth ms-auto me-auto mt-auto">
        @csrf

        <div>
            <table class="table-list caption-top" id="table-gameSingleRecord1-list">
                <caption class="caption">Egyéni mérkőzés 1.</caption>

                <tbody>
                    <tr>
                        <td>{{ $game->homeTeam->name }}</td>
                        <td>
                            <select id="homeTeamPlayer1_id" name="homeTeamPlayer1_id" class="form-control" required>
                                <option value="">Válassz játékost</option>
                                @foreach ($game->homeTeam->users as $homeTeamPlayer1)
                                <option value="{{ $homeTeamPlayer1->id }}">{{ $homeTeamPlayer1->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="homePlayer1Point" name="homePlayer1Point" class="form-control" required>
                                <option value="">Elért pont</option>
                                @for($point=1; $point<=9; $point++) <option value="{{ $point }}">{{ $point }}</option>
                                    @endfor
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ $game->awayTeam->name }}</td>
                        <td>
                            <select id="awayTeamPlayer1_id" name="awayTeamPlayer1_id" class="form-control" required>
                                <option value="">Válassz játékost</option>
                                @foreach ($game->awayTeam->users as $awayTeamPlayer1)
                                <option value="{{ $awayTeamPlayer1->id }}">{{ $awayTeamPlayer1->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="awayPlayer1Point" name="awayPlayer1Point" class="form-control" required>
                                <option value="">Elért pont</option>
                                @for($point=1; $point<=9; $point++) <option value="{{ $point }}">{{ $point }}</option>
                                    @endfor
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table-list caption-top" id="table-gameSingleRecord2-list">
                <caption class="caption">Egyéni mérkőzés 2.</caption>

                <tbody>
                    <tr>
                        <td>{{ $game->homeTeam->name }}</td>
                        <td>
                            <select id="homeTeamPlayer2_id" name="homeTeamPlayer2_id" class="form-control" required>
                                <option value="">Válassz játékost</option>
                                @foreach ($game->homeTeam->users as $homeTeamPlayer2)
                                <option value="{{ $homeTeamPlayer2->id }}">{{ $homeTeamPlayer2->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="homePlayer2Point" name="homePlayer2Point" class="form-control" required>
                                <option value="">Elért pont</option>
                                @for($point=1; $point<=9; $point++) <option value="{{ $point }}">{{ $point }}</option>
                                    @endfor
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ $game->awayTeam->name }}</td>
                        <td>
                            <select id="awayTeamPlayer2_id" name="awayTeamPlayer2_id" class="form-control" required>
                                <option value="">Válassz játékost</option>
                                @foreach ($game->awayTeam->users as $awayTeamPlayer2)
                                <option value="{{ $awayTeamPlayer2->id }}">{{ $awayTeamPlayer2->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="awayPlayer2Point" name="awayPlayer2Point" class="form-control" required>
                                <option value="">Elért pont</option>
                                @for($point=1; $point<=9; $point++) <option value="{{ $point }}">{{ $point }}</option>
                                    @endfor
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>


            <table class="table-list caption-top" id="table-gamePairRecord-list">
                <caption class="caption">Páros mérkőzés</caption>

                <tbody>
                    <tr>
                        <td>{{ $game->homeTeam->name }}</td>
                        <td>
                            <select id="homeTeamPPlayer1_id" name="homeTeamPPlayer1_id" class="form-control" required>
                                <option value="">Válassz játékost</option>
                                @foreach ($game->homeTeam->users as $homeTeamPPlayer1)
                                <option value="{{ $homeTeamPPlayer1->id }}">{{ $homeTeamPPlayer1->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="homeTeamPPlayer2_id" name="homeTeamPPlayer2_id" class="form-control" required>
                                <option value="">Válassz játékost</option>
                                @foreach ($game->homeTeam->users as $homeTeamPPlayer2)
                                <option value="{{ $homeTeamPPlayer2->id }}">{{ $homeTeamPPlayer2->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="homePPlayerPoint" name="homePPlayerPoint" class="form-control" required>
                                <option value="">Elért pont</option>
                                @for($point=1; $point<=9; $point++) <option value="{{ $point }}">{{ $point }}</option>
                                    @endfor
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ $game->awayTeam->name }}</td>
                        <td>
                            <select id="awayTeamPPlayer1_id" name="awayTeamPPlayer1_id" class="form-control" required>
                                <option value="">Válassz játékost</option>
                                @foreach ($game->awayTeam->users as $awayTeamPPlayer1)
                                <option value="{{ $awayTeamPPlayer1->id }}">{{ $awayTeamPPlayer1->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="awayTeamPPlayer2_id" name="awayTeamPPlayer2_id" class="form-control" required>
                                <option value="">Válassz játékost</option>
                                @foreach ($game->awayTeam->users as $awayTeamPPlayer2)
                                <option value="{{ $awayTeamPPlayer2->id }}">{{ $awayTeamPPlayer2->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="awayPPlayerPoint" name="awayPPlayerPoint" class="form-control" required>
                                <option value="">Elért pont</option>
                                @for($point=1; $point<=9; $point++) <option value="{{ $point }}">{{ $point }}</option>
                                    @endfor
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <input type="submit" class="btn btn-primary btn-sm" value="Mentés">
        </div>
    </form>
</div>





@endsection
