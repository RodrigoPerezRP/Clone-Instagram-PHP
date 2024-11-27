<?php
session_start();

if (isset($_SESSION['idUsuario'])) {

    include '../conexion.php';

    $timestamp = time();
    $target_dir = "imagesPost/";
    $image = $target_dir ."$timestamp" . $_FILES["imagen"]["name"];
    $valido = False;
    $formatos = ['jpg','jpeg','png','jfif','mp4','avi','mov','wmv','flv','mkv','mpeg'];
    $formatoArchivo = substr($image,strlen($image)-6);
    $formatoArchivo = substr($formatoArchivo,strpos($formatoArchivo,"."));


    foreach ($formatos as $k => $v) {
        if ($formatoArchivo ==  "." . $v) {
            $valido = True;
            
        }
    }

    echo $formatoArchivo;

    echo "<br>" . $valido;


    if ($valido) {
        if (move_uploaded_file($_FILES['imagen']['tmp_name'],$target_dir."$timestamp".$_FILES["imagen"]["name"])) {
        }else{
        }
    }else{
        header("Location: crearPostForm.php");
    }



    if ($valido) {
        $fecha = date("20y-m-d");
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $idUsuario = $_SESSION['idUsuario'];
    
       $post = mysqli_query($con, "insert into post(titulo,descripcion,fecha_creacion,imagen,idUsuario) 
       value ('$titulo','$descripcion','$fecha','$image','$idUsuario')");
    
    
        $_SESSION['alerta'] = True;
        header("Location: ../myProfile.php");
    }else{
        $_SESSION['noValido'] = False;
        header("Location: crearPostForm.php");
    }


} else {
    header("Location: ../index.php");
}
