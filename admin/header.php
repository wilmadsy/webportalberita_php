<div class="header"> <!-- header web -->
        <h1>web Berita</h1>
        <P>berita terkini dan terupdate dikalangan kita</P>
    </div>
    <div class="menu"> <!-- bagian menu -->
    <ul>
        <li><a href="index.php" title="home">beranda</a></li>
        <li><a href="" title="home">berita</a></li>
        <li><a href="" title="home">kontak kami</a></li>
            <?php
            // $sesiadmin = $_SESSION['member']; //sesi login
            if(isset($_SESSION['member'])) { //jika sudah login
                $sesiadmin = $_SESSION['member']; //sesi login
                $anggota = mysqli_fetch_array(mysqli_query($conect, "select * from tb_anggota where id_anggota='$sesiadmin'"));
                ?>
                <li><a href="#">login : <?= $anggota['nama'];?></a></li>
            <?php
            }else{
                ?>
                <li><a href="anggota/index.php" title="Login Anggota">login anggota</a></li>
                <?php
            }
            ?>
    </ul>
    </div>