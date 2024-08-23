 @extends('layouts.app')

@section('content') 
    {{-- style --}}
    <style>
        .card {
            border-radius: 15px;
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: 2s ease;
        }

        .btn-primary:hover {
            border-radius: 20px 10px 25px;
            background-color: #30b300;
            border-color: #00852a;
        }

        .btn-link {
            font-weight: bold;
        }


        .toggle-password {
            /* background-color: white; */
            position: absolute;
            top: 58%;
            right: 20px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        {{ __('Login') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">
                                    <ion-icon name="mail-outline"></ion-icon> {{ __('Email Address') }}
                                </label>

                                <div class="col-md-8">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">
                                    <ion-icon name="lock-closed-outline"></ion-icon> {{ __('Password') }}
                                </label>

                                <div class="col-md-8">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    <ion-icon name="eye-outline" class="toggle-password"
                                        onclick="togglePassword('password')"></ion-icon>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
{{-- 
                            <div class="form-group row mb-3">
                                <div class="col-md-8 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-danger small" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            var icon = input.nextElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('name', 'eye-off-outline');
            } else {
                input.type = 'password';
                icon.setAttribute('name', 'eye-outline');
            }
        }
    </script>
@endsection
