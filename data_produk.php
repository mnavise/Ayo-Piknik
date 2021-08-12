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
              <h3>Data Event</h3>
              <div class="box">
                  <p><a href="tambah_produk.php">Tambah Event/Wisata</a></p>
                 <table border="1" cellspacing="0" class="table">
                     <thead>
                         <tr>
                             <th width="60px">No</th>
                             <th>Kategori</th>
                             <th>Nama Event</th>
                             <th>Harga</th>
                             
                             <th>Gambar</th>
                             <th>Status</th>
                             <th width="150px">Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no =1;
                            $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING(category_id) ORDER BY product_id DESC");
                            if(mysqli_num_rows($produk)>0){
                            while($row = mysqli_fetch_array($produk)){
                         ?>
                         <tr>
                             <td><?php echo $no++ ?></td>
                             <td><?php echo $row['category_name']?></td>
                             <td><?php echo $row['product_name']?></td>
                             <td>Rp. <?php echo number_format($row['product_price'])?></td>
                            
                             <td><img src="assets/Produk/<?php echo $row['product_image']?>" width="75px"> </td>
                             <td><?php echo ($row['product_status']==0)?'Tidak Tersedia':'Tersedia';?></td>
                             <td>
                                 <a href="edit_produk.php?id=<?php echo $row['product_id']?>">Edit</a> || <a href="hapus_kategori.php?idp=<?php echo $row['product_id']?>" onclick="return confirm ('Yakin Ingin Hapus ?')" >Hapus</a>
                             </td>
                         </tr>
                         <?php }}else{ ?>
                             <tr>
                                 <td colspan="7">Tidak Terdapat Data Event/Wisata</td>
                                </tr>
                         <?php } ?>
                     </tbody>
                 </table>
              </div>
          </div>
      </div>

      <!-- Footer -->
      <div class="container">
          <small>Copyright &copy; 2021 - Ayo Piknik.</small>
      </div>
  </body>
</html>