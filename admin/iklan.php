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
        <h1>IKLAN</h1>
        <a href="inputiklan.php" title="tambah iklan">Tambah iklan </a>
        <!-- menampilkan berita -->
        <table border="1" width="100%">
        <thead>
            <tr>
            <th>nama perusahaan</th>
            <th>tanggal iklan</th>
            <th>deskripsi</th>
            <th>link</th>
            <th>status</th>
            <th>gambar</th>
            <th>actions</th>
        </thead>
        <tbody>
        <?php 
        $sql = mysqli_query($conect, "select * from tb_iklan, tb_admin
        where tb_iklan .id_admin=tb_admin.id_admin");
        while($row=mysqli_fetch_array($sql)){
             ?>
            <tr>
            <td><?= $row['nm_perusahaan'];?></td>
            <td><?= $row['tgl_mulai'];?> - <?= $row['tgl_selesai'];?></td>
            <td><?= $row['isi_iklan'];?></td>
            <td><?= $row['link'];?></td>
            <td><?= $row['status'];?></td>
            <td><img src="../assets/images/iklan/<?= $row['gambar'];?>" style="width: 100px;px; height: 100px;"></td>
            <td><a href="editiklan.php?id=<?= $row['id_iklan'];?>" title="Edit">Edit</a> 
            <a href="hapusiklan.php?id=<?= $row['id_iklan'];?>" title="hapus" onclick="return confirm ('yakin ingin menghapus iklan ini !')">hapus</a></td>

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

 