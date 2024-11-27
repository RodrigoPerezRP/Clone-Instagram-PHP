<?php

    include 'conexion.php';

    
    $nombre = strtolower($_POST['nombre']);
    $apellido = strtolower($_POST['apellido']);
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    $genero = $_POST['genero'];
    $usuarios = mysqli_query($con,"select email from usuario");
    
    $existe = False;

    while ($reg = mysqli_fetch_array($usuarios)) {
        if ($reg['email'] === $email) {
            $existe = True;
        }
    }

    session_start();

    if ($existe == True) {
        header('Location: registerForm.php');
        $_SESSION['existe'] = True;
    }else{
        $_SESSION['existe'] = False;
        $usuario = mysqli_query($con,"insert into usuario (nombre,apellido,email,password,genero,fecha_nac,descripcion,imagen) 
                            values ('$nombre','$apellido','$email','$password','$genero',' ','I dont have description','imagesProfile/default.jpg')"); 
                            
        header('Location: index.php');
        
    }

    
    

?>