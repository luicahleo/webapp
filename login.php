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



<?php
require_once('includes/footer.php');
require_once('includes/js.php');

?>

</body>

</html>
