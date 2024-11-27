<?php
session_start();
if (isset($_SESSION['idUsuario'])) {
} else {
  header("Location: ../index.php");
}
?>


<!-- This is an example component -->
<html lang="en" class="">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=">
  <?php
  include '../componentes/tailwind.php';
  include '../conexion.php';

  $clientes = mysqli_query($con, "select idUsuario,nombre,imagen from usuario");
  ?>
  <title>Instagram</title>
  <link rel="icon" href="../imagenes/instagram.svg" type="image/png">
</head>
<style>
  .container {
    max-width: 935px;
  }
</style>

<body class="relative bg-gray-100 h-full">
  <?php
  include 'sidebarSeguidos.php';
  ?>


  <!-- Flotante derecha -->

  <div class=" ml-auto absolute float-right right-12 py-14 ">
    <form action="../profile.php" method="POST" class="w-full">
      <div class="flex flex-col border p-5 border-1 py-2 max-w-6xl w-96 shadow-2xl bg-[conic-gradient(at_top,_var(--tw-gradient-stops))] from-rose-100 to-teal-100 rounded-3xl">
        <?php
        while ($cliente = mysqli_fetch_array($clientes)) {
          if ($cliente['idUsuario'] == $_SESSION['idUsuario']) {
          } else {
            echo "<div class='flex gap-x-5 p-2 justify-center items-center'>";
            echo "<img src='../$cliente[imagen]' class='object-cover rounded-full' style='width:40px;height:40px;'>";
            echo "<p class='capitalize'>$cliente[nombre]</p>";
            echo "<button type='submit' name='id' value='$cliente[idUsuario]' class='capitalize ml-auto text-md font-bold text-gray-900'>Ver mas</button>";
            echo "</div>";
          }
        }
        ?>
      </div>
    </form>
  </div>


  <!-- Flotante derecha end -->

  <div class="flex">
    <?php

    /*Solo visualizar post de los que sigo
        

        
        */


    $usuario = $_SESSION['idUsuario'];

    $usuariosSeguidos = mysqli_query($con, "select idSeguido from seguidores where idSeguidor=$usuario");
    $cantidadSeguidos = 0;
    $cantidadPost = 0;
    while ($usuarioSeguido = mysqli_fetch_array($usuariosSeguidos)) {
      $cantidadSeguidos++;
      echo $usuarioSeguido['idSeguido'] . "<br>";

      $posts = mysqli_query($con, "select * from post where idUsuario=$usuarioSeguido[idSeguido] order by idPost desc");
      while ($post = mysqli_fetch_array($posts)) {
        $cantidadPost++;
        include 'feedlike.php';
      }
    }

    if ($cantidadSeguidos <= 0) {
    ?>
      <div class="w-full h-screen mx-auto justify-center">
        <div class="lg:px-96 px-4 items-center flex justify-center flex-col-reverse lg:flex-row">
          <div class="px-20 xl:pt-24 w-full mx-auto relative pb-12  justify-center lg:pb-0">
            <div class="relative">
              <div class="absolute">
                <div class="">
                  <h1 class="my-8 text-gray-800 font-bold text-2xl">
                    Parece Que no Sigues a nadie!
                  </h1>
                  <p class="my-12 text-gray-800">Al parecer No sigues a nadie. Sigue a alguien para ver sus publicaciones</p>
                  <a href="../principal.php" class="sm:w-full lg:w-auto border rounded md py-4 px-8 text-center bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-opacity-50">Sigue a mas personas</a>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-64">
            <img src="https://i.ibb.co/ck1SGFJ/Group.png" />
          </div>
        </div>
      </div>

    <?php
    }

    if ($cantidadSeguidos > 0 && $cantidadPost <= 0) {
      ?>
      <div class="w-full h-screen mx-auto justify-center">
        <div class="lg:px-96 px-4 items-center flex justify-center flex-col-reverse lg:flex-row">
          <div class="px-20 xl:pt-24 w-full mx-auto relative pb-12  justify-center lg:pb-0">
            <div class="relative">
              <div class="absolute">
                <div class="">
                  <h1 class="my-8 text-gray-800 font-bold text-2xl">
                    Parece Que nadie publico Nada!
                  </h1>
                  <p class="my-12 text-gray-800">Al parecer Los usuarios a los que sigues No publicaron Nada!</p>
                  <a href="../principal.php" class="sm:w-full lg:w-auto border rounded md py-4 px-8 text-center bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-opacity-50">Sigue a mas personas</a>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-64">
            <img src="https://i.ibb.co/ck1SGFJ/Group.png" />
          </div>
        </div>
      </div>

    <?php
    }


    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

</body>


</html>