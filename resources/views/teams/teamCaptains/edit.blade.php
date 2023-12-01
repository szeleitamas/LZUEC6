@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ route('teamCaptains.index') }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>{{ $teamCaptain->name }} adatainak szerkesztése</h3>
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

    <form action="{{ route('teamCaptains.update', $teamCaptain->id) }}" method="POST" class="auth ms-auto me-auto mt-auto">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nameInput" class="form-label">Név </label>
            <input type="text" name="name" id="nameInput" class="form-control" value="{{ old('name', $teamCaptain->name) }}" required minlength="2" maxlength="50">
            @if ($errors->has('name'))
            <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="emailInput" class="form-label">Email </label>
            <input type="email" name="email" id="emailInput" class="form-control" value="{{ old('email', $teamCaptain->registrationdata->email) }}" required maxlength="50">
            @if ($errors->has('email'))
            <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="phoneInput" class="form-label">Telefonszám </label>
            <input type="text" name="phone" id="phoneInput" class="form-control" aria-describedby="phoneHelp" value="{{ old('phone', $teamCaptain->phone->phone) }}" required maxlength="12">
            <div id="phoneHelp" class="form-text">Csak számokat használjon a +36-os előválasztóval együtt!
                A megadott formátum pl: +36201112222</div>
            @if ($errors->has('phone'))
            <div class="text-danger">{{ $errors->first('phone') }}</div>
            @endif
        </div>

        <div>
            <input type="submit" class="btn btn-primary btn-sm" value="Frissítés">
        </div>
    </form>
</div>

@endsection
