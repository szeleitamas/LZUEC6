@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ route('teams.index') }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>Csapatkapitány adatai</h3>

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

    </div>
    <div class="container w-75 pt-5">
        <table class="table list" id="table-teamCaptainEdit-list">
            <thead>
                <tr>
                    <th width="20%" scope="col">Név</th>
                    <th width="20%" scope="col">Email</th>
                    <th width="20%" scope="col">Telefonszám</th>
                    <th width="40%" scope="col">Műveletek</th>
                </tr>
            </thead>

            <tbody>
                <td>{{ $teamCaptain->name }}</td>
                @if ($teamCaptain->registrationdata)
                <td>{{ $teamCaptain->registrationdata->email }}</td>
                @endif
                @if ($teamCaptain->phone)
                <td>{{ $teamCaptain->phone->phone }}</td>
                @endif
                </td>
                <td>
                    <div class="actionMenu">
                        <a href="{{ route('teamCaptains.edit', $teamCaptain->id) }}" class="btn btn-success btn-sm">Szerkesztés</a>
                        <form action="{{ route('teamCaptains.addPlayer', $teamCaptain->id) }}" method="POST">
                            @csrf
                            <input class="btn btn-primary btn-sm" type="submit" value="Játékos kinevezés">
                        </form>
                        <a href="{{ route('password.change') }}" class="btn btn-info btn-sm">Jelszó módosítás</a>
                    </div>
                </td>
            </tbody>
        </table>
    </div>
</div>

@endsection
