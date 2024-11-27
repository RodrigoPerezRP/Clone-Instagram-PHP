<?php
    session_start();

    if (isset($_SESSION['idUsuario'])) {
        include '../funciones/eliminarComentario.php';
        include '../conexion.php';
        $comentario = $_POST['id'];
    
        if (isset($comentario)) {
            eliminarComentario("Location: ./postSeguidos.php",$con,$comentario);
        }else{
            header("Location: ./postSeguidos.php");
        }
    }else{
        header("Location: ../principal.php");
    }

    
?>