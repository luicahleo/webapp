
<?php
//se prepara variable para guardar posibles mensajes de respuesta
$msg="";

//se crean las variables para guardar datos del usuario a crear.
//estas variables también servirán para repoblar los formularios.
$nombre="";
$uvus="";
$email="";
$password="";
$repite_password="";


if( isset($_POST['email']) && isset($_POST['password']) && isset($_POST['retry-password']) && isset($_POST['terms']) && isset($_POST['name']) && isset($_POST['uvus'])) {

  if ($_POST['email']==""){
    $msg.= "Debe ingresar un email <br>";
  }

  if ($_POST['password'] ==""){
    $msg.="Debe ingresar una clave <br>";
  }

  if ($_POST['retry-password'] ==""){
    $msg.="Debe repetir la clave <br>";
  }
  $nombre = strip_tags($_POST['name']);
  $uvus = strip_tags($_POST['uvus']);
  $email = strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']);
  $repite_password = strip_tags($_POST['retry-password']);

  if ($password != $repite_password){
    $msg.="Las claves no coinciden <br>";
    $password="";

  }else if (strlen($password)<8){
    $msg.="La clave debe tener al menos 8 caracteres <br>";

  }else{
    //momento de conectarnos a db

    $mysqli = mysqli_connect("localhost","root","","SacuIntercambio");


    //verificamos si hay algun problema con la conexion
    if ($mysqli==false){
      echo "Hubo un problema al conectarse a María DB";
      die();
    }
    $ip = $_SERVER['REMOTE_ADDR'];

    //aquí como todo estuvo OK, resta controlar que no exista previamente el mail ingresado en la tabla users.
    $resultado = $mysqli->query("SELECT * FROM `usuarios` WHERE `usuarios_email` = '".$email."' ");
    $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);


    //cuento cuantos elementos tiene $tabla,
    $cantidad = count($usuarios);

    //solo si no hay un usuario con mismo mail, procedemos a insertar fila con nuevo usuario
    if ($cantidad == 0){
      $password = sha1($password); //encriptar clave con sha1


    //   $nombre="luis";
    //   $uvus="luis123";
    //   $email="luis@gmail.com";
    //   $password="456";
    //   $repite_password="45666";

    // echo "$nombre, $uvus, $email, $password, $ip";


    $mysqli->query("INSERT INTO `usuarios` (`usuarios_nombre`,`usuarios_uvus`,`usuarios_email`, `usuarios_password`, `usuarios_ip`, `usuarios_imagen`) VALUES ('".$nombre."','".$uvus."','".$email."', '".$password."', '".$ip."', '');");
    //   $mysqli->query("INSERT INTO `prueba` (`prueba_nombre`,`prueba_uvus`,`prueba_email`,`prueba_ip`,`prueba_password`,`prueba_imagen`) VALUES ('".$nombre."', '".$uvus."', '".$email."', '".$ip."', '".$password."', '');");
      echo "insertados";
      $msg.="Usuario creado correctamente, ingrese haciendo  <b><a href='login.php'>clic aquí</a></b> <br>";
      
      $nombre="";
      $uvus="";
      $email="";
      $password="";
      $repite_password="";
    }else{
      $msg.="El mail ingresado ya existe <br>";
    }
  }
}

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
                <h2>Registrar</h2>
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

                            <!--div para registro -->

                                <div class="login-form-container">
                                    <div class="login-register-form">
                                      <h1 class="title-login-register"> Registrarse </h1>

                                        <form action="register.php" method="post">
                                            <p id="notificacion">Nota: Para poder registrarse usted necesita tener una cuenta UVUS</p>
                                            <p>(*)campos obligatorios</p>

                                            <input type="text" name="name" placeholder="Nombre completo*" value="<?php echo $nombre; ?>" >
                                            <input type="text" name="uvus" placeholder="Usuario UVUS*" value="<?php echo $uvus; ?>" >
                                            <input name="email" type="email" placeholder="Email*" value="<?php echo $email; ?>" required>
                                            <input name="password" type="password"  placeholder="Contraseña*"  required>
                                            <input name="retry-password" type="password"  placeholder="Repita contraseña*" required>

                                            <div class="col-lg-7">
                                                        <div class="icheck-primary">
                                                          <input type="checkbox" id="agreeTerms" name="terms" required>
                                                          <label for="agreeTerms">
                                                           Acepto los <a href="https://google.com"><b>terminos y condiciones</b></a>
                                                          </label>
                                                        </div>


                                            <div class="button-box">
                                                <button class="default-btn" type="submit"><span>Registrarse</span></button>
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
