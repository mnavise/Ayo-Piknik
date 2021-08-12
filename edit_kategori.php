<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo'<script>window.location="login.php"</script>';
    }
    $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."'");
    if(mysqli_num_rows($kategori)==0){
        echo '<script>window.location="data_kategori.php"</script>';
    }
    $z = mysqli_fetch_object($kategori);
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
              <h3>Edit Data Kategori</h3>
              <div class="box">
                 <form action="" method="POST">
                     <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $z->category_name ?>" required>
                     <input type="submit" name="submit" value="Simpan" class="btn">
                 </form>
                 <?php 
                    if(isset($_POST['submit'])){
                        $nama = ucwords($_POST['nama']);
                        
                        $update = mysqli_query($conn, "UPDATE tb_category SET
                                    category_name = '".$nama."'
                                    WHERE category_id = '".$z->category_id."'");
                               if($update){
                                   echo '<script>alert("Edit Kategori Berhasil")</script>';
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