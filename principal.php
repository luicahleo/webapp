<?php
session_start();
$autorizado = $_SESSION['autorizado'];

if($autorizado==false){
  echo "No tienes permiso para ingresar";
  echo '<meta http-equiv="refresh" content="0; url=login.php">';
  die();
}

require_once('includes/funciones.php');

$msg = "";
$msg2 = "";


//recibimos post de formulario de seteos para ensenar
//if ($_POST){
//  $data_teach = $_POST;
//  $msg = save_teach_data($data_teach);
//}

//recibimos post de formulario cambio de clave
//if( isset($_POST['new-password']) && isset($_POST['retry-new-password'])) {
//
//    $password = strip_tags($_POST['new-password']);
//    $repite_password = strip_tags($_POST['retry-new-password']);
//
//    if ($password != $repite_password){
//      $msg2.="Las claves no coinciden <br>";
//    }else if (strlen($password)<8){
//      $msg2.="La clave debe tener al menos 8 caracteres <br>";
//    }else{
//      $password = sha1($password);
//      $mysqli->query("UPDATE `usuarios` SET `usuarios_password`= '".$password."' WHERE `usuarios_id` = '".$_SESSION['usuarios_id']."' ");
//      $msg2.="La clave ha sido actualizada correctamente <br>";
//    }
//  }



?>

<?php 
    require_once('includes/head_pan_control.php');
?>
   
    <body>
        <!-- Page Container -->
        <div id="page-container">
            <!-- Header -->
            <!-- Add the class .navbar-fixed-top or .navbar-fixed-bottom for a fixed header on top or bottom respectively -->
            <!-- <header class="navbar navbar-inverse navbar-fixed-top"> -->
            <!-- <header class="navbar navbar-inverse navbar-fixed-bottom"> -->
            <?php 
                require_once('includes/header_pan_control.php');
            ?>
            <!-- END Header -->

            <!-- Inner Container -->
            <div id="inner-container">
                <!-- Sidebar -->
                
                <!-- END Sidebar -->
                <?php 
                    require_once('includes/aside_pan_control.php');
                ?>
                <!-- Page Content -->
                <div id="page-content">
                    <!-- Navigation info -->
                    
                    <!-- END Navigation info -->

                  
                        <h2 class="form-box-header">Panel de control </h2>


                        <p class="well">El programa de Intercambio Lingüístico es un instrumento que se ofrece desde el SACU para facilitar la comunicación a los universitarios españoles y extranjeros, con el fin de promover el intercambio cultural y lingüístico.
                                Se pretenden "encuentros" entre los universitarios españoles y extranjeros, para mantener una interacción que permita mejorar sus habilidades comunicativas y/o ampliar sus conocimientos sobre la lengua, la sociedad y la cultura del país al que pertenecen.
                                Este programa consta de dos modalidades: <br>
                                    Tándem: participan dos personas que realizan intercambio lingüístico durante un tiempo determinado por ellos mismos y de forma periódica. En la guía de uso de esta actividad  puedes ver cómo funciona. </p>


                    
                </div>
                
                <!-- END Page Content -->

                <!-- Footer -->
                <?php 
                    require_once('includes/footer_pan_control.php');
                ?>
                <!-- END Footer -->
            </div>
            <!-- END Inner Container -->
        </div>
        <!-- END Page Container -->

       
        <!-- Excanvas for canvas support on IE8 -->
        <!--[if lte IE 8]><script src="js/helpers/excanvas.min.js"></script><![endif]-->

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js -->
        <script src="js/vendor/bootstrap.min.js"></script>

        <!-- Jquery plugins and custom javascript code -->
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Javascript code only for this page -->
        <script>
            $(function () {

                /* For advanced usage and examples please check out
                 *  Jquery Validation   -> https://github.com/jzaefferer/jquery-validation
                 */

                /* Initialize Form Validation */
                $('#form-validation').validate({
                    errorClass: 'help-block',
                    errorElement: 'span',
                    errorPlacement: function (error, e) {
                        e.parents('.form-group > div').append(error);
                    },
                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                        $(e).closest('.help-block').remove();
                    },
                    success: function (e) {
                        // You can use the following if you would like to highlight with green color the input after successful validation!
                        e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
                        e.closest('.help-block').remove();
                        e.closest('.help-inline').remove();
                    },
                    rules: {
                        val_username: {
                            required: true,
                            minlength: 2
                        },
                        val_password: {
                            required: true,
                            minlength: 5
                        },
                        val_confirm_password: {
                            required: true,
                            minlength: 5,
                            equalTo: '#val_password'
                        },
                        val_email: {
                            required: true,
                            email: true
                        },
                        val_website: {
                            required: true,
                            url: true
                        },
                        val_date: {
                            required: true,
                            date: true
                        },
                        val_range: {
                            required: true,
                            range: [1, 100]
                        },
                        val_number: {
                            required: true,
                            number: true
                        },
                        val_digits: {
                            required: true,
                            digits: true
                        },
                        val_skill: {
                            required: true
                        },
                        val_credit_card: {
                            required: true,
                            creditcard: true
                        },
                        val_terms: {
                            required: true
                        }
                    },
                    messages: {
                        val_username: {
                            required: 'Please enter a username',
                            minlength: 'Your username must consist of at least 2 characters'
                        },
                        val_password: {
                            required: 'Please provide a password',
                            minlength: 'Your password must be at least 5 characters long'
                        },
                        val_confirm_password: {
                            required: 'Please provide a password',
                            minlength: 'Your password must be at least 5 characters long',
                            equalTo: 'Please enter the same password as above'
                        },
                        val_email: 'Please enter a valid email address',
                        val_website: 'Please enter your website!',
                        val_date: 'Please select a date!',
                        val_range: 'Please enter a number between 1 and 100!',
                        val_number: 'Please enter a number!',
                        val_digits: 'Please enter digits!',
                        val_credit_card: 'Please enter a valid credit card!',
                        val_skill: 'Please select a skill!',
                        val_terms: 'You must agree to the terms!'
                    }
                });
            });
        </script>
    </body>
</html>