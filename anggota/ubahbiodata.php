<?php 
// error_reporting(0);
session_start();
include "../koneksi/koneksi.php";

// $sesiadmin = $_SESSION['member']; //sesi login
$sesiadmin = isset($_SESSION['member']) ? $_SESSION['member'] : ''; //sesi login
if(!isset($sesiadmin)){
    header('location:index.php'); //redirect
}
$anggota = mysqli_fetch_array(mysqli_query($conect, "select * from tb_anggota where id_anggota='$sesiadmin'"));

// if (isset($_POST['user'])) $user = mysqli_real_escape_string($conect, $_POST['user']); //inputan email
// if (isset($_POST['pass'])) $pass = mysqli_real_escape_string($_POST['pass']); //inputan password
// if (isset($_POST['nama'])) $nama = mysqli_real_escape_string($_POST['nama']); //inputan password

// $passmd5 = md5($pass); //pass yg di md5
    $nama_error = '';
    $email_error = '';
    $pass_error = '';
    $email = '';
    $pass = '';
    $nama = '';

if(isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conect, $_POST['email']); //inputan email
    $pass = mysqli_real_escape_string($conect, $_POST['pass']); //inputan password
    $nama = mysqli_real_escape_string($conect, $_POST['nama']); //inputan password

    $passmd5 = md5($pass); //pass yg di md5

    if($nama == ""){
        $nama_error = "<span style='color :red;'>nama wajib diisi</span>";
    }elseif($email == ""){
        $email_error = "<span style='color :red;'>email wajib diisi</span>";
    }else {
        if (empty($pass)) {
            $sql = mysqli_query($conect, "update tb_anggota set nama='$nama' where id_anggota='$sesiadmin'" );
            if ($sql) {
                echo "<script>alert('update berhasil');document.location='ubahbiodata.php'</script>" ;
            } else {
                echo "<script>alert('anda gagal mendaftar anggota silahkan coba lagi');document.location='ubahbiodata.php'</script>" ;
            }  
        } else {
            $sql = mysqli_query($conect, "update tb_anggota set nama='$nama', password='$passmd5' where id_anggota='$sesiadmin'" );
            if ($sql) {
                echo "<script>alert('update berhasil');document.location='ubahbiodata.php'</script>" ;
            } else {
                echo "<script>alert('anda gagal mendaftar anggota silahkan coba lagi');document.location='ubahbiodata.php'</script>" ;
            }  
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

<?php include "../header.php"; ?>

    <div class="konten"> <!-- body web -->
        <div class="konten-kiri"> <!-- side bar left  -->
            <form action="" method="post">
                <table class="login">
                <tr><th>
                <h2>BIODATA ANGGOTA</h2>
                </th></tr>
                <tr><td>   
                    <input type="text" name="nama" placeholder="masukan nama lengkap" class="input" value="<?= $anggota['nama'];?>" maxlength="60">
                    <?= $nama_error;?>
                </th></td>
                 <tr><td>   
                    <input type="text" name="email" placeholder="masukan email" class="input" value="<?= $anggota['email'];?>" maxlength="60" readonly=readonly >
                    <?= $email_error;?>
                </th></td>
                <tr><td>
                    <input type="password" name="pass" placeholder="masukan password "class="input" value="<?= $pass;?>" maxlength="15">
                    <?= $pass_error;?>
                </td><td>    
                <tr>
                    <td>       
                    <button type="submit" name="submit" >UPDATE BIODATA</a>
                    </td>
                </tr>
        
            </table>
            </form>
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
                <li><a href="ubahbiodata.php">ubah biodata & password</a></li>
                <li><a href="logout.php">logout</a></li>
                </ul>
            <?php
            }
            ?>
            
        </div>
        <div style="clear:booth"></div>
    </div>
   
    <?php include "../footer.php"; ?>
