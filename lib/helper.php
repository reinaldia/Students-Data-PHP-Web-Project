<?php
    session_start();

    function base_url () {
        return "http://localhost/progweb/pwpb21";
    }

    function flash($tipe, $pesan = '') {
        if (empty($pesan)) {
            $pesan = @$_SESSION[$tipe];
            unset($_SESSION[$tipe]);
            return $pesan;
        } else {
            $_SESSION[$tipe] = $pesan;
        }
    }

    function cekLogin() {
        $username = @$_SESSION['username'];
        $level = @$_SESSION['level'];

        if (empty($username) AND empty($level)) {
            header('Location: login.php?form=login');
        } 
    }

    function sudahLogin() {
        $username = @$_SESSION['username'];
        $level = @$_SESSION['level'];

        if (!empty($username) AND !empty($level)) {
            header('Location: index.php');
        } 
    }