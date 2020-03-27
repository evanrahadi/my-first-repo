<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>LOGIN TAMPILAN SITUS </title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
    html{
        position: relative;
        min-height: 100%;
    } 
    body{
        background: url(assets/img/1back.jpg) no-repeat center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    body > .container{
      margin-top: 60px;
    }
  </style>
  </head>
  <body>
    <div class="container">
    <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-primary">
    <div class= "panel-heading">
      <h3 class="panel-title"><span class="glyphicon glyphicon-lock"></span> login aplikasi penggajian </h3>
    </div>
    <div class="panel-body">
      <center>
        <img src="assets/img/logo.png" class="image-circle" alt="logo" width="120px">
      </center>
      <hr>
      <?php
      if($_SERVER['REQUEST_METHOD']=='POST'){
          $user = $_POST['username'];
          $pass = $_POST['password'];
          $p = md5($pass);

        if($user =='' && $pass==''){
          ?>
          <div class="alert alert-warning"> <b>warning!</b> form anda belum lengkap...</div>
          <?php
        } else {
          include "koneksi.php";
          $sqlLogin = mysqli_query($konek, "SELECT * FROM admin WHERE username='$user' AND password='$p'");
          $jml = mysqli_num_rows($sqlLogin);
          $d= mysqli_fetch_array($sqlLogin);
          
          if ($jml > 0){
            session_start();
            if($d['level']=="admin"){

            $_SESSION['login']         =TRUE;
            $_SESSION['id']            =$d['idadmin'];
            $_SESSION['username']      =$d['username'];
            $_SESSION['namalengkap']   =$d['namalengkap'];
            $_SESSION['level']         ="admin";

            header('Location:./index.php');
          }else if($d['level']=="user"){
            session_start();
            $_SESSION['login']         =TRUE;
            $_SESSION['id']            =$d['idadmin'];
            $_SESSION['username']      =$d['username'];
            $_SESSION['namalengkap']   =$d['namalengkap'];
            $_SESSION['level']         ="user";

            header('Location:./index_user.php');
            
          }else if($d['level']=="operator"){
            session_start();
            $_SESSION['login']         =TRUE;
            $_SESSION['id']            =$d['idadmin'];
            $_SESSION['username']      =$d['username'];
            $_SESSION['namalengkap']   =$d['namalengkap'];
            $_SESSION['level']         ="operator";

            header('Location:./index_operator.php');
          ?>
            <div class="alert alert-danger"><b> ERROR </b> Password anda salah</div>
            <?php
          }
        }
      }
    }
      ?>
        <form action="" method="post" role="form">
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="username">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="password">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="ssets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>