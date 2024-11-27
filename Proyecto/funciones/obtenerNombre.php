<?php


    function obtenerNombreUsuario($con,$idUsuario) {


    $nombre = mysqli_query($con,"select nombre from usuario where idUsuario=$idUsuario");
    
    if ($nombre = mysqli_fetch_array($nombre)) {
        return $nombre['nombre'];
    } else {
        return $idUsuario;
    }
}
?>
