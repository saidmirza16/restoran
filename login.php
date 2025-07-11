<?php
session_start();
require_once "function.php";

if (isset($_POST["login"])) {
    $login = login_user();
} else if (isset($_POST["register"])) {
    $register = register_akun();
    echo $register > 0
        ? "<script>alert('Berhasil Registrasi!'); location.href = 'login.php';</script>"
        : "<script>alert('Gagal Registrasi!'); location.href = 'login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login / Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./src/css/bootstrap-5.2.0/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

        <style>
        body {
            /* Replace with your own restaurant image URL or local path */
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Montserrat', sans-serif;
            position: relative
        }

        .card-glass {
            backdrop-filter: blur(20px);
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 480px;
            color: #fff;
            animation: fadeIn 0.8s ease;
            position: relative;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding-left: 38px;
            transition: box-shadow 0.3s ease;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
            color: #fff;
        }

        .form-control::placeholder {
            color: #e0e0e0;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group i {
            position: absolute;
            top: 12px;
            left: 12px;
            color: #ccc;
        }

        .btn {
            border-radius: 30px;
            font-weight: bold;
        }

        .tab-btn {
            width: 48%;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background-color: #fff;
            color: #000;
        }

        #judul-form {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
            font-weight: bold;
            animation: fadeIn 1s ease-in-out;
            color: #fff;
        }

        .alert {
            background-color: rgba(255, 0, 0, 0.75);
            color: white;
            border-radius: 10px;
            border: none;
        }

        .form-section {
            transition: all 0.4s ease;
            opacity: 0;
            transform: scale(0.95);
            display: none;
        }

        .form-section.active {
            opacity: 1;
            transform: scale(1);
            display: block;
        }
    </style>
</head>

<body>

<div class="card-glass">
    <div id="judul-form">LOGIN USER</div>

    <!-- Tab Switch -->
    <div class="d-flex justify-content-between mb-4">
        <button id="tab-login" class="btn btn-light tab-btn active">Login</button>
        <button id="tab-register" class="btn btn-outline-light tab-btn">Register</button>
    </div>

    <!-- Error Message -->
    <?php if (isset($_POST["login"]) && !$login): ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Username / Password salah</div>
    <?php endif; ?>

    <!-- Form Login -->
    <form id="form-login" class="form-section active" method="POST">
        <div class="form-group">
            <i class="fa fa-user"></i>
            <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off">
        </div>
        <div class="form-group">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
        </div>
        <button type="submit" name="login" class="btn btn-success w-100"><i class="fa fa-sign-in-alt"></i> Login</button>
    </form>

    <!-- Form Register -->
    <form id="form-register" class="form-section" method="POST">
        <div class="form-group">
            <i class="fa fa-user-plus"></i>
            <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off">
        </div>
        <div class="form-group">
            <i class="fa fa-phone"></i>
            <input type="text" name="no_hp" class="form-control" placeholder="No HP" required autocomplete="off">
        </div>
        <div class="form-group">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
        </div>
        <div class="form-group">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="off">
        </div>
        <button type="submit" name="register" class="btn btn-primary w-100"><i class="fa fa-user-plus"></i> Register</button>
    </form>
</div>

<script src="./src/css/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
<script>
    const tabLogin = document.getElementById('tab-login');
    const tabRegister = document.getElementById('tab-register');
    const formLogin = document.getElementById('form-login');
    const formRegister = document.getElementById('form-register');
    const judul = document.getElementById('judul-form');

    tabLogin.addEventListener('click', () => {
        tabLogin.classList.add('active');
        tabRegister.classList.remove('active');
        formLogin.classList.add('active');
        formRegister.classList.remove('active');
        judul.textContent = 'LOGIN USER';
    });

    tabRegister.addEventListener('click', () => {
        tabRegister.classList.add('active');
        tabLogin.classList.remove('active');
        formLogin.classList.remove('active');
        formRegister.classList.add('active');
        judul.textContent = 'REGISTER USER';
    });
</script>

</body>
</html>

