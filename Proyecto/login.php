<?php

    include 'conexion.php';
    session_start();

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $registro = mysqli_query($con,"select * from usuario where email='$email' and password='$pass'");
    

    if($reg = mysqli_fetch_array($registro)){
        $_SESSION['idUsuario'] = $reg['idUsuario'];
        $_SESSION['nombre'] = $reg['nombre'];
        $_SESSION['apellido'] = $reg['apellido'];
        $_SESSION['genero'] = $reg['genero'];
        $_SESSION['fecha_nac'] = $reg['fecha_nac'];
        $_SESSION['descripcion'] = $reg['descripcion'];
        $_SESSION['avatar'] = $reg['imagen'];
        $_SESSION['alerta'] = False;
        header('Location: principal.php');
    }else{
        header('Location: index.php');
    }
?>