
<?php
session_start();
$autorizado = $_SESSION['autorizado'];

if($autorizado==false){
  echo "No tienes permiso para ingresar";
  echo '<meta http-equiv="refresh" content="0; url=login.php">';
  die();
}

require_once('includes/funciones.php');

obtener_imagen_usuario();

$msg = "";
$msg2 = "";



//recibimos post de formulario cambio de imagen usuario
if ($_FILES){
  $archivo = $_FILES;
  $msg = graba_imagen($archivo);
}

//recibimos post de formulario cambio de clave
if( isset($_POST['new-password']) && isset($_POST['retry-new-password'])) {

    $password = strip_tags($_POST['new-password']);
    $repite_password = strip_tags($_POST['retry-new-password']);
  
    if ($password != $repite_password){
      $msg2.="Las claves no coinciden <br>";
    }else if (strlen($password)<8){
      $msg2.="La clave debe tener al menos 8 caracteres <br>";
    }else{
      $password = sha1($password);
      $mysqli->query("UPDATE `usuarios` SET `usuarios_password`= '".$password."' WHERE `usuarios_id` = '".$_SESSION['usuarios_id']."' ");
      $msg2.="La clave ha sido actualizada correctamente <br>";
    }
  }  


















//$videos = obtiene_videos();

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

                    <!-- Form Teach language -->
                    <form id="form-validation" action="profile_config.php" method="post" class="form-horizontal form-box remove-margin">
                        <!-- Form Header -->
                        <h4 class="form-box-header">Idioma para ensenar </h4>

                        <!-- Form Content -->
                        <div class="form-box-content">
                           
                            <div class="form-group">
                                <label class="control-label col-md-2" for="select-language">Idioma</label>
                                <div class="col-md-2">
                                    <select id="select-language" name="select-language" class="form-control">
                                        <option>espanol</option>
                                        <option>ingles</option>
                                        <option>frances</option>
                                        <option>aleman</option>
                                        <option>italiano</option>
                                        <option>portugues</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">

                            <p class="well">Recuerde que las etiquetas <code>Manana</code> o <code>Tarde</code> se refieren a horarios academicos</p>
                            <label class="control-label col-md-2">Dias y turnos</label>
                                <div class="col-md-10">

                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th class="hidden-xs hidden-sm text-left"><i class="fa fa-calendar"></i> Dia</th>
                                            <th class="hidden-xs hidden-sm text-left"><i class="fa fa-sun-o"></i> Manana</th>
                                            <th class="hidden-xs hidden-sm text-left"><i class="fa fa-moon-o"></i> Tarde</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left"><input type="checkbox" id="check1-td-monday" name="check1-td-monday"> Lunes </td>
                                            <td class="text-left"><input type="checkbox" id="check1-td-morning" name="check1-td-morning"></td>
                                            <td class="text-left"><input type="checkbox" id="check1-td1-afternoon" name="check1-td1-afternoon"></td>
                                            
                                        </tr>
                                       
                                       
                                       
                                    </tbody>
                                </table>   



                                    <!-- <div class="checkbox">
                                        <label for="checkbox1">
                                            <input type="checkbox" id="checkbox1" name="checkbox1" value="Lunes"> Lunes 
                                        </label>

                                        <label for="checkbox1-1">
                                            <input type="checkbox" id="checkbox1-1" name="checkbox1-1" value="Manana"> Manana 
                                        </label>
                                        <label for="checkbox1-2">
                                            <input type="checkbox" id="checkbox1-2" name="checkbox1-2" value="Tarde"> Tarde 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="checkbox2">
                                            <input type="checkbox" id="checkbox2" name="checkbox2" value="Martes"> Martes
                                        </label>
                                        <label for="checkbox1-1">
                                            <input type="checkbox" id="checkbox1-1" name="checkbox1-1" value="Manana"> Manana 
                                        </label>
                                        <label for="checkbox1-2">
                                            <input type="checkbox" id="checkbox1-2" name="checkbox1-2" value="Tarde"> Tarde 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="checkbox3">
                                            <input type="checkbox" id="checkbox3" name="checkbox3" value="Miercoles"> Miercoles
                                        </label>
                                        <label for="checkbox1-1">
                                            <input type="checkbox" id="checkbox1-1" name="checkbox1-1" value="Manana"> Manana 
                                        </label>
                                        <label for="checkbox1-2">
                                            <input type="checkbox" id="checkbox1-2" name="checkbox1-2" value="Tarde"> Tarde 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="checkbox4">
                                            <input type="checkbox" id="checkbox4" name="checkbox4" value="Jueves"> Jueves
                                        </label>
                                        <label for="checkbox1-1">
                                            <input type="checkbox" id="checkbox1-1" name="checkbox1-1" value="Manana"> Manana 
                                        </label>
                                        <label for="checkbox1-2">
                                            <input type="checkbox" id="checkbox1-2" name="checkbox1-2" value="Tarde"> Tarde 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="checkbox5">
                                            <input type="checkbox" id="checkbox5" name="checkbox5" value="Viernes"> Viernes
                                        </label>
                                        <label for="checkbox1-1">
                                            <input type="checkbox" id="checkbox1-1" name="checkbox1-1" value="Manana"> Manana 
                                        </label>
                                        <label for="checkbox1-2">
                                            <input type="checkbox" id="checkbox1-2" name="checkbox1-2" value="Tarde"> Tarde 
                                        </label>
                                    </div> -->
                                </div>
                            </div>
                           
                            
                            <div class="form-group form-actions">
                                <div class="col-md-10 col-md-offset-2">
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Borrar</button>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
                                    <div style="color: red">
                                        <?php 
                                            if($msg2 !=""){
                                                echo $msg2;
                                            }
                                        ?>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- END Form Content -->
                    </form>
                    <!-- END Form Teach language -->

                     <!-- Form Learn language -->
                     <form id="form-validation" action="profile_config.php" method="post" class="form-horizontal form-box remove-margin">
                        <!-- Form Header -->
                        <h4 class="form-box-header">Idioma para aprender </h4>

                        <!-- Form Content -->
                        <div class="form-box-content">
                           
                            <div class="form-group">
                                <label class="control-label col-md-2" for="select-language">Idioma</label>
                                <div class="col-md-2">
                                    <select id="select-language" name="select-language" class="form-control">
                                        <option>espanol</option>
                                        <option>ingles</option>
                                        <option>frances</option>
                                        <option>aleman</option>
                                        <option>italiano</option>
                                        <option>portugues</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">

                            <p class="well">Recuerde que las etiquetas <code>Manana</code> o <code>Tarde</code> se refieren a horarios academicos</p>
                            <label class="control-label col-md-2">Dias y turnos</label>
                                <div class="col-md-10">

                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th class="hidden-xs hidden-sm text-left"><i class="fa fa-calendar"></i> Dia</th>
                                            <th class="hidden-xs hidden-sm text-left"><i class="fa fa-sun-o"></i> Manana</th>
                                            <th class="hidden-xs hidden-sm text-left"><i class="fa fa-moon-o"></i> Tarde</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left"><input type="checkbox" id="check1-td-monday" name="check1-td-monday"> Lunes </td>
                                            <td class="text-left"><input type="checkbox" id="check1-td-morning" name="check1-td-morning"></td>
                                            <td class="text-left"><input type="checkbox" id="check1-td1-afternoon" name="check1-td1-afternoon"></td>
                                            
                                        </tr>
                                       
                                       
                                       
                                    </tbody>
                                </table>   



                                    <!-- <div class="checkbox">
                                        <label for="checkbox1">
                                            <input type="checkbox" id="checkbox1" name="checkbox1" value="Lunes"> Lunes 
                                        </label>

                                        <label for="checkbox1-1">
                                            <input type="checkbox" id="checkbox1-1" name="checkbox1-1" value="Manana"> Manana 
                                        </label>
                                        <label for="checkbox1-2">
                                            <input type="checkbox" id="checkbox1-2" name="checkbox1-2" value="Tarde"> Tarde 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="checkbox2">
                                            <input type="checkbox" id="checkbox2" name="checkbox2" value="Martes"> Martes
                                        </label>
                                        <label for="checkbox1-1">
                                            <input type="checkbox" id="checkbox1-1" name="checkbox1-1" value="Manana"> Manana 
                                        </label>
                                        <label for="checkbox1-2">
                                            <input type="checkbox" id="checkbox1-2" name="checkbox1-2" value="Tarde"> Tarde 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="checkbox3">
                                            <input type="checkbox" id="checkbox3" name="checkbox3" value="Miercoles"> Miercoles
                                        </label>
                                        <label for="checkbox1-1">
                                            <input type="checkbox" id="checkbox1-1" name="checkbox1-1" value="Manana"> Manana 
                                        </label>
                                        <label for="checkbox1-2">
                                            <input type="checkbox" id="checkbox1-2" name="checkbox1-2" value="Tarde"> Tarde 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="checkbox4">
                                            <input type="checkbox" id="checkbox4" name="checkbox4" value="Jueves"> Jueves
                                        </label>
                                        <label for="checkbox1-1">
                                            <input type="checkbox" id="checkbox1-1" name="checkbox1-1" value="Manana"> Manana 
                                        </label>
                                        <label for="checkbox1-2">
                                            <input type="checkbox" id="checkbox1-2" name="checkbox1-2" value="Tarde"> Tarde 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="checkbox5">
                                            <input type="checkbox" id="checkbox5" name="checkbox5" value="Viernes"> Viernes
                                        </label>
                                        <label for="checkbox1-1">
                                            <input type="checkbox" id="checkbox1-1" name="checkbox1-1" value="Manana"> Manana 
                                        </label>
                                        <label for="checkbox1-2">
                                            <input type="checkbox" id="checkbox1-2" name="checkbox1-2" value="Tarde"> Tarde 
                                        </label>
                                    </div> -->
                                </div>
                            </div>
                           
                            
                            <div class="form-group form-actions">
                                <div class="col-md-10 col-md-offset-2">
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Borrar</button>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
                                    <div style="color: red">
                                        <?php 
                                            if($msg2 !=""){
                                                echo $msg2;
                                            }
                                        ?>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- END Form Content -->
                    </form>
                    <!-- END Form Learn language -->



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