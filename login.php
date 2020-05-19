<?php
session_start();//iniciasmos la sesion para poder usar las variables de sesion
$_SESSION['autorizado'] = false;

$msg="";
$email="";

if(isset($_POST['email']) && isset($_POST['password'])) {

  if ($_POST['email']==""){
    $msg.="Debe ingresar un email <br>";
  }else if ($_POST['password']=="") {
    $msg.="Debe ingresar la clave <br>";
  }else {
    $email = strip_tags($_POST['email']);
    $password= sha1(strip_tags($_POST['password']));

    require_once('funciones.php');

    $mysqli = conecta_BD();
    echo "debug";
    echo $mysqli;
    $cantidad = verifica_email_password($email, $password, $mysqli);


    // $resultado = $mysqli->query("SELECT * FROM `usuarios` WHERE `usuarios_email` = '".$email."' AND  `usuarios_password` = '".$password."' ");
    // $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

    // echo "<pre>";
    // print_r($usuarios);
    // echo "</pre>";
    // die();

    //cargo datos del usuario en variables de sesión


    $_SESSION['usuarios_nombre'] = $usuarios[0]['usuarios_nombre'];
    $_SESSION['usuarios_uvus'] = $usuarios[0]['usuarios_uvus'];
    $_SESSION['usuarios_id'] = $usuarios[0]['usuarios_id'];
    $_SESSION['usuarios_email'] = $usuarios[0]['usuarios_email'];
    $_SESSION['usuarios_ultimo_login'] = $usuarios[0]['usuarios_ultimo_login'];

    //cuento cuantos elementos tiene $tabla,
    $cantidad = count($usuarios);

    if ($cantidad == 1){
      $hoy = date ( "Y-m-d H:i:s" );//para poner el time de ultimo login
      $resultado = $mysqli->query("UPDATE `usuarios` SET `usuarios_ultimo_login` = '".$hoy."' WHERE `usuarios_email` =  '".$email."' ");
      $msg .= "Exito!!!";
      $_SESSION['autorizado'] = true;
      //redirigimos a la pagina del dashboard principal
      echo '<meta http-equiv="refresh" content="1; url=principal.php">';
    }else{
      $msg .= "Acceso denegado!!!";
      $_SESSION['autorizado'] = false;
    }//end else
  }//end else
}//end if(isset....)

?>



<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SACU CONECTA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/icons.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <header class="header-area">
      <div class="header-top bg-img">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 col-md-7 col-12 col-sm-8">
                      <div class="header-contact">
                          <ul>
                              <li><i class="fa fa-phone"></i> 954 48 60 16</li>
                              <li><i class="fa fa-envelope-o"></i><a href="#">intercambiolinguistico@us.es</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-5 col-12 col-sm-4">
                      <div class="login-register">
                          <ul>
                              <li><a href="login.php">Iniciar sesion</a></li>
                              <li><a href="register.php">Registrarse</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="header-bottom sticky-bar clearfix">
          <div class="container">
              <div class="row">
                  <div class="col-lg-2 col-md-6 col-4">
                      <div class="logo">
                          <a href="index.html">
                              <img alt="" src="assets/img/logo/logo.png">
                          </a>
                      </div>
                  </div>
                  <div class="col-lg-10 col-md-6 col-8">
                      <div class="menu-cart-wrap">
                          <div class="main-menu">
                              <nav>
                                  <ul>
                                      <li><a href="index.html"> INICIO </a>

                                      </li>
                                      <li><a href="about-us.html"> Quienes somos </a></li>


                                      <li><a href="blog.html"> BLOG </a>

                                      </li>
                                      <li><a href="contact.html"> CONTACTAR </a></li>
                                  </ul>
                              </nav>
                          </div>

                      </div>
                  </div>
              </div>

          </div>
      </div>
  </header>




    <div class="breadcrumb-area">
        <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-4 pt-100 pb-95" style="background-image:url(assets/img/bg/breadcrumb-bg-4.jpg);">
            <div class="container">
                <h2>Iniciar sesion</h2>
                <p></p>
            </div>
        </div>
        <div class="breadcrumb-bottom">
            <div class="container">

            </div>
        </div>
    </div>
    <div class="login-register-area pt-130 pb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">

                        <!--div para login -->

                        <div class="tab-content">

                                <div class="login-form-container">
                                    <div class="login-register-form">
                                      <h1 class="title-login-register"> Iniciar sesion </h1>

                                        <form action="login.php" method="post">
                                            <input type="text" name="email" placeholder="Email">
                                            <input type="password" name="password" placeholder="Contraseña">
                                            <div class="button-box">
                                                <!-- <div class="login-toggle-btn">
                                                    <input type="checkbox">

                                                    <label>Recuerdame</label>
                                                </div> -->
                                                <button class="default-btn" type="submit"><span>Iniciar sesion</span></button>

                                            </div>
                                            <div style="color:red">
                                              <?php echo $msg; ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <footer class="footer-area">
        <div class="footer-top bg-img default-overlay pt-130 pb-80" style="background-image:url(assets/img/bg/bg-4.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-widget mb-40">
                            <div class="footer-title">
                                <h4>DONDE ESTAMOS UBICADOS</h4>
                            </div>
                            <div class="footer-about">
                                <div class="f-contact-info">
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-home"></i>
                                        <span>Pabellón de Uruguay, Avda. de Chile s/n
                                            41013 - SEVILLA </span>
                                    </div>
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-envelope-o"></i>
                                        <span><a href="#">intercambiolinguistico@us.es</a></span>
                                    </div>
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-phone"></i>
                                        <span> 954 48 60 16</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                                        <div class="footer-widget mb-40">
                                            <div class="footer-title">
                                                <h4>GALERIA</h4>
                                            </div>
                                            <div class="footer-gallery">
                                                <ul>
                                                    <li><a href="#"><img src="assets/img/gallery/gallery-1.png" alt=""></a></li>
                                                    <li><a href="#"><img src="assets/img/gallery/gallery-2.png" alt=""></a></li>
                                                    <li><a href="#"><img src="assets/img/gallery/gallery-3.png" alt=""></a></li>
                                                    <li><a href="#"><img src="assets/img/gallery/gallery-4.png" alt=""></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                </div>
            </div>
        </div>
        <div class="footer-bottom pt-15 pb-15">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="copyright">
                            <p>
                                Copyright © 2020
                                <a href="#">SACU</a> . Todos los derechos reservados.
                            </p>
                            <p>Designed by: Luis Rolando Cahuana Leon</p>
                            <p>Seville - Spain - 2020</p>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="footer-menu-social">
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="#">Privacidad & Politicas</a></li>
                                    <li><a href="#">Terminos & Condiciones de uso</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>






    </footer>












    <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- Popper JS -->
    <script src="assets/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Plugins JS -->
    <script src="assets/js/plugins.js"></script>
    <!-- Ajax Mail -->
    <script src="assets/js/ajax-mail.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

</body>

</html>
