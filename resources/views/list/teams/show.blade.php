@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ route('teamList.index') }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>{{ $team->name }} csapat adatai</h3>
    </div>

    <div class="container w-75 pt-5">
        <table class="table caption-top table-hover" id="table-listTeamTeamCaptain-list">
            <caption class="caption">Csapatkapitány</caption>
            <thead>
                <tr>
                    <th width="10%" scope="col">Sorszám</th>
                    <th width="30%" scope="col">Név</th>
                    <th width="30%" scope="col">E-mail cím</th>
                    <th width="30%" scope="col">Telefonszám</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 0 ?>
                @foreach ($users as $user)
                @foreach ($user->roles as $role)
                <?php $i++ ?>
                @if ($role->id === 2)
                <th scope="row">{{ $i }}</th>
                <td>{{ $user->name }}</td>
                @if ($user->registrationdata)
                <td>{{ $user->registrationdata->email }}</td>
                @else
                <td>-</td>
                @endif
                @if ($user->phone)
                <td>{{ $user->phone->phone }}</td>
                @else
                <td>-</td>
                @endif

            </tbody>

            @endif
            @endforeach
            @endforeach
        </table>


        <table class="table caption-top table-hover" id="table-listTeamTeamCaptain-list">
            <caption class="caption">Játékosok listája</caption>
            <thead>
                <tr>
                    <th width="10%" scope="col">Sorszám</th>
                    <th width="30%" scope="col">Név</th>
                    <th width="60%" scope="col">Szerepkör</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = -1 ?>
                @foreach ($users as $user)
                @foreach ($user->roles as $role)
                <?php $i++ ?>
                @if ($role->id === 4)
                <th scope="row">{{ $i }}</th>
                <td>{{ $user->name }}</td>
                @if ($user->roles)
                <td>{{ $user->roles->sortBy('id')->first()->name }}</td>
                @else
                <td>-</td>
                @endif
            </tbody>

            @endif
            @endforeach
            @endforeach
        </table>
    </div>
</div>

@endsection
