<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo'<script>window.location="login.php"</script>';
    }
    $produk = mysqli_query($conn,"SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."'");
    if (mysqli_num_rows($produk)==0){
        echo '<script>window.location="data_produk.php"</script>';
    }
    $p = mysqli_fetch_object ($produk);
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
            <h1><a href="dashboard.php">Ayo Piknik</h1>
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
              <h3>Edit Data Produk</h3>
              <div class="box">
                 <form action="" method="POST" enctype="multipart/form-data">
                     <select class="input-control" name="kategori" required>
                         <option value="">---Pilih---</option>
                         <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id']== $p->category_id)?'selected' : ''; ?> ><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                     </select>
                     <input type="text" name="nama" placeholder="Nama Tempat Wisata" class="input-control" value="<?php echo $p->product_name ?>" required>
                     <input type="text" name="harga" placeholder="Harga Tiket Wisata" class="input-control" value="<?php echo $p->product_price ?>"required>
                     
                     <img src="assets/Produk/<?php echo $p->product_image ?>" width="150px">
                     <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                     <input type="file" name="gambar" class="input-control">
                     <textarea class="input-control" name="deskripsi" placeholder="Deskripsi Tempat Wisata"><?php echo $p->product_description ?></textarea><br>
                     <select class="input-control" name="status">
                         <option value="">--Status Tempat--</option>
                         <option value="1" <?php echo ($p->product_status ==1)?'selected':''; ?>>Aktif</option>
                         <option value="0" <?php echo ($p->product_status ==0)?'selected':''; ?>>Tidak Aktif</option>
                     </select>
                     <input type="submit" name="submit" value="Simpan" class="btn">
                 </form>
                 <?php 
                    if(isset($_POST['submit'])){    
                        //data masukan dari form
                        $kategori   = $_POST ['kategori'];
                        $nama       = $_POST ['nama'];
                        $harga      = $_POST ['harga'];
                        $deskripsi  = $_POST ['deskripsi'];
                        $status     = $_POST ['status'];
                        $foto       = $_POST ['foto'];


                        // data pembaruan gambar
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        

                        if($filename !=''){
                            $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'EVENT'.time().'.'.$type2;
                        //menampung data format file yang izinkan
                        $tipe = array('jpg','jpeg','png');
                            if(!in_array($type2, $tipe)){
                                echo '<script> alert("Format Gambar Ditolak")</script>';
                        }else{
                            unlink('/assets/Produk/'.$foto);
                            move_uploaded_file($tmp_name, './assets/Produk/'.$newname);
                            $namagambar=$newname;

                        }
                    }else{
                        $namagambar = $foto;

                    }
                    $update = mysqli_query($conn, "UPDATE tb_product SET
                                category_id = '".$kategori."',
                                product_name = '".$nama."',
                                product_price = '".$harga."',
                                product_description = '".$deskripsi."',
                                product_image = '".$namagambar."',
                                product_status = '".$status."'
                                WHERE product_id = '".$p->product_id."'");
                     if ($update){
                            echo '<script>alert("Data Tempat Wisata berhasil Diperbarui")</script>';
                            echo '<script>window.location = "data_produk.php"</script>';
                            }else{
                            echo 'gagal'.mysqli_error($conn);
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
        <script>
            CKEDITOR.replace( 'deskripsi' );
        </script>
  </body>
</html>