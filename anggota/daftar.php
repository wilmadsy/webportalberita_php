<?php 
// error_reporting(0);
session_start();
include "../koneksi/koneksi.php";

// $sesiadmin = $_SESSION['member']; //sesi login
$sesiadmin = isset($_SESSION['member']) ? $_SESSION['member'] : ''; //sesi login
if($sesiadmin != ''){ //jika sudah
    header('location:home.php'); //redirect
}

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
    }elseif($pass == ""){
        $pass_error = "<span style='color :red;'>password wajib diisi</span>";
    }else {
        $cekemail = mysqli_query($conect, "SELECT * FROM tb_anggota where email='$email'");
        $ada = mysqli_num_rows($cekemail);
        if($ada > 0) {
            $email_error = "<span style='color :red;'>email sudah terdaftar</span>";
        }else {
            $sql = mysqli_query($conect, "insert into tb_anggota (nama,email,password,status) values 
            ('$nama', '$email', '$passmd5', 'Aktif')");
            if ($sql) {
                echo "<script>alert('selamat datang! anda berhasil menjadi anggota silahkan login');document.location='../index.php'</script>" ;
            } else {
                echo "<script>alert('anda gagal mendaftar anggota silahkan coba lagi');document.location='../index.php'</script>" ;
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
                <h2>DAFTAR ANGGOTA</h2>
                </th></tr>
                <tr><td>   
                    <input type="text" name="nama" placeholder="masukan nama lengkap" class="input" value="<?= $nama;?>" maxlength="60">
                    <?= $nama_error;?>
                </th></td>
                 <tr><td>   
                    <input type="text" name="email" placeholder="masukan email" class="input" value="<?= $email;?>" maxlength="60">
                    <?= $email_error;?>
                </th></td>
                <tr><td>
                    <input type="password" name="pass" placeholder="masukan password "class="input" value="<?= $pass;?>" maxlength="15">
                    <?= $pass_error;?>
                </td><td>    
                <tr>
                    <td>       
                    <button type="submit" name="submit" >DAFTAR</a>
                    </td>
                </tr>
                <!-- <tr>
                <td>
                <a href="anggota/index.php" title="login" style="color:#fff;">Klik Untuk login anggota</a>
                </td> -->
            </tr>
            </table>
            </form>
        </div>
        <div class="konten-kanan"> <!-- side bar kanan -->

            
        </div>
        <div style="clear:booth"></div>
    </div>
   
    <?php include "../footer.php"; ?>
