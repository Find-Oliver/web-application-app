<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Employee Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-logo {
            width: 260px;
            max-width: 100%;
            height: auto;
            display: block;
            object-fit: contain;
            margin: 0 auto 10px;
        }

        .auth-title {
            font-size: 24px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .auth-subtitle {
            font-size: 14px;
            color: #718096;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2d3748;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-error {
            color: #e53e3e;
            font-size: 13px;
            margin-top: 5px;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-checkbox input {
            margin: 0;
        }

        .form-checkbox label {
            margin: 0;
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .auth-link {
            text-align: center;
            margin-top: 20px;
        }

        .auth-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }

        .auth-link a:hover {
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            color: #cbd5e0;
            font-size: 14px;
        }

        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #c6f6d5;
            border: 1px solid #9ae6b4;
            color: #22543d;
        }

        .alert-error {
            background-color: #fed7d7;
            border: 1px solid #fc8181;
            color: #742a2a;
        }

        body.auth-page-login {
            min-height: 100vh;
            min-height: 100svh;
            padding: 28px 20px;
            color: #172033;
            background:
                radial-gradient(ellipse at 12% 10%, rgba(226, 232, 240, 0.7), transparent 36%),
                linear-gradient(145deg, #f4f6fa 0%, #e9eef5 100%);
        }

        .auth-page-login .auth-container {
            max-width: 448px;
            padding: 30px 38px 22px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 18px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12), 0 3px 10px rgba(15, 23, 42, 0.04);
        }

        .auth-page-login .auth-header {
            margin-bottom: 24px;
        }

        .auth-page-login .auth-logo {
            width: 154px;
            max-width: 100%;
            height: auto;
            margin: 0 auto 14px;
            object-fit: contain;
        }

        .auth-page-login .auth-title {
            margin-bottom: 5px;
            color: #172033;
            font-size: 27px;
            font-weight: 700;
            letter-spacing: -0.04em;
            line-height: 1.2;
        }

        .auth-page-login .auth-subtitle {
            color: #687386;
            font-size: 14px;
            line-height: 1.5;
        }

        .auth-page-login .alert {
            padding: 11px 13px;
            border-radius: 9px;
            line-height: 1.5;
        }

        .auth-page-login .form-group {
            margin-bottom: 17px;
        }

        .auth-page-login label {
            margin-bottom: 7px;
            color: #303b4e;
            font-size: 13px;
            font-weight: 600;
        }

        .auth-page-login .input-wrap {
            position: relative;
        }

        .auth-page-login .input-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            width: 18px;
            height: 18px;
            color: #8993a3;
            pointer-events: none;
            transform: translateY(-50%);
        }

        .auth-page-login input[type="email"],
        .auth-page-login input[type="password"],
        .auth-page-login input[type="text"] {
            height: 48px;
            padding: 0 14px 0 42px;
            border: 1px solid #d9e0e9;
            border-radius: 9px;
            background: #fff;
            color: #172033;
            font: inherit;
            font-size: 14px;
            transition: border-color 0.18s ease, box-shadow 0.18s ease;
        }

        .auth-page-login input::placeholder {
            color: #9aa3b1;
        }

        .auth-page-login input[type="email"]:focus,
        .auth-page-login input[type="password"]:focus,
        .auth-page-login input[type="text"]:focus {
            border-color: #ed8b25;
            outline: none;
            box-shadow: 0 0 0 3px rgba(237, 139, 37, 0.16);
        }

        .auth-page-login input[aria-invalid="true"] {
            border-color: #dc6262;
        }

        .auth-page-login .password-input {
            padding-right: 48px !important;
        }

        .auth-page-login .password-toggle {
            position: absolute;
            top: 50%;
            right: 7px;
            display: inline-flex;
            width: 36px;
            height: 36px;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 7px;
            background: transparent;
            color: #727d8d;
            cursor: pointer;
            transform: translateY(-50%);
        }

        .auth-page-login .password-toggle:hover {
            background: #f2f4f7;
            color: #172033;
        }

        .auth-page-login .password-toggle:focus-visible,
        .auth-page-login .btn:focus-visible,
        .auth-page-login .auth-link a:focus-visible,
        .auth-page-login .form-checkbox input:focus-visible {
            outline: 3px solid rgba(237, 139, 37, 0.38);
            outline-offset: 2px;
        }

        .auth-page-login .form-error {
            margin-top: 6px;
            color: #bd3d3d;
            font-size: 12px;
        }

        .auth-page-login .login-options {
            display: flex;
            min-height: 34px;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 1px 0 18px;
        }

        .auth-page-login .form-checkbox {
            display: inline-flex;
            min-height: 36px;
            align-items: center;
            gap: 9px;
        }

        .auth-page-login .form-checkbox input {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: #e77919;
        }

        .auth-page-login .form-checkbox label {
            margin: 0;
            color: #596579;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
        }

        .auth-page-login .auth-link a {
            color: #b9560d;
            font-weight: 600;
        }

        .auth-page-login .auth-link a:hover {
            color: #8e3e07;
        }

        .auth-page-login .login-options .auth-link {
            margin: 0;
            font-size: 13px;
        }

        .auth-page-login .btn {
            display: inline-flex;
            min-height: 48px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 9px;
            font-size: 15px;
            transition: background-color 0.18s ease, box-shadow 0.18s ease, transform 0.12s ease;
        }

        .auth-page-login .btn-primary {
            background: #17263d;
            color: #fff;
        }

        .auth-page-login .btn-primary:hover {
            background: #203653;
            box-shadow: 0 6px 14px rgba(23, 38, 61, 0.16);
            transform: translateY(-1px);
        }

        .auth-page-login .btn-primary:active {
            background: #111e31;
            transform: translateY(0);
        }

        .auth-page-login .btn:disabled {
            cursor: wait;
            opacity: 0.82;
        }

        .auth-page-login .loading-spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: auth-spin 0.7s linear infinite;
        }

        @keyframes auth-spin {
            to { transform: rotate(360deg); }
        }

        .auth-page-login .divider {
            display: flex;
            align-items: center;
            gap: 13px;
            margin: 20px 0;
            color: #929baa;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.12em;
        }

        .auth-page-login .divider::before,
        .auth-page-login .divider::after {
            height: 1px;
            flex: 1;
            background: #e7ebf0;
            content: "";
        }

        .auth-page-login .register-link {
            margin: 0;
            color: #687386;
            font-size: 13px;
        }

        .auth-page-login .demo-access {
            margin-top: 18px;
            border-top: 1px solid #edf0f4;
            padding-top: 12px;
            color: #747f8e;
            font-size: 12px;
        }

        .auth-page-login .demo-access summary {
            width: fit-content;
            color: #687386;
            cursor: pointer;
            font-weight: 600;
        }

        .auth-page-login .demo-access p {
            margin-top: 7px;
            line-height: 1.6;
        }

        .auth-page-login .auth-footer {
            margin-top: 18px;
            color: #8a94a3;
            font-size: 11px;
            text-align: center;
        }

        @media (max-width: 480px) {
            body.auth-page-login {
                align-items: center;
                padding: 18px 12px;
            }

            .auth-page-login .auth-container {
                padding: 24px 22px 19px;
                border-radius: 16px;
            }

            .auth-page-login .auth-logo {
                width: 128px;
            }

            .auth-page-login .auth-header {
                margin-bottom: 20px;
            }

            .auth-page-login .auth-title {
                font-size: 25px;
            }

            .auth-page-login .login-options {
                gap: 8px;
            }

            .auth-page-login .login-options .auth-link {
                font-size: 12px;
            }
        }
    </style>
</head>
<body class="@yield('body-class')">
    <div class="auth-container">
        @yield('content')
    </div>
</body>
</html>
