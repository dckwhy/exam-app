@extends('layouts.app')
@section('content')
<div id="auth-left">
    <h1 class="auth-title">Sign Up</h1>
    <p class="auth-subtitle mb-5">Masukkan data anda untuk melakukan pendaftaran.</p>
    <form action="{{ route('register') }}" method="POST" autocomplete="off">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" name="name" class="form-control form-control-xl @error('name') is-invalid @enderror"
                placeholder="Nama Lengkap" value="{{ old('name') }}">
            <div class="form-control-icon">
                <i class="fa fa-user"></i>
            </div>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
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
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password_confirmation" class="form-control form-control-xl"
                placeholder="Konfirmasi Password">
            <div class="form-control-icon">
                <i class="fa fa-lock"></i>
            </div>
        </div>
        <button class="btn btn-block btn-primary btn-lg shadow-lg mt-5">Sign Up</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class='text-gray-600'>Sudah memiliki akun? <a href="{{ route('login') }}" class="font-bold">Log in</a>.
        </p>
    </div>
</div>
@endsection