<?php
// error_reporting(0);
session_start();
include "../koneksi/koneksi.php";

$id = mysqli_real_escape_string($conect, $_GET['id']);
$sql = mysqli_query($conect, "update tb_anggota set status='tidak aktif' where id_anggota='$id'");
if($sql) {
    echo"<script>alert('blokir berhasil'); document.location='anggota.php'</script>";
} else {
    echo"<script>alert('blokir gagal'); document.location='anggota.php'</script>";
} 
?>