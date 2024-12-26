<?php 
// error_reporting(0);
session_start();
include "../koneksi/koneksi.php";
$sesiadmin = $_SESSION['owner']; //sesi login
if(!isset($sesiadmin)){
    header('location:index.php'); //redirect
}

$admin = mysqli_fetch_array(mysqli_query($conect, "select * from tb_admin where id_admin='$sesiadmin'"));

$id = mysqli_real_escape_string($conect, $_GET['id']);
// echo "id = " . $id;

if (!isset($_POST['submit'])) {
    $b = mysqli_fetch_array(mysqli_query($conect, "select * from tb_iklan where id_iklan='$id'"));

    // print_r($b);

    $judul = mysqli_real_escape_string($conect, $b['nm_perusahaan']); //inputan user
    $isi =  $b['isi_iklan']; //deskripsi
    $tglmulai = $b['tgl_mulai']; //kategori
    $tglselesai = $b['tgl_selesai']; //kategori
    $link =  $b['link']; //deskripsi
    $gambarlama = $b['gambar']; //nama gambar lama

$judul_error = '';
$kategori_error = '';
$gambar_error = '';
$isi_error = '';
$tglmulai_error = '';
$tglselesai_error = '';
$link_error = '';


    // $foto = $_FILES['gambar']['tmp_name']; //temporary
    // $namafoto = $_FILES['gambar']['name']; //nama gambar
    // $tgl = date('Y-m-d H:i:s');


    // $ext = strtolower(end(explode(".", $namafoto)));
    // $namabaru = $judul .'.'. $ext ;
}

if(isset($_POST['submit'])){

$admin = mysqli_fetch_array(mysqli_query($conect, "select * from tb_admin where id_admin='$sesiadmin'"));

$id = mysqli_real_escape_string($conect, $_GET['id']);
$b = mysqli_fetch_array(mysqli_query($conect, "select * from tb_iklan where id_iklan='$id'"));

$judul = mysqli_real_escape_string($conect, $_POST['judul']); //inputan user
$isi = mysqli_real_escape_string($conect, $_POST['isi']); //deskripsi
$tglmulai = mysqli_real_escape_string($conect, $_POST['mulai']); 
$tglselesai = mysqli_real_escape_string($conect, $_POST['selesai']); 
$link = mysqli_real_escape_string($conect, $_POST['link']); 
$status = mysqli_real_escape_string($conect, $_POST['status']); 
$gambarlama = mysqli_real_escape_string($conect, $_POST['gambarlama']); //nama gambar lama



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
}else{
        if (empty($foto)) { //kalau fotonya tidak di ganti
            $sql = mysqli_query($conect, "update tb_iklan set nm_perusahaan='$judul', isi_iklan='$isi', tgl_mulai='$tglmulai', tgl_selesai='$tglselesai', link='$link', status='$status' where id_iklan='$id'");
            if($sql) {
                echo"<script>alert('edit berhasil'); document.location='iklan.php'</script>";
            } else {
                $gambar_error = "<span style='color:red;'>Terjadi Kesalahan Sistem, silahkan coba lagi</span>";
            }  
        } else {
            unlink('../assets/images/iklan/' . $gambarlama);
                //simpan gambar ke dalam folder iklan
            move_uploaded_file($foto, '../assets/images/iklan/' . $namabaru);
            //simpan data ke database 
            $sql = mysqli_query($conect, "update tb_iklan set nm_perusahaan='$judul', gambar='$namabaru', isi_iklan='$isi', tgl_mulai='$tglmulai', tgl_selesai='$tglselesai', link='$link', status='$status' where id_iklan='$id'");
            if($sql) {
                echo"<script>alert('edit berhasil'); document.location='iklan.php'</script>";
            } else {
                $gambar_error = "<span style='color:red;'>Terjadi Kesalahan Sistem, silahkan coba lagi</span>";
            }  
        }
        
    }

} else {

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
        <h1>Edit iklan</h1>

            <form action="" method="post" enctype="multipart/form-data">
                <table>
                <tr>
                        <td>Judul iklan</td>
                        <td>   
                            <input type="text" name="judul" placeholder="masukan nama perusahaan" class="input" value="<?=$b['nm_perusahaan'];?>" maxlength="60">
                            <?= $judul_error;?>
                        </td>
                    </tr>
                    <tr>
                        <td>tanggal mulai</td>
                        <td>   
                            <input type="date" name="mulai" placeholder="tanggal mulai" class="input" value="<?= $b['tgl_mulai'];?>">
                            <?= $tglmulai_error;?>
                        </td>
                    </tr>
                    <tr>
                        <td>tanggal selesai</td>
                        <td>   
                            <input type="date" name="selesai" placeholder="tanggal selesai" class="input" value="<?= $b['tgl_selesai'];?>">
                            <?= $tglselesai_error;?>
                        </td>
                    </tr>
                    <tr>
                        <td>deskripsi iklan</td>
                    <td>
                        <textarea name="isi" rows="4" cols="40" placeholder="isi iklan"><?= $b['isi_iklan'];?></textarea>
                        <?= $isi_error;?>
                    </td></tr>
                    <tr>
                        <td>link iklan</td>
                        <td>   
                            <input type="text" name="link" placeholder="link iklan" class="input" value="<?= $b['link'];?>">
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
                        <td>status iklan</td>
                    <td>
                        <select name="status">
                            <option value="Aktif">Aktif</option> 
                            <option value="Tidak Aktif">Tidak Aktif</option> 
                        </select>
                    </td></tr>                
                    <tr>
                        <td>&nbsp;</td>
                    <td>       
                        <input type="hidden" name="gambarlama" value="<?= $b['gambar'];?>">
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
