<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <title>Login | Dapatkan Destinasi Wisata Terbaik Kamu di AyoPiknik!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  </head>
  <body id="bg-login">
      <div class="box-login">
        <h2>Login</h2>
        <form action="" method="POST"> 
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" placeholder="Login" class="btn">
        </form>
      <?php
               if(isset($_POST['submit'])){
                  session_start(); 
                include 'db.php';

                   $username = mysqli_real_escape_string($conn, $_POST['user']) ;
                   $password = mysqli_real_escape_string ($conn, $_POST['pass']);

                   $cek = mysqli_query($conn, "SELECT*FROM tb_admin WHERE username = '".$username."' AND password = '".MD5($password)."'");
                   if(mysqli_num_rows($cek)>0){
                       $d = mysqli_fetch_object($cek);
                       $_SESSION['status_login'] = true;
                       $_SESSION['admin_global'] = $d;
                       $_SESSION['id'] = $d->admin_id;
                       echo '<script>window.location="dashboard.php"</script>';
                   }else{
                       echo '<script>alert("Username atau Password Anda Salah")</script>';
                   };
               }
            ?>
      </div>
  </body>
</html>