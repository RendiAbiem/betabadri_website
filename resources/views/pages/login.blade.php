@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')

<section class="login-section position-relative d-flex align-items-center justify-content-center overflow-hidden">

    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background-image: url('{{ asset('img/bg-login.jpg') }}'); background-size: cover; background-position: center;">
    </div>
    <div class="program-bg-overlay"></div>

    <div class="glow-bg-center position-absolute top-50 start-50 translate-middle" style="width: 800px; height: 800px; opacity: 0.4;"></div>

    <div class="container position-relative z-2">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                <div class="login-card p-4 p-md-5" data-aos="zoom-in" data-aos-duration="800">

                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <img src="{{ asset('img/logo-betabadri-dark.png') }}" alt="Logo Beta Badri"
                                 class="img-fluid" style="max-height: 80px; filter: brightness(0) invert(1);">
                                 </div>

                        <h3 class="text-white fw-bold">Admin Login</h3>
                        <p class="text-white-50 small">
                            Masuk ke dashboard administrator.
                        </p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger bg-danger-soft border-danger text-danger text-center small py-3 mb-4 rounded-3">
                            <i class="fas fa-exclamation-triangle me-2"></i> {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="text-white-50 small mb-2 fw-bold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-navy-input border-end-0 text-white-50">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" id="email" name="email"
                                       class="form-control form-control-dark border-start-0 ps-0"
                                       value="{{ old('email') }}" required autofocus placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="text-white-50 small mb-2 fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-navy-input border-end-0 text-white-50">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" id="password" name="password"
                                       class="form-control form-control-dark border-start-0 ps-0"
                                       required placeholder="Password">
                                <button class="btn btn-outline-secondary bg-navy-input border-start-0 text-white-50" type="button" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="eye-icon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input bg-navy-input border-secondary" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label text-white-50 small" for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <button type="submit" class="btn btn-cta-green w-100 py-3 fw-bold shadow-lg-green">
                            Masuk System <i class="fas fa-arrow-right ms-2"></i>
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>
</section>

<script>
    function togglePassword() {
        var input = document.getElementById("password");
        var icon = document.getElementById("eye-icon");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

@endsection
