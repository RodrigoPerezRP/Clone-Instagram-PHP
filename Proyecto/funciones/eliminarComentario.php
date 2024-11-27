<?php
    function eliminarComentario($localizacion,$con,$comentario){
        $usuario = $_SESSION['idUsuario'];
        $comentarios = mysqli_query($con,"delete from comentario where idComentario='$comentario' and idUsuario='$usuario' ");

        header($localizacion);

    }
?>