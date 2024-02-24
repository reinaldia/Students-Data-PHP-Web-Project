<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghazi XI RPL 2</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url(https://c4.wallpaperflare.com/wallpaper/142/751/831/landscape-anime-digital-art-fantasy-art-wallpaper-preview.jpg) no-repeat;
            background-size: cover;
            background-position: center;
        }

        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(9px);
            color: #fff;
            border-radius: 12px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
        }

        .wrapper .input-box {
            position: relative;
            width: 100%;
            height: 50px;

            margin: 30px 0;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
            transition: border 0.5s ease;
        }

        .input-box input::placeholder {
            color: #fff;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 30%;
            transform: translate(-50%);
            font-size: 20px;

        }

        .input-box input:hover,
        .input-box input:focus,
        .input-box input.has-content {
            border: 2px solid white;
        }

        .wrapper .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input {
            accent-color: #fff;
            margin-right: 3px;

        }

        .remember-forgot a {
            color: #fff;
            text-decoration: none;

        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .wrapper .btn {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 45px;
            background: transparent;
            border: 1.5px solid white;
            outline: white;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: white;
            font-weight: 600;
            transition: color 0.6s ease;
        }

        .wrapper .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: white;
            transition: left 0.6s ease, opacity 0.6s ease;
            z-index: -1;
        }

        .wrapper .btn:hover::before {
            left: 0;
        }

        .wrapper .btn:hover {
            color: black;
        }


        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;

        }

        .register-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    $form = '';

    if (isset($_GET['form']) && $_GET['form'] === 'register') {
        $form = 'register';
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <?php if (isset($_SESSION['error_message'])) : ?>
        <script>
            toastr.error('<?php echo $_SESSION['error_message']; ?>');
        </script>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>


    <div class="wrapper">
        <form action="login.php<?= $form === 'register' ? '?form=register' : ''; ?>" method="post">
            <h1><?= $form === 'register' ? 'Register' : 'Login'; ?></h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="pw" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <?php if ($form === 'register') : ?>
                <div class="input-box">
                    <input type="password" name="confirm_pw" placeholder="Confirm Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
            <?php endif; ?>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember Me</label>
                <a href="#" id="toggleForm">Forgot Password</a>
            </div>
            <button type="submit" class="btn"><?= $form === 'register' ? 'Register' : 'Login'; ?></button>
            <div class="register-link">
                <p><?= $form === 'register' ? 'Already have an account? <a href="?form=login">Login</a>' :
                        'Dont have an account? <a href="?form=register">Register</a>'; ?></p>
            </div>
        </form>
    </div>

    <script>
        document.getElementById("toggleForm").addEventListener("click", function(e) {
            e.preventDefault();
            var currentForm = "<?php echo $form; ?>";
            var newForm = currentForm === 'login' ? 'register' : 'login';
            window.location.href = "?form=" + newForm;
        });

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focusout', function() {
                if (!this.value.trim() && !this.classList.contains('has-content')) {
                    this.classList.remove("has-content");
                } else {
                    this.classList.add("has-content");
                }
            });
        });
    </script>
</body>

</html>