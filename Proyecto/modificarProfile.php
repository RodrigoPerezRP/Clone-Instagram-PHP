<?php
    session_start();
    if (isset($_SESSION['idUsuario'])) {
        include "conexion.php";
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $descripcion = $_POST['descripcion'];
        $idUsuario = $_SESSION['idUsuario'];
        $valido = False;
        $target_dir = "imagesProfile/";
        $formatos = ['jpg','jpeg','png','jfif',"avif"];
        
        if ($_FILES["imagen"]["name"]) {
            $timestamp = time();
            $image = $target_dir . $timestamp . $_FILES['imagen']['name'];
        }else{
            $image = $_SESSION['imagen'];
        }

        $formatoArchivo = substr($image,strpos($image,'.',4));


        foreach ($formatos as $k => $v) {
            if ($formatoArchivo == "." . $v) {
                $valido = True;
            }
        }

        if ($valido) {
            echo "Es valido";
            if (move_uploaded_file($_FILES['imagen']['tmp_name'],$target_dir. "$timestamp" . $_FILES["imagen"]["name"])) {
            }
        }else{
            header("Location: principal.php");
        }
        

         if ($valido) {
             $act_post = mysqli_query($con,"update usuario set 
             nombre='$nombre',
             apellido='$apellido',
             descripcion='$descripcion',
             imagen='$image'
             where idUsuario='$idUsuario'
             ");
             unset($_SESSION['imagen']);
             header('Location: principal.php');
         }else{
             header("Location: principal.php");
         }


       

    }else{
        header('Location: principal.php');

    }
