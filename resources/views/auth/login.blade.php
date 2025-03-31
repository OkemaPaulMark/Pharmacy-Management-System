<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pharmacy MS - Login</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <style>
        :root {
            --primary: #4e73df;
            --primary-dark: #2e59d9;
            --secondary: #858796;
            --light: #f8f9fc;
            --white: #ffffff;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 94vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .login-card {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            width: 100%;
            max-width: 900px;
        }
        
        .login-left {
            background: linear-gradient(rgba(78, 115, 223, 0.85), rgba(78, 115, 223, 0.85)), 
                        url('https://images.unsplash.com/photo-1551076805-e1869033e561?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
        }
        
        .login-left h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .login-left p {
            opacity: 0.9;
        }
        
        .login-right {
            padding: 2.5rem;
            background: var(--white);
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid #e3e6f0;
            width: 100%;
            box-sizing: border-box;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-login {
            background-color: var(--primary);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-login:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .form-group {
            margin-bottom: 1.2rem;
        }
        
        .text-danger {
            color: #e74a3b;
            font-size: 0.85rem;
        }
        
        .footer {
            font-size: 0.85rem;
            color: var(--secondary);
            margin-top: 1rem;
            text-align: center;
        }
        
        .custom-checkbox {
            display: flex;
            align-items: center;
        }
        
        .custom-checkbox input {
            margin-right: 8px;
        }
        
        @media (max-width: 991.98px) {
            .login-left {
                display: none;
            }
            .login-right {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card login-card">
                    <div class="row no-gutters">
                        <!-- Left Side (Image) -->
                        <div class="col-lg-6 d-none d-lg-block login-left">
                            <div class="text-center">
                                <i class="fas fa-pills fa-3x mb-3"></i>
                                <h2>Pharmacy Management System</h2>
                                <p>Secure access to your pharmacy's management dashboard</p>
                            </div>
                        </div>
                        
                        <!-- Right Side (Form) -->
                        <div class="col-lg-6 login-right">
                            <div class="text-center mb-4">
                                <i class="fas fa-pills fa-2x text-primary mb-3"></i>
                                <h4 class="font-weight-bold">Welcome Back</h4>
                            </div>
                            
                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="alert alert-success mb-4">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email" class="small font-weight-bold">Email Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password" class="small font-weight-bold">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                        <label class="custom-control-label small" for="remember">Remember me</label>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="small text-primary">Forgot password?</a>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block btn-login mb-3" style="margin-bottom: 16px;">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                                </button>

                                <div class="text-center small mt-3">
                                    Don't have an account? <a href="{{ route('register') }}" class="text-primary font-weight-bold">Sign up</a>
                                </div>
                            </form>
                            
                            <div class="footer">
                                <p class="mb-0">© {{ date('Y') }} Pharmacy MS. All rights reserved.</p>
                                <p class="mb-0">Designed by <a href="#" class="text-primary">Kalulu Technologies</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>