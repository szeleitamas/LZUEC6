@extends('layout.app')
@section('content')

<div class="container p-4">
    <div class="text-center">
        <h3>Sorsolás</h3>
    </div>

    <div class="container w-75 pt-5">
        @foreach ($groups as $group)
        <div class=" lots-group-table">
            <h3>{{ $group->name }}</h3>

            @foreach ($turns as $turn)

            <table class="table caption-top" id="table-lot-list">
                <caption class="caption">{{ $turn->name }}</caption>
                <thead>
                    <tr>
                        <th width="5%" scope="col">#</th>
                        <th width="15%" scope="col">Osztály</th>
                        <th width="20%" scope="col">Hazai csapat</th>
                        <th width="20%" scope="col">Vendég csapat</th>
                        <th width="15%" scope="col">Pálya</th>
                        <th width="15%" scope="col">Játéknap</th>
                        <th width="10%" scope="col">Időpont</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 0; ?>
                    @foreach($games->where('turn_id', $turn->id)->where('group_id', $group->id) as $game)
                    <?php $i++; ?>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $game->group->name }}</td>
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

                    @if ($game->homeTeam)
                    @if ($game->homeTeam->track)
                    <td>{{ $game->homeTeam->track->name }}</td>
                    @else
                    <td>-</td>
                    @endif
                    @endif
                    @if ($game->homeTeam)
                    @if ($game->homeTeam->day)
                    <td>{{ $game->homeTeam->day->name }}</td>
                    @else
                    <td>-</td>
                    @endif
                    @endif
                    <td>16.00</td>
                </tbody>
                @endforeach
            </table>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@endsection
