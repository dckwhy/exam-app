@extends('layouts.app')
@section('content')
<div id="auth-left">
    <h1 class="auth-title">Log in.</h1>
    <p class="auth-subtitle mb-5">Log in dengan data yang anda masukkan ketika pendaftaran.</p>

    <form action="{{ route('login') }}" method="POST" autocomplete="off">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" name="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
                placeholder="Email" value="{{ old('email') }}">
            <div class="form-control-icon">
                <i class="fa fa-envelope"></i>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password"
                class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password">
            <div class="form-control-icon">
                <i class="fa fa-lock"></i>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-check form-check-lg d-flex align-items-end">
            <input class="form-check-input me-2" type="checkbox" id="remember" name="remember">
            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                Ingat saya
            </label>
        </div>
        <button type="submit" class="btn btn-block btn-primary btn-lg shadow-lg mt-5">Log in</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">
            Belum memiliki akun? <a href="{{ route('register') }}" class="font-bold">
                Daftar</a>.</p>
    </div>
</div>
@endsection