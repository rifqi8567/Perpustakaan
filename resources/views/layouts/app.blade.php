<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Login/Register/Forgot Password</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2033%2034'%20fill-rule='evenodd'%20stroke-linejoin='round'%20stroke-miterlimit='2'%20xmlns:v='https://vecta.io/nano'%3e%3cpath%20d='M3%2027.472c0%204.409%206.18%205.552%2013.5%205.552%207.281%200%2013.5-1.103%2013.5-5.513s-6.179-5.552-13.5-5.552c-7.281%200-13.5%201.103-13.5%205.513z'%20fill='%23435ebe'%20fill-rule='nonzero'/%3e%3ccircle%20cx='16.5'%20cy='8.8'%20r='8.8'%20fill='%2341bbdd'/%3e%3c/svg%3e" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/auth.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="assets/static/js/initTheme.js"></script>
</head>

<body>
    <div id="app">
        <div id="auth">
            <div class="row h-100">
                <div class="col-lg-5 col-12">
                    <div id="auth-left">
                        <div class="auth-logo">
                            <a href="{{ url('/') }}">
                                <img src="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20152%2034'%20fill-rule='evenodd'%20stroke-linejoin='round'%20stroke-miterlimit='2'%3e%3cpath%20d='M0%2027.472c0%204.409%206.18%205.552%2013.5%205.552%207.281%200%2013.5-1.103%2013.5-5.513s-6.179-5.552-13.5-5.552c-7.281%200-13.5%201.103-13.5%205.513z'%20fill='%23435ebe'%20fill-rule='nonzero'/%3e%3ccircle%20cx='13.5'%20cy='8.8'%20r='8.8'%20fill='%2341bbdd'/%3e%3c/svg%3e" alt="Logo">
                            </a>
                        </div>
                        
                        <!-- Login Form -->
                        <div id="auth-login">
                            <h1 class="auth-title">Login</h1>
                            <p class="auth-subtitle mb-5">Log in to access your dashboard.</p>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group position-relative mb-4">
                                    <input type="email" class="form-control form-control-xl" placeholder="Email" name="email" required>
                                </div>

                                <div class="form-group position-relative mb-4">
                                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" required>
                                </div>

                                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                            </form>

                            <div class="text-center mt-4">
                                <p class="mb-0"><a href="#" onclick="toggleAuthForms('forgot-password')">Forgot Password?</a></p>
                                <p class="mb-0">Don't have an account? <a href="#" onclick="toggleAuthForms('register')">Register</a></p>
                            </div>
                        </div>

                        <!-- Register Form -->
                        <div id="auth-register" style="display: none;">
                            <h1 class="auth-title">Register</h1>
                            <p class="auth-subtitle mb-5">Create a new account to get started.</p>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group position-relative mb-4">
                                    <input type="text" class="form-control form-control-xl" placeholder="Name" name="name" required>
                                </div>

                                <div class="form-group position-relative mb-4">
                                    <input type="email" class="form-control form-control-xl" placeholder="Email" name="email" required>
                                </div>

                                <div class="form-group position-relative mb-4">
                                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" required>
                                </div>

                                <div class="form-group position-relative mb-4">
                                    <input type="password" class="form-control form-control-xl" placeholder="Confirm Password" name="password_confirmation" required>
                                </div>

                                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Register</button>
                            </form>

                            <div class="text-center mt-4">
                                <p class="mb-0">Already have an account? <a href="#" onclick="toggleAuthForms('login')">Log in</a></p>
                            </div>
                        </div>

                        <!-- Forgot Password Form -->
                        <div id="auth-forgot-password" style="display: none;">
                            <h1 class="auth-title">Forgot Password</h1>
                            <p class="auth-subtitle mb-5">Enter your email to reset your password.</p>

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group position-relative mb-4">
                                    <input type="email" class="form-control form-control-xl" placeholder="Email" name="email" required>
                                </div>

                                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send Reset Link</button>
                            </form>

                            <div class="text-center mt-4">
                                <p class="mb-0">Remember your password? <a href="#" onclick="toggleAuthForms('login')">Log in</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div id="auth-right">
                        <!-- Add background or any additional content for the right side -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAuthForms(form) {
            const loginForm = document.getElementById('auth-login');
            const registerForm = document.getElementById('auth-register');
            const forgotPasswordForm = document.getElementById('auth-forgot-password');

            loginForm.style.display = 'none';
            registerForm.style.display = 'none';
            forgotPasswordForm.style.display = 'none';

            if (form === 'register') {
                registerForm.style.display = 'block';
            } else if (form === 'forgot-password') {
                forgotPasswordForm.style.display = 'block';
            } else {
                loginForm.style.display = 'block';
            }
        }
    </script>
</body>

</html>
