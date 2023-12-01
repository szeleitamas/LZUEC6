@extends('layout.app')

@section('title', 'Bejelentkezés')
@section('content')


<div class="container p-4">
    <div class="text-center">
        <h3>Bejelentkezés</h3>
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

    <form action="{{ route('login.store') }}" method="POST" class="auth ms-auto me-auto mt-auto">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email </label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
            <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">Jelszó </label>
            <input type="password" name="password" id="password" class="form-control" required>
            @if ($errors->has('password'))
            <div class="text-danger">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div>
            <input type="submit" class="btn btn-primary btn-sm" value="Bejelentkezés">
            <a href="{{ route('forgotPassword.change') }}" class="btn btn-secondary btn-sm">Elfelejtett jelszó</a>
        </div>

    </form>
</div>

@endsection
