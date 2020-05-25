<?php
//conectar base de datos
$conexion = mysqli_connect("localhost","admin_solucian","121212","admin_intercambio_linguistico");

//comparar si conexion es correcta
if(mysqli_connect_errno()){
    echo "Conexion fallida: ".mysqli_connect_errno();
}else{
    echo "Conexion exitosa!!!".'<br>';
}

//Consulta para configurar la codificacion de caracteres
mysqli_query($conexion,"SET NAMES 'utf8'");

//Consulta SELECT desde PHP
$query = mysqli_query($conexion,"SELECT * FROM usuarios");


while($usuario = mysqli_fetch_assoc($query)){

    echo "<h2>".$usuario['usuarios_nombre'].'</h2>';
    echo $usuario['usuarios_email'].'<br/>';

    //var_dump($usuario);
    //echo'<br/><br/>';
    //print_r($usuario);

}




?>