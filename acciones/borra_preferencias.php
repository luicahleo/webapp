<?php

require_once 'includes/conection.php';
if (isset($_SESSION['usuario'])){

    $usuario_id = $_SESSION['usuario_id'];
    $sql = "DELETE FROM disponibilidad WHERE disponibilidad_usuario_id = $usuario_id";
    $borrar = mysqli_query($db, $sql);
}
header("Location: teach.php");
?>
