<?php

    session_start();
    include '../conexion.php';

    $usuario = $_SESSION['idUsuario'];
    $usuarioSeguido = $_POST['idUsuario'];


    echo $usuario;
    echo "<br> $usuarioSeguido" . "<br><br>";

    $seguidores = mysqli_query($con,"insert into seguidores(idSeguidor,idSeguido) value
    ('$usuario','$usuarioSeguido')");

    $_SESSION['usuarioId'] = $usuarioSeguido;
    header("Location: ../profile.php");



?>