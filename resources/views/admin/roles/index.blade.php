@extends('layout.app')
@section('content')

<div class="container p-4">
    <div class="text-center">
        <h3>Szerepkörök listája</h3>
    </div>

    <div class="container w-25 pt-5">
    <table class="table list" id="table-adminRole-list">
        <thead>
            <tr>
                <th width="20%" scope="col">#</th>
                <th width="20%" scope="col">ID</th>
                <th width="60%" scope="col">Szerepkör</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 0; ?>
            @foreach($roles as $role)
            <?php $i++; ?>
            <tr data-id="{{ $role->id }}">
                <th scope="row">{{ $i }}</th>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
    </div>

</div>

@endsection
