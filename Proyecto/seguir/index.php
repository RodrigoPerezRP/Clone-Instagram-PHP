<?php
    session_start();
    if(isset($_SESSION['idUsuario'])){
        header("Location: postSeguidos.php");
    }else{
        header("Location: ../index.php");
    }
?>