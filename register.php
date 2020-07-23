
<?php

require_once "includes/conection.php";
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
    $_SESSION['error_password'] = "error con la longitud de password";
  }
    $ip = $_SERVER['REMOTE_ADDR'];

    //aquí como todo estuvo OK, resta controlar que no exista previamente el mail ingresado en la tabla users.
        $resultado = $db->query("SELECT * FROM `usuario` WHERE `usuario_email` = '".$email."' ");
    $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

    //cuento cuantos elementos tiene $tabla,
    $cantidad = count($usuarios);

    //solo si no hay un usuario con mismo mail, procedemos a insertar fila con nuevo usuario
    if ($cantidad == 0){
      $password = sha1($password); //encriptar clave con sha1


    $db->query("INSERT INTO `usuario` (`usuario_nombre`,`usuario_uvus`,`usuario_email`, `usuario_password`, `usuario_ip`, `usuario_imagen`) VALUES ('".$nombre."','".$uvus."','".$email."', '".$password."', '".$ip."', '');");
    //   $mysqli->query("INSERT INTO `prueba` (`prueba_nombre`,`prueba_uvus`,`prueba_email`,`prueba_ip`,`prueba_password`,`prueba_imagen`) VALUES ('".$nombre."', '".$uvus."', '".$email."', '".$ip."', '".$password."', '');");
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


 ?>

<?php
require_once('includes/head.php');
?>

<body>
<?php
require_once('includes/header.php');
?>


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

<?php
require_once('includes/footer.php');
require_once('includes/js.php');

?>


</body>

</html>
