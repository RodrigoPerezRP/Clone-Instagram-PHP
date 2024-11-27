<?php
    include 'conexion.php';

    session_start();
    echo $_POST['idPost'] . "<br>";
    $comentario = $_POST['comentario'];
    echo "IdUsuario "  . $_SESSION['idUsuario'] . "<br>";
    echo $comentario;
    $idPost = $_POST['idPost'];
    $idUsuario = $_SESSION['idUsuario'];

    $comentarios = mysqli_query($con,"insert into comentario(idUsuario,idPost,contenido) value ('$idUsuario','$idPost','$comentario')");
    $usuarioRecibe = mysqli_query($con,"select idUsuario from Post where idPost=$idPost");


    

    if($userR = mysqli_fetch_array($usuarioRecibe)){
        if ($idUsuario == $userR['idUsuario']) {
            
        }else{
            $notificaciones = mysqli_query($con,"insert into notificaciones(idUsuarioE,idPost,idUsuarioR) value 
            ('$idUsuario','$idPost','$userR[idUsuario]')");
        }
    }

    header("Location: principal.php");
?>                                                                                                                                              