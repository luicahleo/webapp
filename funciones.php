<?php

$mysqli = mysqli_connect("localhost","admin_solucian","121212","admin_intercambio_linguistico");

if ($mysqli==false){
  echo "Hubo un problema al conectarse a María DB";
  die();
}





function obtener_imagen_usuario(){
  //traemos la conexión (global) a un ambito local (dentro de la función);
  $mysqli = $GLOBALS['mysqli'];

  // consulta para traer los promedios peso maximo y la cuenta
  $consulta = "SELECT `usuarios_imagen` FROM `usuarios` WHERE `usuarios_id` = '".$_SESSION['usuarios_id']."'";
  $resultado = $mysqli->query($consulta);
  $fila = $resultado->fetch_assoc();

  $ruta = $fila['usuarios_imagen'];
  return $ruta;
}

function graba_imagen($archivo){
  $mysqli = $GLOBALS['mysqli'];

  $msg = "";

  $target_dir = "archivos/";
  $target_file = $target_dir . basename($archivo["val_image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


  // ya hay una archivo que existe con ese nombre?
  if (file_exists($target_file)) {
    $msg .= "La imagen ya existe. <br>";
    $uploadOk = 1;
  }

  // Tamaño máximo de la imagen
  if ($archivo["val_image"]["size"] > 5000000) {
    $msg .= "Lo siento, el archivo es muy grande.<br>";
    $uploadOk = 0;
  }

  // Formatos autorizados
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $msg .= "Lo siento solo JPG, JPEG, PNG & GIF está permitido. <br>";
    $uploadOk = 0;
  }

  // Si upload ok es 0 entonces hubo un error
  if ($uploadOk == 0) {
    $msg .= "Lo siento la imagen no puedo subirse.<br>";
    // si todo está bien guardamos la imagen
  } else {
    if (move_uploaded_file($archivo["val_image"]["tmp_name"], $target_file)) {
      //$msg_uploaded .= "La imagen  ". basename($archivo["val_image"]["name"]). " ha sido subida.";
      $mysqli->query("UPDATE `usuarios` SET `usuarios_imagen`= '".$target_file."' WHERE `usuarios_id` = '".$_SESSION['usuarios_id']."' ");
      //return $msg_uploaded;
    } else {
      $msg .= "Lo siento, hubo un error a la hora de grabar en disco la imagen.<br>";
    }
  }

  return $msg;

}


function save_teach_data($data_teach){
  $mysqli = $GLOBALS['mysqli'];

  $msg = "";

  echo "<pre>";
  print_r($data_teach);
  //die();
  echo "</pre>";

  foreach ($data_teach as $data => $value) {
    
    echo $data . " ". $value . "<br>";

    $language = $_POST['select-language'];
    
    
    

    echo "$language ";

    //$mysqli->query("UPDATE `teach` SET `teach_language`= '".$target_file."' WHERE `usuarios_id` = '".$_SESSION['usuarios_id']."' ");




  }





}
/* para crear un usuario nuevo con clave para podernos conectar desde el exterior
GRANT ALL PRIVILEGES ON *.* TO 'USERNAME'@'%' IDENTIFIED BY 'PASSWORD' WITH GRANT OPTION;
*/

?>