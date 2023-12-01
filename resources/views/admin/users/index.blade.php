@extends('layout.app')
@section('content')

<p><a href="{{ URL::previous() }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>Játékosok listája</h3>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Név</th>
            <th scope="col">Csapat</th>
            <th scope="col">Állapot</th>
            <th scope="col">Művelet</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($users as $user)

        <tr>
            <th scope="row">{{ $user->name }}</th>
            <td>{{ $user->team->name }}</td>
            <td>
                <a href="{{ route('playerStatus.update', $user->id) }}" class="btn btn-sm btn-{{ $user->status ? 'success' : 'danger' }}">{{ $user->status ? 'Engedélyezés' : 'Tiltás' }}</a>
            </td>
            <td>
                <a href="" class="btn btn-primary">Szerkesztés</a>
                <a href="" class="btn btn-danger">Törlés</a>
            </td>
        </tr>

        @endforeach

    </tbody>
</table>

@endsection
