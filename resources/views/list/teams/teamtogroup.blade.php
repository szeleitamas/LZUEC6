@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ route('teamList.index') }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>{{ $team->name }} - Csoporthoz rendelés</h3>
    </div>

    <form action="{{ route('teamToGroup.update', $team->id) }}" method="POST" class="editForm ms-auto me-auto mt-auto">
        @csrf

        <div class="mb-3">
            <label for="group_id" class="form-label">Osztály </label>
            <select name="group_id" id="group_id" class="form-control">
                <option value="0" disabled selected>Válassz osztályt</option>
                @foreach ($groups as $group)
                <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('group_id'))
            <div class="text-danger">{{ $errors->first('group_id') }}</div>
            @endif
        </div>

        <div>
            <input type="submit" class="btn btn-primary btn-sm" value="Mentés">
        </div>

    </form>
</div>
@endsection
