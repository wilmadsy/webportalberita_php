<?php
// error_reporting(0);
session_start();
include "../koneksi/koneksi.php";

$id = mysqli_real_escape_string($conect, $_GET['id']);
$sql = mysqli_query($conect, "delete from tb_anggota where id_anggota='$id'"); //hapus dari 
if($sql) {
        echo"<script>alert('hapus berhasil'); document.location='anggota.php'</script>";
    } else {
        echo"<script>alert('hapus gagal'); document.location='anggota.php'</script>";
    }