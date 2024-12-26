<?php
// error_reporting(0);
session_start();
include "../koneksi/koneksi.php";

$id = mysqli_real_escape_string($conect, $_GET['id']);
$ceknama = mysqli_fetch_array(mysqli_query($conect, "select * from tb_iklan where id_iklan='$id'"));
$namagambar = $ceknama['gambar'];

unlink('../assets/images/iklan/' . $namagambar);
$sql = mysqli_query($conect, "delete from tb_iklan where id_iklan='$id'"); //hapus dari 
if($sql) {
        echo"<script>alert('hapus berhasil'); document.location='iklan.php'</script>";
    } else {
        echo"<script>alert('hapus gagal'); document.location='iklan.php'</script>";
    }