<?php 
error_reporting(0);
session_start();
include "../koneksi/koneksi.php";
$sesiadmin = $_SESSION['owner']; //sesi login
if(!isset($sesiadmin)){
    header('location:index.php'); //redirect
}
$admin = mysqli_fetch_array(mysqli_query($conect, "select * from tb_admin where id_admin='$sesiadmin'"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Berita</title>

<link rel="stylesheet" href="../assets/style.css" type="text/css">

</head>
<body>

<div id="container"> <!-- kerangka web -->

<div class="header"> <!-- header web -->
        <h1>Admin - web Berita</h1>
        <P>berita terkini dan terupdate dikalangan kita</P>        
    </div>
    <div class="menu"> <!-- bagian menu -->
    <?php include "menu.php"; ?>

    </div>

    <div class="konten"> <!-- body web -->
        <div class="konten-kiri"> <!-- side bar kiri -->
        <h1>Selmat datang! <?= $admin['nama_lengkap']; ?> [<?= $admin['username']; ?>] diruang admin</h1>
        </div>
        <div class="konten-kanan"> <!-- side bar kanan -->
        
            
        </div>
        <div style="clear:booth"></div>
    </div>
   
    <?php include "footer.php"; ?>
