<?php
 $usuarios = mysqli_query($con, "select nombre from usuario where idUsuario=$notificacion[idUsuarioE]");
                      $titulos = mysqli_query($con, "select titulo from post where idPost=$notificacion[idPost]");
                      if ($usuario = mysqli_fetch_array($usuarios)) {
                        echo "<p class='mb-3 text-justify'><span class='text-blue-500'>$usuario[nombre]</span> ha comentado en tu publicación";
                      }
?>