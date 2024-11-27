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
          if ($_SESSION['alerta']) {
            echo "<script>";
            echo "window.onload = function() {";
            echo "  Swal.fire({";
            echo "    'icon': 'success',";
            echo "    'title': '¡Felicidades!',";
            echo "    'text': 'Post creado correctamente'";
            echo "  });";
            echo "}";
            echo "</script>";
          }
          $_SESSION['alerta'] = False;
    ?>

    <?php
        include 'conexion.php';

        $registro = mysqli_query($con, "select * from usuario where idUsuario=$_SESSION[idUsuario]");

        if ($reg = mysqli_fetch_array($registro)) {
            include 'componentes/info-profile.php';
        }
        
    ?>
    
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<?php
    }else{
        header("Location: index.php");
    }
?>

