<?php
// error_reporting(0);
session_start();
include "../koneksi/koneksi.php";

$id = mysqli_real_escape_string($conect, $_GET['id']);
$ceknama = mysqli_fetch_array(mysqli_query($conect, "select * from tb_berita where id_berita='$id'"));
$namagambar = $ceknama['gambar'];

unlink('../assets/images/berita/' . $namagambar);
$sql = mysqli_query($conect, "delete from tb_berita where id_berita='$id'"); //hapus dari 
if($sql) {
        echo"<script>alert('hapus berhasil'); document.location='berita.php'</script>";
    } else {
        echo"<script>alert('hapus gagal'); document.location='berita.php'</script>";
    };