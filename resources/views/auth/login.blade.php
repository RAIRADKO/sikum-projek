@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    body {
        background: #f8f9fa !important;
    }
    .login-card {
        border-radius: 22px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.16);
        background: #fff;
        padding-top: 2.2rem !important;
        padding-bottom: 2.2rem !important;
        margin-top: 18px;
        margin-bottom: 18px;
    }
    .login-logo {
        width: 90px;
        margin-bottom: 10px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .login-title {
        font-weight: 700;
        font-size: 2rem;
    }
    .login-subtitle {
        color: #6c757d;
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }
    .form-control:focus {
        box-shadow: 0 0 0 2px #2563eb33;
        border-color: #27ae60;
    }
    .btn-login {
        background: #27ae60;
        border: none;
        font-size: 1.25rem;
        font-weight: 600;
        border-radius: 10px;
        padding: 0.75rem 0;
        transition: background 0.2s;
    }
    .btn-login:hover {
        background: #27ae60;
    }
    .login-link {
        color: #27ae60;
        text-decoration: none;
    }
    .login-link:hover {
        text-decoration: underline;
    }
    .input-group-text {
        background: #f3f6fa;
        border: none;
    }
    .login-footer {
        text-align: center;
        margin-top: 1.5rem;
        color: #6c757d;
    }
</style>
<div class="d-flex align-items-center justify-content-center" style="min-height: 70vh; background: #f8f9fa;">
    <div class="col-12 col-sm-10 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0 rounded-lg login-card p-4">
            <div class="mb-3 text-center">
                <img src="{{ asset('img/Lambang_Kabupaten_Purworejo.png') }}" alt="Logo" class="login-logo">
                <div class="login-title mt-2">Selamat Datang</div>
                <div class="login-subtitle">Masuk untuk melanjutkan</div>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-person' viewBox='0 0 16 16'><path d='M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/><path fill-rule='evenodd' d='M8 9a5 5 0 0 0-5 5v.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14a5 5 0 0 0-5-5z'/></svg></span>
                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="Nama Admin / NIP">
                    </div>
                    @error('login')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-lock' viewBox='0 0 16 16'><path d='M8 1a4 4 0 0 0-4 4v3a2 2 0 0 0-1 1.732V13a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3.268A2 2 0 0 0 12 8V5a4 4 0 0 0-4-4zm-3 4a3 3 0 1 1 6 0v3H5V5zm-1 4.732A1 1 0 0 1 5 9h6a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3.268z'/></svg></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        <span class="input-group-text" style="cursor:pointer" onclick="togglePassword()"><svg id="eyeIcon" xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'><path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.787C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z'/><path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm0 1a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z'/></svg></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Ingat Saya</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-login w-100">Login</button>
            </form>
            <div class="login-footer mt-3">
                Belum punya akun? <a href="{{ route('register') }}" class="login-link">Daftar di sini.</a>
            </div>
        </div>
    </div>
</div>
<script>
function togglePassword() {
    const pwd = document.getElementById('password');
    const eye = document.getElementById('eyeIcon');
    if (pwd.type === 'password') {
        pwd.type = 'text';
        eye.outerHTML = `<svg id="eyeIcon" xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-eye-slash' viewBox='0 0 16 16'><path d='M13.359 11.238l2.147 2.147a.5.5 0 0 1-.708.708l-2.147-2.147A7.97 7.97 0 0 1 8 13.5c-5 0-8-5.5-8-5.5a15.634 15.634 0 0 1 3.354-3.856l-2.147-2.147a.5.5 0 1 1 .708-.708l2.147 2.147A7.97 7.97 0 0 1 8 2.5c5 0 8 5.5 8 5.5a15.634 15.634 0 0 1-3.354 3.856zM8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.133 13.133 0 0 0 14.828 8c-.058-.087-.122-.183-.195-.288-.335-.48-.83-1.12-1.465-1.787C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 0 1.172 8c.058.087.122.183.195.288.335.48.83-1.12-1.465-1.787C4.121 11.332 5.881 12.5 8 12.5z'/><path d='M8 5.5a2.5 2.5 0 0 1 2.45 1.936l-3.914 3.914A2.5 2.5 0 0 1 8 5.5zm0 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z'/></svg>`;
    } else {
        pwd.type = 'password';
        eye.outerHTML = `<svg id="eyeIcon" xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'><path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83-1.12-1.465-1.787C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z'/><path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm0 1a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z'/></svg>`;
    }
}
</script>
@endsection