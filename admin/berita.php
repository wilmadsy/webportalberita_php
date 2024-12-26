<?php 
// error_reporting(0);
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
        <h1>BERITA</h1>
        <a href="inputberita.php" title="tambahberita">Tambah Berita </a>
        <!-- menampilkan berita -->
        <table border="1" width="100%">
        <thead>
            <tr>
            <th>judul</th>
            <th>kategori</th>
            <th>deskripsi</th>
            <th>penulis</th>
            <th>tgl posting</th>
            <th>gambar</th>
            <th>actions</th>
        </thead>
        <tbody>
        <?php 
        $sql = mysqli_query($conect, "select * from tb_berita, tb_kategori, tb_admin
        where tb_berita.id_kategori=tb_kategori.id_kategori and tb_berita.id_admin=tb_admin.id_admin");
        while($row=mysqli_fetch_array($sql)){
             ?>
            <tr>
            <td><?= $row['judul'];?></td>
            <td><?= $row['kategori'];?></td>
            <td><?= $row['text_berita'];?></td>
            <td><?= $row['username'];?></td>
            <td><?= $row['tgl_posting'];?></td>
            <td><img src="../assets/images/berita/<?= $row['gambar'];?>" style="width: 100px;px; height: 100px;"></td>
            <td><a href="editberita.php?id=<?= $row['id_berita'];?>" title="Edit">Edit</a> 
            <a href="hapusberita.php?id=<?= $row['id_berita'];?>" title="hapus" onclick="return confirm ('yakin ingin menghapus berita ini !')">hapus</a></td>





            <tr>
        <?php } ?>        
        </tbody>
        </table>
        </div>
        <div class="konten-kanan"> <!-- side bar kanan -->
        
            
        </div>
        <div style="clear:booth"></div>
    </div>
   
    <?php include "../footer.php"; ?>

 