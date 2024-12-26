<?php 
error_reporting(0);
session_start();
include "../koneksi/koneksi.php";

$sesiadmin = $_SESSION['owner']; //sesi login
if(isset($sesiadmin)){ //jika sudah
    header('location:home.php'); //redirect
}

$user = $_POST['user']; //inputan user
$pass = $_POST['pass']; //inputan password
 
$passmd5 = md5($pass); //pass yg di md5

if(isset($_POST['submit'])){
    if($user == ""){
        $user_error = "<span style='color :red;'>User wajib diisi</span>";
    }elseif($pass == ""){
        $pass_error = "<span style='color :red;'>password wajib diisi</span>";
    }else{
        $cekadmin = mysqli_query($conect, "SELECT * FROM tb_admin where username='$user' and password='$passmd5'");
        $row = mysqli_fetch_array($cekadmin);
        $idadmin = $row['id_admin'];
        $ada = mysqli_num_rows($cekadmin);
        if($ada > 0){
                $_SESSION['webberita'] = $user;
                $_SESSION['owner'] = $idadmin;
                echo "<script>alert('selamat datang!');document.location='home.php'</script>" ;
        }else{
            $pass_error = "<span style='color :red;'>user & password salah</span>";
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
                <h2>LOGIN ADMIN</h2>
                </th></tr>
                 <tr><td>   
                    <input type="text" name="user" placeholder="masukan user admin" class="input" value="<?= $user;?>">
                    <?= $user_error;?>
                </th></td>
                <tr><td>
                    <input type="password" name="pass" placeholder="masukan password admin"class="input" value="<?= $pass;?>">
                    <?= $pass_error;?>
                </td><td>    
                <tr><td>       
                    <button type="submit" name="submit" >LOGIN</a>
                </td></tr>
            </table>
            </form>

        </div>
        <div class="konten-kanan"> <!-- side bar kanan -->

            
        </div>
        <div style="clear:booth"></div>
    </div>
   
    <?php include "footer.php"; ?>
