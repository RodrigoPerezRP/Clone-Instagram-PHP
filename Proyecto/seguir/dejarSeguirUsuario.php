<?php
    session_start();
    include '../conexion.php';

    $usuario = $_SESSION['idUsuario'];
    $usuarioSeguido = $_POST['idUsuario'];

    echo $usuario;
    echo "<br> $usuarioSeguido" . "<br><br>";

    $seguidores = mysqli_query($con,"delete from seguidores where idSeguidor=$usuario and idSeguido=$usuarioSeguido");

    $_SESSION['usuarioId'] = $usuarioSeguido;
    header("Location: ../profile.php");
?>