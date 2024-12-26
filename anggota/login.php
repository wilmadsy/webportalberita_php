<?php 
// error_reporting(0);
session_start();
include "../koneksi/koneksi.php"; 
include '../fungsi/config.php';

$sesiadmin = isset($_SESSION['member']) ? $_SESSION['member'] : ''; //sesi login
if($sesiadmin != ''){ //jika sudah
    header('location:../index.php'); //redirect
}

// $user = $_POST['user']; //inputan email
// $pass = $_POST['pass']; //inputan password
 
// $passmd5 = md5($pass); //pass yg di md5

    $user = '';
    $pass = '';
    $user_error = '';
    $pass_error = '';
    $idanggota = '';
    

if(isset($_POST['submit'])){

    $user = $_POST['user']; //inputan email
    $pass = $_POST['pass']; //inputan password
     
    $passmd5 = md5($pass); //pass yg di md5

    if($user == ""){
        $user_error = "<span style='color :red;'>email wajib diisi</span>";
    }elseif($pass == ""){
        $pass_error = "<span style='color :red;'>password wajib diisi</span>";
    }else{
        $cekadmin = mysqli_query($conect, "SELECT * FROM tb_anggota where email='$user' and password='$passmd5' and status='Aktif'");
        $row = mysqli_fetch_array($cekadmin);
        $idanggota = $row['id_anggota']; // id admin dari tb admin
        $ada = mysqli_num_rows($cekadmin);
        if($ada > 0){
                $_SESSION['webanggota'] = $user;
                $_SESSION['member'] = $idanggota;
                echo "<script>alert('selamat datang! teman di website berita terkini');document.location='../index.php'</script>" ;
        }else{
            $pass_error = "<span style='color :red;'>user & password salah / akun anda di blokir</span>";
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
                <h2>LOGIN ANGGOTA</h2>
                </th></tr>
                 <tr><td>   
                    <input type="text" name="user" placeholder="masukan email" class="input" value="<?= $user;?>">
                    <?= $user_error;?>
                </th></td>
                <tr><td>
                    <input type="password" name="pass" placeholder="masukan password "class="input" value="<?= $pass;?>">
                    <?= $pass_error;?>
                </td><td>    
                <tr>
                    <td>       
                    <button type="submit" name="submit" >LOGIN</a>
                    </td>
                </tr>
                <tr>
                <td>
                <a href="<?php echo $base_url; ?>/anggota/daftar.php" title="Pendaftaran Anggota" style="color:#fff;">Klik Untuk Daftar Anggota Baru</a>
                </td>
            </tr>
            </table>
            </form>
        </div>
        <div class="konten-kanan"> <!-- side bar kanan -->

            
        </div>
        <div style="clear:booth"></div>
    </div>
   
    <?php include "../footer.php"; ?>
 