@extends('layout.app')
@section('content')

<p><a class="btn btn-secondary" href="{{ route('login.create') }}">Vissza</a></p>

<div class="container p-4">
    <div class="text-center">
        <h3>Elfelejtett jelszó</h3>
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

    <form action="{{ route('forgotPassword.update') }}" method="POST" class="auth ms-auto me-auto mt-auto">
        @csrf

        <div class="mb-3">
            <label for="emailInput" class="form-label">Email cím <sup>*</sup></label>
            <input type="email" name="email" class="form-control" id="emailInput" required maxlength="50">
            @if ($errors->has('email'))
            <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="newPasswordInput" class="form-label">Új jelszó <sup>*</sup></label>
            <input type="password" name="new_password" class="form-control" id="newPasswordInput" aria-describedby="passwordHelp" required minlength="5">
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
            <input type="submit" class="btn btn-primary" value="Frissítés">
        </div>

    </form>
</div>

@endsection
