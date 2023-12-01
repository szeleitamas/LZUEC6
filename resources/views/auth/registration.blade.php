@extends('layout.app')

@section('title', 'Regisztráció')
@section('content')


<div class="container p-4">
    <div class="text-center">
        <h3>Regisztráció</h3>
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

    <form action="{{ route('registration.store') }}" method="POST" class="auth ms-auto me-auto mt-auto">
        @csrf

        <div class="mb-3">
            <label for="nameInput" class="form-label">Név <sup>*</sup></label>
            <input type="text" name="name" id="nameInput" class="form-control" value="{{ old('name') }}" required minlength="2" maxlength="50">
            @if ($errors->has('name'))
            <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="emailInput" class="form-label">Email <sup>*</sup></label>
            <input type="email" name="email" id="emailInput" class="form-control" value="{{ old('email') }}" required maxlength="50">
            @if ($errors->has('email'))
            <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="phoneInput" class="form-label">Mobil telefonszám <sup>*</sup></label>
            <input type="text" name="phone" id="phoneInput" class="form-control" aria-describedby="phoneHelp" value="{{ old('phone') }}" required maxlength="12">
            <div id="phoneHelp" class="form-text">Csak számokat használjon a +36-os előválasztóval együtt!
                A megadott formátum pl: +36201112222</div>
            @if ($errors->has('phone'))
            <div class="text-danger">{{ $errors->first('phone')}}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="passwordInput" class="form-label">Jelszó <sup>*</sup></label>
            <input type="password" name="password" id="passwordInput" class="form-control" aria-describedby="passwordHelp" required minlength="5">
            <div id="passwordHelp" class="form-text">A jelszónak minimum 5 karakter hosszúnak kell lennie. Legyen benne kisbetű, nagybetű, szám</div>
            @if ($errors->has('password'))
            <div class="text-danger">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="password_confirmationInput" class="form-label">Jelszó ismét <sup>*</sup></label>
            <input type="password" name="password_confirmation" id="password_confirmationInput" class="form-control" required minlength="5">
        </div>

        <div class="mb-3">
            <label for="team_nameInput" class="form-label">Csapatnév <sup>*</sup></label>
            <input type="text" name="team_name" id="team_nameInput" class="form-control" value="{{ old('team_name') }}" required minlength="2" maxlength="50">
            @if ($errors->has('team_name'))
            <div class="text-danger">{{ $errors->first('team_name') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="day_idInput" class="form-label">Játéknap <sup>*</sup></label>
            <select name="day_id" id="day_idInput" class="form-control" required>
                <option value="0" disabled selected>Válassz játéknapot</option>
                @foreach ($days as $day)
                <option value="{{ $day->id }}" {{ old('day_id') == $day->id ? 'selected' : '' }}>{{ $day->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('day_id'))
            <div class="text-danger">{{ $errors->first('day_id') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="track_idInput" class="form-label">Pálya <sup>*</sup></label>
            <select name="track_id" id="track_idInput" class="form-control" required>
                <option value="0" disabled selected>Válassz pályát</option>
                @foreach ($tracks as $track)
                <option value="{{ $track->id }}" {{ old('track_id') == $track->id ? 'selected' : '' }}>{{ $track->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('track_id'))
            <div class="text-danger">{{ $errors->first('track_id') }}</div>
            @endif
        </div>

        <div>
            <input type="submit" class="btn btn-primary btn-sm" value="Regisztráció">
        </div>

    </form>
</div>

@endsection
