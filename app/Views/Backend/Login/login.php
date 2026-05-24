<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Aplikasi Perpustakaan</title>

    <link href="/Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Assets/css/datepicker3.css" rel="stylesheet">
    <link href="/Assets/css/styles.css" rel="stylesheet">
    <link href="/Assets/css/sweetalert2.min.css" rel="stylesheet">

    <style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: url('/Assets/background_login.jpeg') no-repeat center center;
        background-size: cover;
        font-family: Arial, sans-serif;
    }

    .login-wrapper {
        width: 100%;
        max-width: 420px;
        padding: 15px;
        animation: fadeInUp 0.8s ease;
    }

    .login-panel {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .panel-heading {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        background: #337ab7 !important;
        color: white !important;
        padding: 20px;
    }

    .logo-login {
        text-align: center;
        padding: 20px 0 10px;
    }

    .logo-login img {
        width: 100px;
        height: auto;
        animation: pulse 2s infinite;
    }

    .panel-body {
        padding: 30px;
    }

    .form-control {
        height: 45px;
        border-radius: 8px;
    }

    .input-group-addon {
        cursor: pointer;
        background: #fff;
        border-radius: 0 8px 8px 0;
    }

    .btn-primary {
        height: 45px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(51, 122, 183, 0.4);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }
    </style>

</head>

<body>

    <div class="login-wrapper">
        <div class="login-panel panel panel-default">

            <div class="logo-login">
                <img src="/Assets/logo_perpustakaan.png" alt="Logo Perpustakaan">
            </div>

            <div class="panel-heading">Login Perpustakaan</div>

            <div class="panel-body">
                <form role="form" action="<?= base_url('admin/autentikasi-login'); ?>" method="post">
                    <fieldset>

                        <div class="form-group">
                            <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Password" name="password"
                                    id="passwordField">

                                <span class="input-group-addon" id="togglePassword">
                                    <span class="glyphicon glyphicon-eye-open" id="eyeIcon"></span>
                                </span>
                            </div>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">
                                Remember Me
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script src="/Assets/js/jquery-1.11.1.min.js"></script>
    <script src="/Assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/sweetalert2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#togglePassword').on('click', function() {
            var passwordField = $('#passwordField');
            var eyeIcon = $('#eyeIcon');

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                eyeIcon.removeClass('glyphicon-eye-open')
                    .addClass('glyphicon-eye-close');
            } else {
                passwordField.attr('type', 'password');
                eyeIcon.removeClass('glyphicon-eye-close')
                    .addClass('glyphicon-eye-open');
            }
        });
    });
    </script>

    <?php if (session()->getFlashdata('success')) : ?>
    <script>
    swal("Success!", "<?php echo $_SESSION['success'] ?>", "success");
    </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
    <script>
    swal("Sorry!", "<?php echo $_SESSION['error'] ?>", "error");
    </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')) : ?>
    <script>
    swal("Warning!", "<?php echo $_SESSION['warning'] ?>", "warning");
    </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('info')) : ?>
    <script>
    swal("Info!", "<?php echo $_SESSION['info'] ?>", "info");
    </script>
    <?php endif; ?>

</body>

</html>