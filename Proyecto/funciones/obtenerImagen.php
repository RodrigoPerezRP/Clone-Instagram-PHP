<?php


    function obtenerImagen($con,$idUsuario) {


    $imagenes = mysqli_query($con,"select imagen from usuario where idUsuario=$idUsuario");
    
    if ($imagen = mysqli_fetch_array($imagenes)) {
        return $imagen['imagen'];
    } else {
        return $idUsuario;
    }
}
?>
