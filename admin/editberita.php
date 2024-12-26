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
    $b = mysqli_fetch_array(mysqli_query($conect, "select * from tb_berita where id_berita='$id'"));

    // print_r($b);

    $judul = mysqli_real_escape_string($conect, $b['judul']); //inputan user
    $isi =  $b['text_berita']; //deskripsi
    $kategori = $b['id_kategori']; //kategori
    $gambarlama = $b['gambar']; //nama gambar lama

$judul_error = '';
$kategori_error = '';
$gambar_error = '';
$isi_error = '';


    // $foto = $_FILES['gambar']['tmp_name']; //temporary
    // $namafoto = $_FILES['gambar']['name']; //nama gambar
    // $tgl = date('Y-m-d H:i:s');


    // $ext = strtolower(end(explode(".", $namafoto)));
    // $namabaru = $judul .'.'. $ext ;
}

if(isset($_POST['submit'])){

$admin = mysqli_fetch_array(mysqli_query($conect, "select * from tb_admin where id_admin='$sesiadmin'"));

$id = mysqli_real_escape_string($conect, $_GET['id']);
$b = mysqli_fetch_array(mysqli_query($conect, "select * from tb_berita where id_berita='$id'"));

$judul = mysqli_real_escape_string($conect, $_POST['judul']); //inputan user
$isi = mysqli_real_escape_string($conect, $_POST['isi']); //deskripsi
$kategori = mysqli_real_escape_string($conect, $_POST['kategori']); //kategori
$gambarlama = mysqli_real_escape_string($conect, $_POST['gambar lama']); //nama gambar lama



$foto = $_FILES['gambar']['tmp_name']; //temporary
$namafoto = $_FILES['gambar']['name']; //nama gambar
$tgl = date('Y-m-d H:i:s');


$ext = strtolower(end(explode(".", $namafoto)));
$namabaru = $judul .'.'. $ext ;


    if($judul == "") {
        $judul_error = "<span style='color :red;'>judul wajib diisi</span>";
    }elseif($kategori == "") {
        $kategori_error = "<span style='color :red;'>kategori wajib diisi</span>";
    }elseif($isi == "") {
        $isi_error = "<span style='color :red;'>deskripsi wajib diisi</span>";
    }else{
        if (empty($foto)) { //kalau fotonya tidak di ganti
            $sql = mysqli_query($conect, "update tb_berita set judul= '$judul', text_berita='$isi', id_kategori='$kategori' where id_berita='$id'");
            if($sql) {
                echo"<script>alert('edit berhasil'); document.location='berita.php'</script>";
            } else {
                $gambar_error = "<span style='color:red;'>Terjadi Kesalahan Sistem, silahkan coba lagi</span>";
            }  
        } else {
            unlink('../assets/images/berita/' . $gambarlama);
                //simpan gambar ke dalam folder berita
            move_uploaded_file($foto, '../assets/images/berita/' . $namabaru);
            //simpan data ke database 
            $sql = mysqli_query($conect, "update tb_berita set judul= '$judul', text_berita='$isi', id_kategori='$kategori', gambar='$namabaru' where id_berita='$id'");
           
            if($sql) {
                echo"<script>alert('edit berhasil'); document.location='berita.php'</script>";
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
        <h1>Edit Berita</h1>

            <form action="" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Judul Berita</td>
                        <td>   
                            <input type="text" name="judul" placeholder="masukan judul" class="input" value="<?= $b['judul'];?>">
                            <?= $judul_error;?>
                        </td> 
                    </tr>
                <tr>
                    <td>kategori berita</td>   
                <td>
                    <select name="kategori">
                    <option value="">-- Pilih kategori --</option>
                    <?php
                            $sql = mysqli_query($conect, "select * from tb_kategori");
                            while ($row= mysqli_fetch_array($sql)) {
                            if ($row['id_kategori'] == $b['id_kategori']) {
                    ?>        
                        <option value="<?= $row['id_kategori'];?>" selected="selected"><?= $row['kategori'];?></option>
                        <?php  } else {
                            ?>
                            <option value="<?= $row['id_kategori'];?>"><?= $row['kategori'];?></option>
                        <?php    
                        }
                        } ?>
                    </select>
                        <?= $kategori_error;?>
                        </td></tr>
                    <tr>
                        <td>deskripsi Berita</td>
                    <td>
                        <textarea name="isi" rows="4" cols="40" placeholder="isi berita"><?= $b['text_berita'];?></textarea>
                        <?= $isi_error;?>
                    </td></tr>
                    <tr>
                        <td>sampul Berita</td>
                    <td>
                        <input type="file" name="gambar" accept=".jpg, .png, .JPEG, .JPG, .PING">
                        <?= $gambar_error;?>
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
