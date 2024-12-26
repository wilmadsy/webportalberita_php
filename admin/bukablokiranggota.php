<?php
// error_reporting(0);
session_start();
include "../koneksi/koneksi.php";

$id = mysqli_real_escape_string($conect, $_GET['id']);
$sql = mysqli_query($conect, "update tb_anggota set status='Aktif' where id_anggota='$id'");
if($sql) {
    echo"<script>alert('buka blokir berhasil'); document.location='anggota.php'</script>";
} else {
    echo"<script>alert('buka blokir gagal'); document.location='anggota.php'</script>";
} 
?>