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
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
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
              <h3>Tambah Data Produk</h3>
              <div class="box">
                 <form action="" method="POST" enctype="multipart/form-data">
                     <select class="input-control" name="kategori" required>
                         <option value="">---Pilih---</option>
                         <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                     </select>
                     <input type="text" name="nama" placeholder="Nama Tempat Wisata" class="input-control" required>
                     <input type="text" name="harga" placeholder="Harga Tiket Wisata" class="input-control" required>
                     <input type="file" name="gambar" class="input-control" required>
                     <textarea class="input-control" name="deskripsi" placeholder="Deskripsi Tempat Wisata"></textarea><br>
                     <select class="input-control" name="status">
                         <option value="">--Status Tempat--</option>
                         <option value="1">Aktif</option>
                         <option value="0">Tidak Aktif</option>
                     </select>
                     <input type="submit" name="submit" value="Simpan" class="btn">
                 </form>
                 <?php 
                    if(isset($_POST['submit'])){    
                        //menampum inputan dari form
                        $kategori   = $_POST ['kategori'];
                        $nama       = $_POST ['nama'];
                        $harga      = $_POST ['harga'];
                        $deskripsi  = $_POST ['deskripsi'];
                        $status     = $_POST ['status'];

                        //menampung data file yg di upload
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'EVENT'.time().'.'.$type2;

                        //menampung data format file yang izinkan
                        $tipe = array('jpg','jpeg','png');

                        //validasi Format file
                        if(!in_array($type2, $tipe)){
                            echo '<script> alert("Format Gambar Ditolak")</script>';
                        }else{
                            move_uploaded_file($tmp_name, './assets/Produk/'.$newname);
                            $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                    null,
                                    '".$kategori."',
                                    '".$nama."',
                                    '".$harga."',
                                    '".$deskripsi."',
                                    '".$newname."',
                                    '".$status."',
                                    null        )");
                                if ($insert){
                                    echo '<script>alert("Data Tempat Wisata berhasil Ditambahkan")</script>';
                                    echo '<script>window.location = "data_produk.php"</script>';
                                }else{
                                    echo 'gagal'.mysqli_error($conn);
                                }

                        }
                        //proses upload file beserta insert data ke database
                    }
                    ?>
              </div>
          </div>
      </div>

      <!-- Footer -->
      <div class="container">
          <small>Copyright &copy; 2021 - Ayo Piknik.</small>
      </div>
        <script>
            CKEDITOR.replace( 'deskripsi' );
        </script>
  </body>
</html>