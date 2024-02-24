<?php
include 'lib/library.php';

cekLogin();

$sql = 'SELECT * FROM t_siswa s INNER JOIN t_kelas k ON (s.id_kelas= k.id_kelas)';

$search = @$_GET['search'];
if (!empty($search)) {
    $sql .=
        " WHERE s.nis LIKE '%$search%' 
            OR s.nama_lengkap LIKE '%$search%'
            OR s.jenis_kelamin LIKE '%$search%'
            OR k.nama_kelas LIKE '%$search%'
            OR s.golongan_darah LIKE '%$search%'
            OR s.nama_ibu_kandung LIKE '%$search%'
            OR k.jurusan LIKE '%$search%'
            OR s.alamat LIKE '%$search%'";
}

$order_field    = @$_GET["sort"];
$order_mode     = @$_GET["order"];

if (!empty($order_field) && !empty($order_mode)) $sql .= " ORDER BY $order_field $order_mode";

$listSiswa = $mysqli->query($sql);

include 'views/v_index.php';
