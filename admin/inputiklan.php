<?php 
// error_reporting(0);
session_start();
include "../koneksi/koneksi.php";
$sesiadmin = $_SESSION['owner']; //sesi login
if(!isset($sesiadmin)){
    header('location:index.php'); //redirect
}
// $admin = mysqli_fetch_array(mysqli_query($conect, "select * from tb_admin where id_admin='$sesiadmin'"));



// $judul = mysqli_real_escape_string($conect, $_POST['judul']); //inputan user
// $isi = mysqli_real_escape_string($conect, $_POST['isi']); //deskripsi
// $kategori = mysqli_real_escape_string($conect, $_POST['kategori']); //kategori


// $foto = $_FILES['gambar']['tmp_name']; //temporary
// $namafoto = $_FILES['gambar']['name']; //nama gambar
// $tgl = date('Y-m-d H:i:s');


// $ext = strtolower(end(explode(".", $namafoto)));
// $namabaru = $judul .'.'. $ext ;
$judul_error = '';
$kategori_error = '';
$isi_error = '';
$gambar_error = '';
$judul = '';
$isi = '';
$kategori = ''; 
$tglmulai = '';
$tglselesai = '';
$tglmulai_error = '';
$tglselesai_error = '';
$link = '';
$link_error = '';


if(isset($_POST['submit'])){

    $admin = mysqli_fetch_array(mysqli_query($conect, "select * from tb_admin where id_admin='$sesiadmin'"));



    $judul = mysqli_real_escape_string($conect, $_POST['judul']); //inputan user
    $isi = mysqli_real_escape_string($conect, $_POST['isi']); //deskripsi
    $tglmulai = mysqli_real_escape_string($conect, $_POST['mulai']); 
    $tglselesai = mysqli_real_escape_string($conect, $_POST['selesai']); 
    $link = mysqli_real_escape_string($conect, $_POST['link']); 
    
    $foto = $_FILES['gambar']['tmp_name']; //temporary
    $namafoto = $_FILES['gambar']['name']; //nama gambar
    $tgl = date('Y-m-d H:i:s');
    
    
    $ext = strtolower(end(explode(".", $namafoto)));
    $namabaru = $judul .'.'. $ext ;

    if($judul == "") {
        $judul_error = "<span style='color :red;'>nama perusahaan wajib diisi</span>";
    }elseif($tglmulai == "") {
        $tglmulai_error = "<span style='color :red;'>tanggal wajib diisi</span>";
    }elseif($tglselesai == "") {
        $tglselesai_error = "<span style='color :red;'>tanggal wajib diisi</span>";
    }elseif($isi == "") {
        $isi_error = "<span style='color :red;'>deskripsi wajib diisi</span>";
    }elseif(empty($foto)) {
        $gambar_error = "<span style='color :red;'>gambar wajib diisi</span>";
    }else{
        //simpan gambar ke dalam folder berita
        move_uploaded_file($foto, '../assets/images/iklan/' . $namabaru);
        //simpan data ke database
        $tgl = date('Y-m-d H:i:s');
        $sql = mysqli_query($conect, "insert into tb_iklan (nm_perusahaan,isi_iklan,id_admin,tgl_mulai,tgl_selesai ,link,gambar,status)
        values ('$judul', '$isi', '$sesiadmin', '$tgl_mulai', '$tgl_selesai', '$link', '$namabaru','Aktif')");
        if($sql) {
            echo"<script>alert('input berhasil'); document.location='iklan.php'</script>";
        } else {
            $gambar_error = "<span style='color:red;'>Terjadi Kesalahan Sistem, silahkan coba lagi</span>";
        }
    }

}
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
        <h1>Tambah iklan</h1>

            <form action="" method="post" enctype="multipart/form-data">
                <table>
                <tr>
                        <td>Judul iklan</td>
                        <td>   
                            <input type="text" name="judul" placeholder="masukan nama perusahaan" class="input" value="<?= $judul;?>" maxlength="60">
                            <?= $judul_error;?>
                        </td>
                    </tr>
                    <tr>
                        <td>tanggal mulai</td>
                        <td>   
                            <input type="date" name="mulai" placeholder="tanggal mulai" class="input" value="<?= $tglmulai;?>">
                            <?= $tglmulai_error;?>
                        </td>
                    </tr>
                    <tr>
                        <td>tanggal selesai</td>
                        <td>   
                            <input type="date" name="selesai" placeholder="tanggal selesai" class="input" value="<?= $tglselesai;?>">
                            <?= $tglselesai_error;?>
                        </td>
                    </tr>
                    <tr>
                        <td>deskripsi iklan</td>
                    <td>
                        <textarea name="isi" rows="4" cols="40" placeholder="isi iklan"><?= $isi;?></textarea>
                        <?= $isi_error;?>
                    </td></tr>
                    <tr>
                        <td>link iklan</td>
                        <td>   
                            <input type="text" name="link" placeholder="link iklan" class="input" value="<?= $link;?>">
                            <?= $link_error;?>
                        </td>
                    </tr>
                    <tr>
                        <td>gambar iklan</td>
                    <td>
                        <input type="file" name="gambar" accept=".jpg, .png, .JPEG, .JPG, .PING">
                        <?= $gambar_error;?>
                    </td></tr>        
                    <tr>
                        <td>&nbsp;</td>
                    <td>       
                        <button type="submit" name="submit" >simpan</a>
                    </td></tr>
                </table>
            </form>

        </div>
        <div class="konten-kanan"> <!-- side bar kanan -->
        
            
        </div>
        <div style="clear:booth"></div>
    </div>
   
    <?php include "../footer.php"; ?>
