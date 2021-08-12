<?php 
    error_reporting(0);
    include 'db.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a= mysqli_fetch_object($kontak);

    $produk = mysqli_query($conn,"SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);
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
                <input type="text" name="search" placeholder="Temukan Tempat Wisatamu" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Temukan">
            </form>
        </div>
    </div>

    <!--Product detail-->
    <div class="section">
        <div class="container">
            <h3>Detail Tempat Wisata/Event</h3>
            <div class="box">
                <div class="col-2">
                    <img src="assets/Produk/<?php echo $p->product_image ?> " width="100%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->product_name ?> </h3>
                    <h4>Rp. <?php echo number_format ($p->product_price) ?> </h4>
                    <br>
                    <p>Deskripsi Tempat : <br>
                        <?php echo $p->product_description ?>
                    </p>
                    <p><a href="https://chataja.me/PEMWEB" target="_blank"><img src="assets/img/pngwing.com.png" width="40px">Pesan Tiket via WhatsApp
                    </a></p>
                    </div>

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