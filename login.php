<?php
include 'lib/library.php';

sudahLogin();

$form = isset($_GET['form']) && $_GET['form'] === 'register' ? 'register' : 'login';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $pw = $_POST['pw'];
    $confirm_pw = isset($_POST['confirm_pw']) ? $_POST['confirm_pw'] : null;
    $level = 1;

    if ($form === 'register') {
        $check_username_query = "SELECT * FROM t_login WHERE username = '$username'";
        $check_username_result = $mysqli->query($check_username_query);
        
        if ($check_username_result->num_rows > 0) {
            $_SESSION['error_message'] = 'Username sudah digunakan. Silakan pilih username lain.';
        } else {
            if ($pw !== $confirm_pw) {
                $_SESSION['error_message'] = 'Password tidak sesuai';
            } else {
                $hashed_pw = sha1($pw);

                $insert_query = "INSERT INTO t_login (username, pw, level) VALUES ('$username', '$hashed_pw', '$level')";

                if ($mysqli->query($insert_query)) {
                    $_SESSION['username'] = ucfirst($username);
                    $_SESSION['level'] = $level;
                    $_SESSION['welcome_message'] = "Registrasi berhasil. Selamat datang, " . $_SESSION['username'] . "!";
                    header('location: index.php');
                    exit();
                } else {
                    $_SESSION['error_message'] = 'Registrasi gagal!';
                }
            }
        }
    } else {
        $sql = "SELECT * FROM t_login WHERE username ='$username' AND pw = SHA1('$pw')";
        $data = $mysqli->query($sql) or die($mysqli->error);

        if ($data->num_rows != 0) {
            $row = mysqli_fetch_object($data);
            $_SESSION['username'] = ucfirst($row->username);
            $_SESSION['level'] = $row->level;
            $_SESSION['welcome_message'] = "Selamat datang, " . $_SESSION['username'] . "!";
            header('location: index.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Username atau password tidak sesuai';
        }
    }
}

include 'views/v_login.php';