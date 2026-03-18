<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login — {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        :root { --primary: {{ \App\Models\Setting::get('primary_color', '#b8962b') }}; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            width: 100%; max-width: 420px;
            background: #fff; border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            padding: 2rem; text-align: center; color: #fff;
        }
        .login-header img { max-height: 50px; margin-bottom: 1rem; }
        .login-header h4 { margin: 0; font-weight: 700; }
        .login-header p { margin: 0.25rem 0 0; opacity: 0.7; font-size: 0.9rem; }
        .login-body { padding: 2rem; }
        .form-control {
            border-radius: 8px; border: 1px solid #dee2e6;
            padding: 0.75rem 1rem; font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(184,150,43,0.2);
        }
        .btn-login {
            background: var(--primary); color: #fff; border: none;
            border-radius: 8px; padding: 0.75rem;
            font-weight: 600; font-size: 1rem; width: 100%;
            transition: opacity 0.2s;
        }
        .btn-login:hover { opacity: 0.9; color: #fff; }
        .input-group-text {
            border-radius: 8px 0 0 8px; background: #f8f9fa;
            border: 1px solid #dee2e6; color: #6c757d;
        }
        .input-group .form-control { border-radius: 0 8px 8px 0; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            @php $logo = \App\Models\Setting::get('logo'); @endphp
            @if($logo)
                <img src="{{ asset('uploads/' . $logo) }}" alt="{{ config('app.name') }}" />
            @else
                <div class="mb-2"><i class="fas fa-building fa-2x" style="color: var(--primary)"></i></div>
            @endif
            <h4>{{ config('app.name') }}</h4>
            <p>Admin Panel — Sign In</p>
        </div>

        <div class="login-body">

            {{-- Flash error --}}
            @if(session('error'))
                <div class="alert alert-danger py-2 mb-3 rounded-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if($errors->any())
                <div class="alert alert-danger py-2 mb-3 rounded-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="admin@example.com" required autofocus />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Enter your password" required />
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In to Admin Panel
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
