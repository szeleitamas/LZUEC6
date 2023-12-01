@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ URL::previous() }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>{{ $user->name }} adatainak szerkesztése</h3>
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

    <form action="{{ route('players.update', $user->id) }}" method="POST" class="editForm ms-auto me-auto mt-auto">
        <input type="hidden" name="user_id" id="user_id">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nameInput" class="form-label">Név </label>
            <input type="text" name="name" id="nameInput" class="form-control" value="{{ old('name', $user->name) }}" required minlength="2" maxlength="50">
            @if ($errors->has('name'))
            <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div>
            <input type="submit" class="btn btn-primary" value="Frissítés">
        </div>
    </form>
</div>

@endsection
