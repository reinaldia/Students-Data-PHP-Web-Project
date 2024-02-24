<?php
    include 'lib/helper.php';

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'db_pwpb20';

    $mysqli = mysqli_connect($host, $user, $pass, $db)
    or die ('Tidak dapat terhubung dengan server');