<?php
include 'lib/library.php';

$nis = $_GET['nis'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nis                = $_POST['nis'];
    $nama_lengkap       = $_POST['nama_lengkap'];
    $jenis_kelamin      = $_POST['jenis_kelamin'];
    $kelas              = $_POST['kelas'];
    $golongan_darah     = $_POST['golongan_darah'];
    $nama_ibu_kandung   = $_POST['nama_ibu_kandung'];
    $alamat             = $_POST['alamat'];
    $file               = $_POST['foto_lama'];

    $foto               = $_FILES['foto'];

    if (!empty($foto['name'])) {
        $path   = './assets/images/';
        $fotoname = $_FILES['foto']['name'];
        $upload = move_uploaded_file($foto['tmp_name'], $path . $foto['name']);

        if (!$upload) {
            flash('error', "Upload file gagal");
            header('Location: index.php');
        }
        $file = $fotoname;
    }

    $sql = "UPDATE t_siswa SET 
    nama_lengkap = '$nama_lengkap', 
    jenis_kelamin = '$jenis_kelamin',
    id_kelas = '$kelas', 
    golongan_darah = '$golongan_darah',
    nama_ibu_kandung = '$nama_ibu_kandung',
    alamat = '$alamat',
    file = '$file'
    WHERE nis = '$nis' ";

    $mysqli->query($sql) or die ($mysqli->error);

    header('Location: index.php');
    exit();
}

if(empty($nis)) header('Location: index.php');

$sqlKelas = "SELECT * FROM t_kelas";
$dataKelas = $mysqli->query($sqlKelas) or die;

$sql = "SELECT * FROM t_siswa WHERE nis = '$nis'";
$query = $mysqli->query($sql);
$siswa = $query->fetch_array();

if (empty($siswa)) header('Location: index.php');

include 'views/v_form.php';
?>
