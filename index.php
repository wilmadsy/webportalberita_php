<?php 
// error_reporting(0);
session_start();


include "koneksi/koneksi.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Berita</title>
    
    <link rel="stylesheet" href="assets/style.css" type="text/css">
</head>
<body>

<div id="container"> <!-- kerangka web -->

    <?php include "header.php"; ?>

    <div class="konten"> <!-- body web -->
        <div class="konten-kiri"> <!-- side bar left  -->
            <h2>BERITA TERBARU</h2>

         <?php
        $data = mysqli_query($conect, " SELECT * from tb_berita, tb_admin where tb_berita.id_admin=tb_admin.id_admin order by id_berita desc");
        while($row = mysqli_fetch_array($data)){
            ?>
        <div class="feedberita">
        <img src="assets/images/berita/<?= $row['gambar'];?>" alt="<?= $row['judul'];?>"style="width:130px;height:130px;float:left;margin: 10px;">
        <a href=""><h3><?= $row['judul'];?></h3></a>
        <hr>
        <p><?= substr($row['text_berita'],0,234);?>...<a href="">baca selengkapnya</a></p>
        <p>Diposting oleh : <?= $row['nama_lengkap']?> , Tanggal : , <?= $row['tgl_posting'];?></p>
        </div>
        <br>
        <?php } ?>

        </div>
        <div class="konten-kanan"> <!-- side bar kanan -->
        
            <?php
            if(isset($_SESSION['member'])) { //jika sudah login
                $sesiadmin = $_SESSION['member']; //sesi login
                // echo 'aku sudah login :'.$_SESSION['member'];
                $anggota = mysqli_fetch_array(mysqli_query($conect, "select * from tb_anggota where id_anggota='$sesiadmin'"));
                ?>
                <h3>Menu Anggota</h3>
                <ul>
                <li><a href="anggota/ubahbiodata.php">ubah biodata & password</a></li>
                <li><a href="anggota/logout.php">logout</a></li>
                </ul>
            <?php
            }
            ?>

        <hr>
        <h3>ADVERTISING</h3>

        <?php
        $data = mysqli_query($conect, " SELECT * from tb_iklan, tb_admin where tb_iklan.id_admin=tb_admin.id_admin and tb_iklan.status='Aktif' order by id_iklan desc");
        while($row = mysqli_fetch_array($data)){
            ?>
        <img src="assets/images/iklan/<?= $row['gambar'];?>" alt="<?= $row['nm_perusahaan'];?>"style="width:20%; height: 100%;">
        <a href="<?= $row['link'];?>"><h3><?= $row['nm_perusahaan'];?></h3></a>
        <hr>
        <p><?= $row['isi_iklan'];?></p>
        </div>
        <br>
        <?php } ?>






            
        </div>
        <div style="clear:booth"></div>
    </div>
   <?php include "footer.php"; ?>


   </body>
</html>

