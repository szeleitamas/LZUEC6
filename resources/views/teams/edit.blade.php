@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ route('teams.index') }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>{{ $team->name }} csapat adatainak szerkesztése</h3>
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

    <form action="{{ route('teams.update', $team->id) }}" method="POST" class="editForm ms-auto me-auto mt-auto">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nameInput" class="form-label">Csapatnév </label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $team->name) }}" required minlength="2" maxlength="50">
            @if ($errors->has('name'))
            <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="trackInput" class="form-label">Pálya </label>
            <select name="track_id" id="trackInput" class="form-control" required>
                @foreach ($tracks as $track)
                <option value="{{ $track->id }}" {{ old('track_id', $team->track->id) == $track->id ? 'selected' : '' }}>{{ $track->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="dayInput" class="form-label">Játéknap </label>
            <select name="day_id" id="dayInput" class="form-control" required>
                @foreach ($days as $day)
                <option value="{{ $day->id }}" {{ old('day_id', $team->day->id) == $day->id ? 'selected' : '' }}>{{ $day->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <input type="submit" class="btn btn-primary btn-sm" value="Frissítés">
        </div>
    </form>
</div>

@endsection
