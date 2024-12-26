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

if(isset($_POST['submit'])){

    $admin = mysqli_fetch_array(mysqli_query($conect, "select * from tb_admin where id_admin='$sesiadmin'"));



    $judul = mysqli_real_escape_string($conect, $_POST['judul']); //inputan user
    $isi = mysqli_real_escape_string($conect, $_POST['isi']); //deskripsi
    $kategori = mysqli_real_escape_string($conect, $_POST['kategori']); //kategori
    
    
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
    }elseif(empty($foto)) {
        $gambar_error = "<span style='color :red;'>gambar wajib diisi</span>";
    }else{
        //simpan gambar ke dalam folder berita
        move_uploaded_file($foto, '../assets/images/berita/' . $namabaru);
        //simpan data ke database
        $tgl = date('Y-m-d H:i:s');
        $sql = mysqli_query($conect, "insert into tb_berita (judul,text_berita,id_admin,id_kategori,tgl_posting,dilihat,gambar)
        values ('$judul', '$isi', '$sesiadmin', '$kategori', '$tgl', '1', '$namabaru')");
        if($sql) {
            echo"<script>alert('input berhasil'); document.location='berita.php'</script>";
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
        <h1>Tambah Berita</h1>

            <form action="" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Judul Berita</td>
                        <td>   
                            <input type="text" name="judul" placeholder="masukan judul" class="input" value="<?= $judul;?>">
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
                            if ($row['id_kategori'] == $kategori) {
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
                        <textarea name="isi" rows="4" cols="40" placeholder="isi berita"><?= $isi;?></textarea>
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
