<!-- This is an example component -->
<html lang="en" class="">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=">
  <?php
  include 'componentes/tailwind.php';
  include 'conexion.php';
  $clientes = mysqli_query($con, "select idUsuario,nombre,imagen from usuario");
  ?>
  <title>Instagram</title>
  <link rel="icon" href="imagenes/instagram.svg" type="image/png">
</head>
<style>
  .container {
    max-width: 935px;
  }
</style>

<body class="relative  h-full ">
      <?php
      include 'componentes/sidebar.php';
      ?>


      <!-- Flotante derecha -->

      <div class=" ml-auto absolute float-right right-12 py-14 ">
        <form action="profile.php" method="POST" class="w-full">
          <div class="flex flex-col border p-5 border-1 py-2 max-w-6xl w-96 shadow-2xl bg-[conic-gradient(at_top,_var(--tw-gradient-stops))] from-rose-100 to-teal-100 rounded-3xl">
            <?php
            while ($cliente = mysqli_fetch_array($clientes)) {
              if ($cliente['idUsuario'] == $_SESSION['idUsuario']) {
              } else {
                echo "<div class='flex gap-x-5 p-2 justify-center items-center'>";
                echo "<img src='$cliente[imagen]' class='object-cover rounded-full' style='width:40px;height:40px;'>";
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


      <!-- -->




      <!-- -->



      <div class="flex ">
        <?php

        $posts = mysqli_query($con, "select * from post order by idPost desc ");
        while ($post = mysqli_fetch_array($posts)) {
          include 'feed.php';
        }

        ?>

      </div>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>