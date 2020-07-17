<?php
echo "// DEBUG: ";

require_once('includes/conection.php');

$autorizado = $_SESSION['autorizado'];

if ($autorizado == false) {
    echo "No tienes permiso para ingresar";
    echo '<meta http-equiv="refresh" content="0; url=login.php">';
    die();
}
require_once('includes/funciones.php');
//este es el formato hay que hay que llegar {"idioma":"espanol", "dia":{"martes":["9:00","12:00"], "miercoles":["18:00"]}}


$msg = "";
$msg2 = "";
$msg3 = "";
$msg4 = "";

$mensaje_seleccionar = "Tiene que seleccionar al menos un horario en ";
$string_idioma_dias = "";
$string_dias_horarios = "";


if (!empty($_POST)) {
    $idioma = $_POST['selecciona_idioma'];
    $lunes = isset($_POST['check_lunes']) ? $_POST['check_lunes'] : false;
    $martes = isset($_POST['check_martes']) ? $_POST['check_martes'] : false;
    $miercoles = isset($_POST['check_miercoles']) ? $_POST['check_miercoles'] : false;

    $array_dias = array($lunes, $martes, $miercoles);
    $string_resultado = "";
    $contador = 0;
    for ($i = 0; $i < count($array_dias); $i++) {
        if (separa_horarios($array_dias[$i]) != '') {
            $string_resultado .= separa_horarios($array_dias[$i]) . "-";
            $contador++;
        }
    }
    //quitamos el ultimo caracter
    $string_resultado = substr($string_resultado, 0, -1);

    $msg = graba_idioma_preferencias($idioma, $string_resultado);

}

/*********************************************/
/****Tabla muestra Horarios seleccionados*****/
/*********************************************/
//recuperamos las preferencias de BD, pero preguntamos si existe ya un valor insertado

$disponibilidad_idioma = "";
$disponibilidad_preferencias = '';
$resultado_disponibilidad = verifica_preferencia();

if ($resultado_disponibilidad != 'vacio') {
    $disponibilidad_idioma = $resultado_disponibilidad['disponibilidad_idioma'];
    $disponibilidad_preferencias = $resultado_disponibilidad['disponibilidad_preferencias'];
    $dias_horarios = '';
    $solo_dias = '';
    $solo_horarios = '';
    $nuevo_array = array();
//ahora le damos formato a preferencias para mostrar en la tabla
    $dias_horarios = explode('-', $disponibilidad_preferencias);
    $array_resultado_final = array();
//recorremos cada valor para cambiarle el ',' por el caracter ' a ' para que se vea mejor
    for ($i = 0; $i < count($dias_horarios); $i++) {
        $prueba = explode(',', $dias_horarios[$i]);
        if (count($prueba) > 2) {
            //reemplazamos el el segundo ',' por el caracter 'y'
            $nuevo_array[$i] = str_replace(', ', ' y ', $dias_horarios[$i]);

            $nuevo_array[$i] = str_replace(',', ' a ', $nuevo_array[$i]);

            $array_resultado_final[$i] = $nuevo_array[$i];

        } else {
            $nuevo_array[$i] = str_replace(',', ' a ', $dias_horarios[$i]);

        }

    }
}else{
    $msg2 = "no hay preferencias guardadas";
}


/*********************************************/


//    $nuevo_martes = array();
//    //separamos el array
//    for ($i=0;$i<count($martes);$i++){
//        if ($martes[$i]!='no_horario'){
//            array_push($nuevo_martes,$martes[$i]);
//        }
//    }
//    $nuevo_miercoles = array();
//    //separamos el array
//    for ($i=0;$i<count($miercoles);$i++){
//        if ($miercoles[$i]!='no_horario'){
//            array_push($nuevo_miercoles,$miercoles[$i]);
//        }
//    }
//validamos los dias
//    if (count($nuevo_lunes) > 1 ) {
//        $dia = 'lunes';
//            if (count($lunes) != 1) {
//                $string_dias_horarios .= implode(",", $lunes) . "-";
//                echo '<br>';
//                $lunes_formateado = '';
//            } else {
//                $msg .= " " . $dia;
//            }
//        if ($martes) {
//            $dia = 'martes';
//            // var_dump($lunes);
//            if (count($martes) != 1) {
//                $string_dias_horarios .= implode(",", $martes) . "-";
//                echo '<br>';
//            } else {
//                $msg .= " " . $dia;
//            }
//        }
//        if ($miercoles) {
//            $dia = 'miercoles';
//            // var_dump($lunes);
//            if (count($miercoles) != 1) {
//                $string_dias_horarios .= implode(",", $miercoles) . "-";
//                echo '<br>';
//            } else {
//                $msg .= " " . $dia;
//            }
//        }
//
//        //quitamos el ultimo caracter
//        $string_dias_horarios = substr($string_dias_horarios, 0, -1);
//
//        $msg3 = graba_idioma_preferencias($idioma, $string_dias_horarios);
//    } else {
//        $msg2 = "Tiene que seleccionar al menos un dia y horario";
//    }
//}

//Hacemos la consulta si ya tiene preferencias e idioma en la BD para llenar en la tabla
/*$array_disponibilidad_verificado = verifica_preferencia();
if(!empty($array_disponibilidad_verificado['vacio'])) {
    $msg4 = "no hay preferencias";
}else{
    $disponibilidad_idioma = $array_disponibilidad_verificado['disponibilidad_idioma'];
    $disponibilidad_preferencias = $array_disponibilidad_verificado['disponibilidad_preferencias'];
    //dividimos la cadena
    $cadena_dias= '';
    $cadena_horarios = '';
    $cadena_dias = explode('-',$disponibilidad_preferencias);
    for ($i=0;$i<count($cadena_dias);$i++){
        //sepramos el dia de las horas de la cadena que analizamos
        $separa_dia = explode(',',$cadena_dias[$i]);
        //nos quedamos con el indice0 porque sabemos que ese es el dia
        for ($j=0;j<count($separa_dia);$j++){
            if ($j==0){
                $dia_separado = $separa_dia[0];
            }else{
                $horario_separado = explode(',',$separa_dia[$j]);

            }
        }

    }*/


?>

<?php
require_once('includes/head_pan_control.php');
?>
<script type="text/javascript" src="includes/includes_js/jquery-3.5.1.min.js"></script>
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
            <form id="form_validation" action="teach.php" method="post" class="form-horizontal form-box remove-margin"
                  onsubmit="return validacion()">
                <!-- Form Header -->
                <h4 class="form-box-header">Idioma para ensenar </h4>

                <!-- Form Content -->
                <div class="form-box-content">

                    <div class="form-group">
                        <label class="control-label col-md-2" for="selecciona_idioma">Idioma</label>
                        <div class="col-md-2">
                            <select id="selecciona_idioma" name="selecciona_idioma" class="form-control">
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

                        <div class="col-md-10">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-left"><i class="fa fa-calendar"></i> Dia</th>
                                    <th class="text-sm-left"><i class="fa fa-sun-o"></i> Manana</th>
                                    <th class="text-sm-left"><i class="fa fa-moon-o"></i> Tarde</th>


                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td class="text-left"><label id="label_lunes"><input type="checkbox"
                                                                                         name="check_lunes[]"
                                                                                         id="check_lunes[]"
                                                                                         onchange="showContent('check_lunes[]');"
                                                                                         value="lunes"> Lunes
                                            <Div id="id_fantasma" class="fantasma"> Mi texto oculto</div>
                                        </label>
                                        <p name="check_lunes[]" style="display:none; color:red">Seleccione horario</p>
                                    </td>

                                    <td class=" text-left">
                                        <select name="check_lunes[]" class="form-control">
                                            <option value="no_horario">--:-- - --:--</option>
                                            <option value="8">08:00 h.</option>
                                            <option value="9">09:00 h.</option>
                                            <option value="10">10:00 h.</option>
                                            <option value="11">11:00 h.</option>
                                            <option value="12">12:00 h.</option>
                                            <option value="13">13:00 h.</option>

                                        </select>
                                        <select name="check_lunes[]" class="form-control">
                                            <option value="no_horario">--:-- - --:--</option>
                                            <option value="9">09:00 h.</option>
                                            <option value="10">10:00 h.</option>
                                            <option value="11">11:00 h.</option>
                                            <option value="12">12:00 h.</option>
                                            <option value="13">13:00 h.</option>
                                            <option value="14">14:00 h.</option>


                                        </select>
                                    </td>
                                    <td class=" text-left">
                                        <select name="check_lunes[]" class="form-control">
                                            <option value="no_horario">--:-- - --:--</option>
                                            <option value=" 14">14:00 h.</option>
                                            <option value=" 15">15:00 h.</option>
                                            <option value=" 16">16:00 h.</option>
                                            <option value=" 17">17:00 h.</option>
                                            <option value=" 18">18:00 h.</option>
                                            <option value=" 19">19:00 h.</option>
                                            <option value=" 20">20:00 h.</option>
                                            <option value=" 21">21:00 h.</option>

                                        </select>
                                        <select name="check_lunes[]" class="form-control">
                                            <option value="no_horario">--:-- - --:--</option>
                                            <option value="15">15:00 h.</option>
                                            <option value="16">16:00 h.</option>
                                            <option value="17">17:00 h.</option>
                                            <option value="18">18:00 h.</option>
                                            <option value="19">19:00 h.</option>
                                            <option value="20">20:00 h.</option>
                                            <option value="21">21:00 h.</option>
                                            <option value="22">22:00 h.</option>


                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left"><label><input type="checkbox" name="check_martes[]"
                                                                        id="check_martes[]"
                                                                        onchange="showContent('check_martes[]');"
                                                                        value="martes"> Martes
                                            <Div class="fantasma"
                                            "> Mi texto oculto
                        </div>
                        </label>
                        <p name="check_martes[]" style="display:none; color:red">Seleccione horario</p>

                        </td>

                        <td class=" text-left">
                            <select name="check_martes[]" class="form-control">
                                <option value="no_horario">--:-- - --:--</option>
                                <option value="8">08:00 h.</option>
                                <option value="9">09:00 h.</option>
                                <option value="10">10:00 h.</option>
                                <option value="11">11:00 h.</option>
                                <option value="12">12:00 h.</option>
                                <option value="13">13:00 h.</option>

                            </select>
                            <select name="check_martes[]" class="form-control">
                                <option value="no_horario">--:-- - --:--</option>
                                <option value="9">09:00 h.</option>
                                <option value="10">10:00 h.</option>
                                <option value="11">11:00 h.</option>
                                <option value="12">12:00 h.</option>
                                <option value="13">13:00 h.</option>
                                <option value="14">14:00 h.</option>


                            </select>
                        </td>
                        <td class=" text-left">
                            <select name="check_martes[]" class="form-control">
                                <option value="no_horario">--:-- - --:--</option>
                                <option value=" 14">14:00 h.</option>
                                <option value=" 15">15:00 h.</option>
                                <option value=" 16">16:00 h.</option>
                                <option value=" 17">17:00 h.</option>
                                <option value=" 18">18:00 h.</option>
                                <option value=" 19">19:00 h.</option>
                                <option value=" 20">20:00 h.</option>
                                <option value=" 21">21:00 h.</option>

                            </select>
                            <select name="check_martes[]" class="form-control">
                                <option value="no_horario">--:-- - --:--</option>
                                <option value="15">15:00 h.</option>
                                <option value="16">16:00 h.</option>
                                <option value="17">17:00 h.</option>
                                <option value="18">18:00 h.</option>
                                <option value="19">19:00 h.</option>
                                <option value="20">20:00 h.</option>
                                <option value="21">21:00 h.</option>
                                <option value="22">22:00 h.</option>


                            </select>
                        </td>
                        </tr>
                        <tr>
                            <td class="text-left"><label><input type="checkbox" name="check_miercoles[]"
                                                                id="check_miercoles[]"
                                                                onchange="showContent('check_miercoles[]');"
                                                                value="miercoles"> Miercoles
                                    <Div class="fantasma"
                                    "> Mi texto oculto
                    </div>
                    </label>
                    <p name="check_miercoles[]" style="display:none; color:red">Seleccione horario</p>

                    </td>

                    <td class=" text-left">
                        <select name="check_miercoles[]" class="form-control">
                            <option value="no_horario">--:-- - --:--</option>
                            <option value="8">08:00 h.</option>
                            <option value="9">09:00 h.</option>
                            <option value="10">10:00 h.</option>
                            <option value="11">11:00 h.</option>
                            <option value="12">12:00 h.</option>
                            <option value="13">13:00 h.</option>

                        </select>
                        <select name="check_miercoles[]" class="form-control">
                            <option value="no_horario">--:-- - --:--</option>
                            <option value="9">09:00 h.</option>
                            <option value="10">10:00 h.</option>
                            <option value="11">11:00 h.</option>
                            <option value="12">12:00 h.</option>
                            <option value="13">13:00 h.</option>
                            <option value="14">14:00 h.</option>


                        </select>
                    </td>
                    <td class=" text-left">
                        <select name="check_miercoles[]" class="form-control">
                            <option value="no_horario">--:-- - --:--</option>
                            <option value=" 14">14:00 h.</option>
                            <option value=" 15">15:00 h.</option>
                            <option value=" 16">16:00 h.</option>
                            <option value=" 17">17:00 h.</option>
                            <option value=" 18">18:00 h.</option>
                            <option value=" 19">19:00 h.</option>
                            <option value=" 20">20:00 h.</option>
                            <option value=" 21">21:00 h.</option>

                        </select>
                        <select name="check_miercoles[]" class="form-control">
                            <option value="no_horario">--:-- - --:--</option>
                            <option value="15">15:00 h.</option>
                            <option value="16">16:00 h.</option>
                            <option value="17">17:00 h.</option>
                            <option value="18">18:00 h.</option>
                            <option value="19">19:00 h.</option>
                            <option value="20">20:00 h.</option>
                            <option value="21">21:00 h.</option>
                            <option value="22">22:00 h.</option>


                        </select>
                    </td>
                    </tr>

                    </tbody>
                    </table>

                </div>
        </div>

        <div class=" form-group form-actions">
            <div class="col-md-10 col-md-offset-2">
                <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Borrar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
                <div style="color: red">
                    <?php
                    //                    if ($msg != "") {
                    //                        echo $mensaje_seleccionar . " " . $msg . '<br>';
                    //                    }
                    if ($msg != '') {
                        echo 'preferencias grabadas';
                    }
                    //                    if ($msg2 != "") {
                    //                        echo $msg2 . '<br>';
                    //                        # code...
                    //                    }
                    //                    if ($msg3 != "") {
                    //                        echo $msg3 . '<br>';
                    //                        # code...
                    //                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
    <!-- END Form Content -->
    </form>
    <!-- END Form Teach language -->


    <!-- Datatables in the grid -->
    <h3 class="page-header">Horarios seleccionados </h3>

    <div class="row">
        <div class="col-md-6 push">
            <table id="example-datatables2" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-left"><i class="fa fa-language"></i> Idioma</th>
                    <th class="text-left"><i class="fa fa-calendar"></i> Dia y Horarios</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center"><?php if (isset($disponibilidad_idioma)): echo $disponibilidad_idioma;
                        endif; ?>
                    </td>
                    <td class="text-center"> <?php if (isset($nuevo_array)):

                            for ($i = 0; $i < count($nuevo_array); $i++) {
                                echo $nuevo_array[$i] . '<br>';
                            }

                        endif; ?> </td>
                    <td class="text-center"></td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>
    <!-- END Datatables in the grid -->


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
<!--[if lte IE 8]>
<script src="js/helpers/excanvas.min.js"></script><![endif]-->

<!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    !window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));
</script>

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