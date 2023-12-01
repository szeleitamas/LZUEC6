@extends('layout.app')
@section('content')


<div class="container p-4">
    <div class="text-center">
        <h3>Csapatok sorsolása</h3>
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

    <div class="container w-50 pt-5">
        <table class="table caption-top table-hover" id="table-listLotsGroup-list">
            <caption class="caption">Sorsolás</caption>
            <thead>
                <tr>
                    <th width="10%" scope="col">Sorszám</th>
                    <th width="30%" scope="col">Osztály</th>
                    <th width="30%" scope="col">Műveletek</th>
                    <th width="30%" scope="col">Bajnokság indítása</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach ($groups as $group)
                <?php $i++; ?>
                <th scope="row">{{ $i }}</th>
                <td>{{ $group->name }}</td>
                <td>
                    @if ($group->teams->count() != 10)
                    <button class="btn btn-primary btn-sm" type="button" disabled>Sorsolás</button>
                    @else
                    <a href="{{ route('teamLot.action', $group->id) }}" class="btn btn-primary btn-sm">Sorsolás</a>
                    @endif
                </td>
                <td>
                    @if ($group->teams->count() != 10)
                    <button class="btn btn-primary btn-sm" type="button" disabled>Bajnokság indítása</button>
                    @else
                    <a href="{{ route('games.action', $group->id) }}" class="btn btn-primary btn-sm">Bajnokság indítása</a>
                    @endif
                </td>
            </tbody>
            @endforeach
        </table>


        <?php $id = 1; ?>
        @foreach ($groups as $group)
        <table class="table caption-top table-hover" id="table-listLotsTeam-list">
            <caption class="caption">{{ $group->name }}</caption>
            <thead>
                <tr>
                    <th width="20%" scope="col">Sorszám</th>
                    <th width="50%" scope="col">Csapatnév</th>
                    <th width="30%" scope="col">Sorsolás sorrendje</th>
                    <th width="30%" scope="col">Bajnokság indításának ideje</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach ($teams->where('group_id', $id) as $team)
                <?php $i++; ?>
                <th scope="row">{{ $i }}</th>
                <td>{{ $team->name }}</td>
                <td>{{ $team->lot }}</td>
                <td> {{ $team->start_date }} </td>
            </tbody>
            @endforeach
            <?php $id++; ?>
        </table>
        @endforeach
    </div>
</div>


@endsection
