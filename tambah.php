<?php
include 'lib/library.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis                = @$_POST['nis'];
    $nama_lengkap       = @$_POST['nama_lengkap'];
    $jenis_kelamin      = @$_POST['jenis_kelamin'];
    $kelas              = @$_POST['kelas'];
    $golongan_darah     = @$_POST['golongan_darah'];
    $nama_ibu_kandung   = @$_POST['nama_ibu_kandung'];
    $alamat             = @$_POST['alamat'];
    $foto               = @$_FILES['foto'];

    if (empty($nis)) {
        flash('error', 'Mohon masukkan NIS dengan benar');
    } else if (empty($nama_lengkap)) {
        flash('error', 'Mohon masukkan nama lengkap dengan benar');
    } else if (empty($jenis_kelamin)) {
        flash('error', 'Mohon pilih jenis kelamin dengan benar');
    } else if (empty($kelas)) {
        flash('error', 'Mohon pilih kelas dengan benar');
    } else if (empty($golongan_darah)) {
        flash('error', 'Mohon pilih golongan darah dengan benar');
    } else if (empty($nama_ibu_kandung)) {
        flash('error', 'Mohon masukkan nama ibu kandung dengan benar');
    } else if (empty($alamat)) {
        flash('error', 'Mohon masukkan alamat dengan benar');
    } else {

        if (!empty($foto) and $foto['error'] == 0) {
            $path   = './assets/images/';
            $fotoname = $_FILES['foto']['name'];
            $upload = move_uploaded_file($foto['tmp_name'], $path . $fotoname);

            if (!$upload) {
                flash('error', "Upload file gagal");
                header('Location: index.php');
            }
            $file = $fotoname;
        } else {
            $file = '';
        }

        $sql = "INSERT INTO t_siswa (nis, nama_lengkap, jenis_kelamin, id_kelas, golongan_darah, nama_ibu_kandung, alamat, file)
                VALUES ('$nis', '$nama_lengkap', '$jenis_kelamin', '$kelas', '$golongan_darah', '$nama_ibu_kandung', '$alamat', '$file')";

        $mysqli->query($sql) or die($mysqli->error);

        flash('success', 'Data '. $nama_lengkap .' berhasil disimpan!');
    }
}

$success = flash('success');
$error = flash('error');

$sqlKelas = "SELECT * FROM t_kelas";
$dataKelas = $mysqli->query($sqlKelas) or die($mysqli->error);

include 'views/v_form.php';