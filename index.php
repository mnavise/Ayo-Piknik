<?php 
    include 'db.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a= mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <link rel="icon" href="assets/logo.svg" />
    <title>Dapatkan Destinasi Wisata Terbaik Kamu di AyoPiknik!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  </head>
  <body>
      <!-- header -->
      <header>
          <div class="container">
            <h1><a href="index.php"><img src="assets/logo.svg" alt="Beranda" width="200" height="50" /></h1>
            <ul>
                <li><a href="produk.php">Tempat Wisata / Event</a></li>
            </ul>
          </div>
      </header>

      <!-- Search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Temukan Tempat Wisatamu">
                <input type="submit" name="cari" value="Temukan">
            </form>
        </div>
    </div>

    <!-- Kategori-->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php 
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category  ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori)>0){
                        while ($k = mysqli_fetch_array($kategori)){
                ?>
                <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                <div class="col-5">
                    <img src="assets/img/map.png" width="50 px" style="margin-bottom: 5px;">
                    <p><?php echo $k['category_name'] ?></p>
                </div>
                </a>
                <?php }}else{ ?>
                    <p>KATEGORI TIDAK TERSERDIA</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- new Event -->
    <div class="section">
         <div class="container">
             <h3>Event Terbaru</h3>
             <div class="box">
                 <?php 
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
                    if(mysqli_num_rows($produk)>0){
                        while($p = mysqli_fetch_array($produk)){
                 ?>
                <a href="detail_produk.php?id=<?php echo $p['product_id'] ?>">
                <div class="col-4">
                    <img src="assets/Produk/<?php echo $p['product_image'] ?>">
                    <p class="nama"><?php echo substr($p['product_name'], 0,25)  ?></p>
                    <p class="harga">Rp. <?php echo number_format( $p['product_price']) ?></p>
                </div>
                </a>
                <?php }}else{ ?>
                    <p>Tempat Wisata / Event Tidak Tersedia</p>
                <?php } ?>
                </div>
         </div>
    </div>

    <!--Footer-->
    <div class="footer">
        <div class="container">
            <h3>CONTACT US!</h3>
            <h4>Email</h4>
            <p><?php echo $a->admin_email ?> </p>
            <h4>No.Telepon</h4>
            <p><?php echo $a->admin_telp ?> </p>
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?> </p>
            <small>Copyright &copy; 2021 - Ayo Piknik</small>
        </div>
    </div>
  </body>
</html>