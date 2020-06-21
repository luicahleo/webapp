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

var_dump($_POST);

if (isset($_POST)){

    $idioma = $_POST['select-language'];
    $lunes = $_POST['check-monday'];
    $martes = $_POST['check-tuesday'];
    $miercoles = $_POST['check-wednesday'];

    $formato_lunes = implode(',', $_POST['check-monday']);
    $formato_martes = implode(',', $martes);
    $formato_miercoles = implode(',', $miercoles);

    echo '<br>';

    var_dump($formato_lunes);
    var_dump($formato_martes);
    var_dump($formato_miercoles);

}


//recibimos post de formulario de seteos para ensenar
// if ($_POST){
//   $data_teach = $_POST;
//   $msg = save_teach_data($data_teach);
// }


?>

<?php 
    require_once('includes/head_pan_control.php');
?>
   	<script type="text/javascript" src="includes/includes_js/helpers.js"></script>
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
                    <form id="form-validation" action="teach.php" method="post" class="form-horizontal form-box remove-margin">
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
                                            <th class="hidden-xs hidden-sm text-left"><i class="fa fa-sun-o"></i> 09:00 - 12:00</th>
                                            <th class="hidden-xs hidden-sm text-left"><i class="fa fa-sun-o"></i> 12:00 - 15:00</th>
                                            <th class="hidden-xs hidden-sm text-left"><i class="fa fa-moon-o"></i> 15:00 - 18:00</th>
                                            <th class="hidden-xs hidden-sm text-left"><i class="fa fa-moon-o"></i> 18:00 - 21:00</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                            <td class="text-left"><label><input type="checkbox"  name="check-monday[]" id="check-monday[]" onchange="showContent('check-monday[]');" value="monday"> Lunes <Div class="fantasma""> Mi texto oculto </ div>  </label> </td>
                                            
                                            <td class="text-left"><label><input type="checkbox"  name="check-monday[]"  value="nine">  <Div class="fantasma""> Mi texto oculto </ div> </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-monday[]"  value="twelve">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-monday[]"  value="fifteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-monday[]"  value="eighteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                             

                                            
                                           
                                        </tr>
                                       
                                        <tr>
                                            <td class="text-left"><label><input type="checkbox"  name="check-tuesday[]" id="check-tuesday[]" onchange="showContent('check-tuesday[]');" value="tuesday"> Martes <Div class="fantasma""> Mi texto oculto </ div>  </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-tuesday[]" value="nine">  <Div class="fantasma""> Mi texto oculto </ div> </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-tuesday[]" value="twelve">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-tuesday[]" value="fifteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-tuesday[]" value="eighteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>

                                        </tr>
                                       
                                        <tr>
                                            <td class="text-left"><label><input type="checkbox"  name="check-wednesday[]" id="check-wednesday[]" onchange="showContent('check-wednesday[]');" value="wednesday"> Miercoles <Div class="fantasma""> Mi texto oculto </ div>  </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-wednesday[]" value="nine">  <Div class="fantasma""> Mi texto oculto </ div> </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-wednesday[]" value="twelve">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-wednesday[]" value="fifteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-wednesday[]" value="eighteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>

                                        </tr>
                                        <tr>
                                            <td class="text-left"><label><input type="checkbox"  name="check-thursday[]" id="check-thursday[]" onchange="showContent('check-thursday[]');" value="thursday"> Jueves <Div class="fantasma""> Mi texto oculto </ div>  </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-thursday[]" value="nine">  <Div class="fantasma""> Mi texto oculto </ div> </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-thursday[]" value="twelve">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-thursday[]" value="fifteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-thursday[]" value="eighteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>

                                        </tr>
                                        <tr>
                                            <td class="text-left"><label><input type="checkbox"  name="check-friday[]" id="check-friday[]" onchange="showContent('check-friday[]');" value="friday"> Viernes <Div class="fantasma""> Mi texto oculto </ div>  </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-friday[]" value="nine">  <Div class="fantasma""> Mi texto oculto </ div> </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-friday[]" value="twelve">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-friday[]" value="fifteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-friday[]" value="eighteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>

                                        </tr>
                                        <tr>
                                            <td class="text-left"><label><input type="checkbox"  name="check-saturday[]" id="check-saturday[]" onchange="showContent('check-saturday[]');" value="saturday"> Sabado <Div class="fantasma""> Mi texto oculto </ div>  </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-saturday[]" value="nine">  <Div class="fantasma""> Mi texto oculto </ div> </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-saturday[]" value="twelve">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-saturday[]" value="fifteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-saturday[]" value="eighteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>

                                        </tr>
                                        <tr>
                                            <td class="text-left"><label><input type="checkbox"  name="check-sunday[]" id="check-sunday[]" onchange="showContent('check-sunday[]');" value="sunday"> Domingo <Div class="fantasma""> Mi texto oculto </ div>  </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-sunday[]" value="nine">  <Div class="fantasma""> Mi texto oculto </ div> </label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-sunday[]" value="twelve">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-sunday[]" value="fifteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>
                                            <td class="text-left"><label><input type="checkbox"  name="check-sunday[]" value="eighteen">  <Div class="fantasma""> Mi texto oculto </ div></label> </td>

                                        </tr>
                                        </tbody>
                                </table>   

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