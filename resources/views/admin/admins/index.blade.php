@extends('layout.app')
@section('content')

<div class="container p-4">
    <div class="text-center">
        <h3>Admin adatai</h3>

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
        <table class="table list" id="table-adminAdmin-list">
            <thead>
                <tr>
                    <th width="10%" scope="col">#</th>
                    <th width="20%" scope="col">Név</th>
                    <th width="20%" scope="col">Email</th>
                    <th width="20%" scope="col">Telefonszám</th>
                    <th width="30%" scope="col">Műveletek</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach($admins as $admin)
                @foreach($admin->roles as $role)
                @if($role->id === 1)
                <?php $i++; ?>
                <th scope="row">{{ $i }}</th>
                <td>{{ $admin->name }}</td>
                @if ($admin->registrationdata)
                <td>{{ $admin->registrationdata->email }}</td>
                @else
                <td>-</td>
                @endif
                @if ($admin->phone)
                <td>{{ $admin->phone->phone }}</td>
                @else
                <td>-</td>
                @endif
                <td>
                    <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-primary btn-sm">Szerkesztés</a>
                    <a href="{{ route('password.change') }}" class="btn btn-info btn-sm">Jelszó módosítás</a>
                </td>

            </tbody>
            @endif
            @endforeach
            @endforeach

        </table>
    </div>
</div>

@endsection
