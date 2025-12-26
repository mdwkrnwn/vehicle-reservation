<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f8fafc, #e5e7eb);
            min-height: 100vh;
        }

        .auth-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .auth-title {
            font-weight: 600;
            font-size: 1.4rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 14px;
        }

        .btn-primary {
            border-radius: 10px;
            padding: 10px;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">
                <div class="card auth-card p-4">

                    <div class="auth-title">Login Aplikasi</div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        Belum punya akun?
                        <a href="{{ route('register') }}">Register</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>