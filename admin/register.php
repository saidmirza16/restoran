<?php
session_start();
require_once "../function.php";

if (isset($_POST["login"])) {
    $login = login_admin();
} else if (isset($_POST["register"])) {
    $register = register_admin();
    echo $register > 0
        ? "<script>alert('Berhasil Registrasi!'); location.href = 'register.php';</script>"
        : "<script>alert('Gagal Registrasi!'); location.href = 'register.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login / Register Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../src/css/bootstrap-5.2.0/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 35px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 12px 32px 0 rgba(163, 159, 159, 0.3);
            color: white;
            animation: fadeSlideIn 0.7s ease-in-out;
        }

        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateY(-40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .form-control {
            background-color: rgba(22, 16, 16, 0.2);
            border: none;
            color: #fff;
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 10px #ffffff90;
            background-color: rgba(255, 255, 255, 0.25);
        }

        .form-control::placeholder {
            color:rgb(16, 3, 3);
        }

        .btn {
            border-radius: 25px;
            font-weight: bold;
            transition: 0.3s;
        }

        .tab-btn {
            width: 48%;
            transition: 0.4s ease;
        }

        .form-group {
            position: relative;
        }

        .form-group i {
            position: absolute;
            top: 12px;
            left: 15px;
            color: #ccc;
        }

        .form-group input {
            padding-left: 35px;
            margin-bottom: 15px;
        }

        #judul-form {
            font-weight: bold;
            font-size: 1.9rem;
            margin-bottom: 25px;
            text-align: center;
            color: #fff;
            animation: fadeInText 1s ease;
        }

        @keyframes fadeInText {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert {
            background-color: rgba(255, 0, 0, 0.75);
            color: white;
            border: none;
            border-radius: 10px;
            animation: fadeInText 0.5s ease;
        }

        .form-section {
            transition: all 0.4s ease;
            opacity: 0;
            transform: scale(0.95);
            position: absolute;
            width: 100%;
        }

        .form-section.active {
            opacity: 1;
            transform: scale(1);
            position: relative;
        }
    </style>
</head>

<body>
    <div class="card-glass position-relative overflow-hidden">
        <div id="judul-form">LOGIN ADMIN</div>

        <div class="d-flex justify-content-between mb-4">
            <button id="tab-login" class="btn btn-light tab-btn">Login</button>
            <button id="tab-register" class="btn btn-outline-light tab-btn">Register</button>
        </div>

        <!-- Error -->
        <?php if (isset($_POST["login"]) && !$login): ?>
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-triangle"></i> Username atau Password salah!
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form id="form-login" class="form-section active" method="POST">
            <div class="form-group">
                <i class="fa fa-user"></i>
                <input type="text" class="form-control" name="username" placeholder="Username" required autocomplete="off">
            </div>
            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off">
            </div>
            <button type="submit" name="login" class="btn btn-success w-100"><i class="fa fa-sign-in-alt"></i> Login</button>
        </form>

        <!-- Register Form -->
        <form id="form-register" class="form-section" method="POST">
            <div class="form-group">
                <i class="fa fa-user-plus"></i>
                <input type="text" class="form-control" name="username" placeholder="Username" required autocomplete="off">
            </div>
            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off">
            </div>
            <div class="form-group">
                <i class="fa fa-phone"></i>
                <input type="text" class="form-control" name="no_hp" placeholder="No HP" required autocomplete="off">
            </div>
            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off">
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100"><i class="fa fa-user-plus"></i> Register</button>
        </form>
    </div>

    <script src="../src/css/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <script>
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');
        const formLogin = document.getElementById('form-login');
        const formRegister = document.getElementById('form-register');
        const judul = document.getElementById('judul-form');

        tabLogin.addEventListener('click', () => {
            tabLogin.classList.replace('btn-outline-light', 'btn-light');
            tabRegister.classList.replace('btn-light', 'btn-outline-light');
            formLogin.classList.add('active');
            formRegister.classList.remove('active');
            judul.textContent = "LOGIN ADMIN";
        });

        tabRegister.addEventListener('click', () => {
            tabRegister.classList.replace('btn-outline-light', 'btn-light');
            tabLogin.classList.replace('btn-light', 'btn-outline-light');
            formLogin.classList.remove('active');
            formRegister.classList.add('active');
            judul.textContent = "REGISTER ADMIN";
        });
    </script>
</body>
</html>
