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

    $mysqli = mysqli_connect("localhost","admin_solucian","121212","admin_intercambio_linguistico");

    if ($mysqli==false){
      echo "Hubo un problema al conectarse a María DB";
      die();
    }

    $resultado = $mysqli->query("SELECT * FROM `usuario` WHERE `usuario_email` = '".$email."' AND  `usuario_password` = '".$password."' ");
    $usuario = $resultado->fetch_all(MYSQLI_ASSOC);

    //cargo datos del usuario en variables de sesión
    

    //cuento cuantos elementos tiene $tabla,
    $cantidad = count($usuario);

    if ($cantidad == 1){
      $hoy = date ( "Y-m-d H:i:s" );//para poner el time de ultimo login
      $resultado = $mysqli->query("UPDATE `usuario` SET `usuario_ultimo_login` = '".$hoy."' WHERE `usuario_email` =  '".$email."' ");
      $_SESSION['autorizado'] = true;
      $_SESSION['usuario'] = $usuario;

      $_SESSION['usuario_nombre'] = $usuario[0]['usuario_nombre'];
      $_SESSION['usuario_uvus'] = $usuario[0]['usuario_uvus'];
      $_SESSION['usuario_id'] = $usuario[0]['usuario_id'];
      $_SESSION['usuario_email'] = $usuario[0]['usuario_email'];
      $_SESSION['usuario_ultimo_login'] = $usuario[0]['usuario_ultimo_login'];
      $msg .= "Bienvenido " . $_SESSION['usuario_nombre'];

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
