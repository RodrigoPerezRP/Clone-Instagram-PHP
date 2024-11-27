<?php
    session_start();
    if (isset($_SESSION['idUsuario'])) {
        include "../conexion.php";
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $idPost = $_POST['id'];
        $idUsuario = $_SESSION['idUsuario'];
    
        $data = mysqli_query($con,"select fecha_creacion,imagen from post where idPost=$idPost");
    
        if($post = mysqli_fetch_array($data)){
          $fec_created = $post['fecha_creacion'];

        }
    
    
        $timestamp = time();
        $target_dir = "imagesPost/";
        $valido = False;
        $formatos = ['jpg','jpeg','png','jfif','mp4','avi','avif','mov','wmv','flv','mkv','mpeg'];


        if ($_FILES["imagen"]["name"]) {
            $image = $target_dir ."$timestamp" . $_FILES["imagen"]["name"];
            $formatoArchivo = substr($image,strlen($image)-6);
            $formatoArchivo = substr($formatoArchivo,strpos($formatoArchivo,"."));
        }else{
            $image = $_SESSION['imagen'];
            $formatoArchivo = substr($image,strlen($image)-6);
            $formatoArchivo = substr($formatoArchivo,strpos($formatoArchivo,"."));
        }


        foreach ($formatos as $k => $v) {
            if ($formatoArchivo == "." . $v) {
                $valido = True;
            }
        }
        echo $formatoArchivo . "<br>";
    
        if ($valido) {
            if (move_uploaded_file($_FILES['imagen']['tmp_name'],$target_dir."$timestamp".$_FILES["imagen"]["name"])) {
            }
        }else{
            $idPost = $_POST['id'];
            $_SESSION["idPostError"] = $idPost;
            $_SESSION['alertaNoValido'] = False;    
            header("Location: ../principal.php");
        }
    

        if ($valido) {
            $act_post = mysqli_query($con,"update post set 
            idPost='$idPost',
            titulo='$titulo',
            descripcion='$descripcion',
            fecha_creacion='$fec_created',
            imagen='$image'
            where idUsuario='$idUsuario' and idPost='$idPost'
            ");
            $_SESSION['noValido'] = False;
            header('Location: ../principal.php');
        }else{
            $_SESSION['alertaNoValido'] = True;
            header("Location: ../principal.php");
        }


       

    }else{
        header('Location: ../../principal.php');

    }
?>