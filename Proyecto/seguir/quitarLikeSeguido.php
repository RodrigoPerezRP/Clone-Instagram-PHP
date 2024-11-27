<?php
    session_start();
    include '../conexion.php';
    echo $_POST['idPost'];
    echo $_SESSION['idUsuario'];

    $idPost = $_POST['idPost'];
    $idUsuario = $_SESSION['idUsuario'];

    $likes = mysqli_query($con,"delete from likes where idPost=$idPost and idUsuario=$idUsuario");

    header("Location: postSeguidos.php");


?>