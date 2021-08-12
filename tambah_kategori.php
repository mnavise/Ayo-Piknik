<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo'<script>window.location="login.php"</script>';
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <title>Dapatkan Destinasi Wisata Terbaik Kamu di AyoPiknik!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  </head>
  <body>
      <!-- header -->
      <header>
          <div class="container">
            <h1><a href="dashboard.php"> <img src="assets/logo.svg" alt="Beranda" width="200" height="50" /></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profile</a></li>
                <li><a href="data_kategori.php">Data Kategori</a></li>
                <li><a href="data_produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
          </div>
      </header>
      
      <!-- content -->
      <div class="section">
          <div class="container">
              <h3>Tambah Data Kategori</h3>
              <div class="box">
                 <form action="" method="POST">
                     <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>
                     <input type="submit" name="submit" value="Simpan" class="btn">
                 </form>
                 <?php 
                    if(isset($_POST['submit'])){
                        $nama = ucwords($_POST['nama']);

                        $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
                                    null,
                                    '".$nama."')");
                               if($insert){
                                   echo '<script>alert("Tambah Kategori Berhasil")</script>';
                                   echo '<script>window.location="data_kategori.php"</script>';
                               }else{
                                   echo 'Gagal'.mysqli_error($conn);
                               }     
                    }
                    ?>
              </div>
          </div>
      </div>

      <!-- Footer -->
      <div class="container">
          <small>Copyright &copy; 2021 - Ayo Piknik.</small>
      </div>
  </body>
</html>