
<?php
    session_start();

    include '../conexion.php';
    
    $idPost = $_POST['id'];

    $_SESSION['postEliminado'] = True;
    echo $_SESSION['postEliminado'];
    $numeroPost = $idPost;
    $post = mysqli_query($con,"delete from post where idPost=$idPost");
    $notificaciones = mysqli_query($con,"delete from notificaciones where idPost=$numeroPost");
    $comentarios = mysqli_query($con,"delete from comentario where idPost=$numeroPost");
    $likes = mysqli_query($con,"delete from likes where idPost=$numeroPost");
    header('Location: ../../principal.php');

?>