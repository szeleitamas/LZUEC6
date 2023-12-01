@extends('layout.app')
@section('content')

<div class="container p-4">
    <div class="text-center">
        <h3>{{ date('Y') }}. évi bajnokság eredménye</h3>
    </div>
</div>

<div class="container w-50 pt-5">
    @foreach ($groups as $group)
    <table class="table caption-top" id="table-teamsSumPoint-list">
        <caption class="caption">{{ $group->name }}</caption>
        <thead>
            <tr>
                <th width="20%" scope="col">#</th>
                <th width="60%" scope="col">Csapatok</th>
                <th width="20%" scope="col">Elért pont</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($teams->where('group_id', $group->id) as $team)
            <?php $i++; ?>
            <th scope="row">{{ $i }}</th>
            <td>{{ $team->name }}</td>
            <td>{{ $team->points }}</td>
        </tbody>
        @endforeach
    </table>
    @endforeach
</div>

@endsection
