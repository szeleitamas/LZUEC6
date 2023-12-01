@extends('layout.app')
@section('content')


<div class="container p-4">
    <div class="text-center">
        <h3>Játékosok listája</h3>
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

    <div class="container w-75 pt-5">
        <table class="table table-hover caption-top" id="table-listPlayer-list">
            <caption class="caption">Játékosok adatai</caption>
            <thead>
                <tr>
                    <th width="10%" scope="col">Sorszám</th>
                    <th width="30%" scope="col">Név</th>
                    <th width="30%" scope="col">Csapatév</th>
                    <th width="10%" scope="col">Állapot</th>
                    <th width="20%" scope="col">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach ($users as $user)
                @foreach ($user->roles as $role)
                @if ($role->id === 4)
                <?php $i++; ?>
                <th scope="row">{{ $i }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->team->name }}</td>
                <td>
                    <a href="{{ route('playerStatus.update', $user->id) }}" class="btn btn-sm btn-{{ $user->status ? 'success' : 'danger' }}">
                        {{ $user->status ? 'Engedélyezés' : 'Tiltás' }}
                    </a>
                </td>
                <td>
                    <div class="actionMenu">
                        <a href="{{ route('players.edit', $user->id) }}" class="btn btn-primary btn-sm">Szerkesztés</a>
                    </div>
                </td>
            </tbody>
            @endif
            @endforeach
            @endforeach

        </table>
    </div>
</div>

@endsection
