<?php
    session_start();
    if (isset($_SESSION['idUsuario'])) {
        ?>
        
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title style="text-transform:capitalize;">

                <?php

                echo "Instagram";
                ?>
            </title>
            <?php
            include 'componentes/tailwind.php';
            ?>
            <link rel="icon" href="imagenes/instagram.svg" type="image/png">
            <link rel="stylesheet" href="componentes/style.css">
        </head>

        <body>
            <div class="insta-clone">
                <?php
                include 'componentes/navbar.php';
                ?>

                <?php
                include 'conexion.php';

                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $_SESSION['usuarioId'] = $_POST['id'];
                }else{
                    $id = $_SESSION['usuarioId'];
                }

                $registro = mysqli_query($con, "select * from usuario where idUsuario=$id");

                if ($reg = mysqli_fetch_array($registro)) {
                    include 'componentes/info-profile.php';
                }

                ?>

            </div>
        </body>

        </html>
<?php    
    }else{
        header("Location: index.php");
    }
?>