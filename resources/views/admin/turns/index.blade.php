@extends('layout.app')
@section('content')

<div class="container p-4">
    <div class="text-center">
        <h3>Felvitt fordulók listája</h3>
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

    <div>
        <div id="button-turnsStore">
            <form action="{{ route('turns.store') }}" method="POST">
                @csrf
                <input class="btn btn-success float-end btn-sm" type="submit" value="Forduló generálása">
            </form>
        </div>
        <div id="button-turnsTruncate">
            <form action="{{ route('turns.truncate') }}" method="POST">
                @csrf
                <input class="btn btn-danger float-end btn-sm" type="submit" value="Forduló törlése">
            </form>
        </div>
    </div>

    <div class="container w-25 pt-5">
        <table class="table list" id="table-adminTurn-list">
            <thead>
                <tr>
                    <th width="30%" scope="col">#</th>
                    <th width="70%" scope="col">Forduló</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach($turns as $turn)
                <?php $i++; ?>
                <tr data-id="{{ $turn->id }}">
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $turn->name }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection
