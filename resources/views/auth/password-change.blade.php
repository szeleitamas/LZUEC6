@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ URL::previous() }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>Jelszó módosítás</h3>
    </div>

    <div class="mt-5">
        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

    </div>

    <form action="{{ route('password.update') }}" method="POST" class="auth ms-auto me-auto mt-auto">
        @csrf

        <div class="mb-3">
            <label for="oldPasswordInput" class="form-label">Régi jelszó <sup>*</sup></label>
            <input name="old_password" type="password" class="form-control" id="oldPasswordInput" required>
            @if ($errors->has('old_password'))
            <div class="text-danger">{{ $errors->first('old_password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="newPasswordInput" class="form-label">Új jelszó <sup>*</sup></label>
            <input type="password" name="new_password" class="form-control" aria-describedby="passwordHelp" id="newPasswordInput" required minlength="5">
            <div id="passwordHelp" class="form-text">A jelszónak minimum 5 karakter hosszúnak kell lennie. Legyen benne kisbetű, nagybetű, szám</div>
            @if ($errors->has('new_password'))
            <div class="text-danger">{{ $errors->first('new_password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="confirmNewPasswordInput" class="form-label">Új jelszó ismét <sup>*</sup></label>
            <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput" required minlength="5">
        </div>

       <div>
            <input type="submit" class="btn btn-primary btn-sm" value="Frissítés">
        </div>

    </form>
</div>

@endsection
