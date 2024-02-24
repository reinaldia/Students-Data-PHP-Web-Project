<?php
include 'lib/library.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis = $_GET['nis'];

    $sql = "DELETE FROM t_siswa WHERE nis = '$nis' ";
    $mysqli->query($sql) or die($mysqli->error);
    
    if ($mysqli->query($sql)) {
        echo 1;
    } else {
        echo 0;
    }


    header('Location: index.php');
}
