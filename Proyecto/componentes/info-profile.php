      <div class="flex md:flex-row-reverse justify-center mx-auto">
        <div class="p-4 text-center justify-center mx-12">
          <div class="text-left pl-4 pt-3 flex items-center">
            <span class="text-base text-gray-700 text-2xl mr-2 capitalize font-semibold"><?php
                                                                                          echo $reg['nombre'];
                                                                                          ?></span>
            <?php
            if ($_SESSION['nombre'] == $reg['nombre']) {
            ?>
              <span class="text-base font-semibold text-gray-700 mr-2">
                <a href="editProfileForm.php" class="bg-transparent hover:bg-blue-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-600 hover:border-transparent rounded">Edit Profile</a>
              </span>

              <span class="text-base font-semibold text-gray-700">
                <a href="post/crearPostForm.php" class="bg-transparent hover:bg-blue-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-600 hover:border-transparent rounded">Create Post</a>
              </span>

              <?php
              ?>


            <?php
            } else {
            ?>
              <?php
              $usuario = $_SESSION['idUsuario'];
              $usuarioSeguido = $reg['idUsuario'];

              $seguidores = mysqli_query($con, "select * from seguidores where idSeguidor=$usuario and idSeguido=$usuarioSeguido");

              if ($seguidor = mysqli_fetch_array($seguidores)) {
              ?>
                <form action="seguir/dejarSeguirUsuario.php" method="POST">
                  <input type="hidden" name="idUsuario" value="<?php echo $reg['idUsuario'] ?>">
                <?php

                echo "<button class='bg-red-500 px-3 py-2 text-sm shadow-sm font-medium tracking-wider  text-red-100 rounded-lg hover:shadow-2xl hover:bg-red-600'>UnFollow</button>";
                echo "</form>";
              } else {
                ?>
                  <form action="seguir/seguirUsuario.php" method="POST">
                    <input type="hidden" name="idUsuario" value="<?php echo $reg['idUsuario'] ?>">
                  <?php
                  echo "<button class='px-3 py-2 rounded-lg text-sm shadow-sm font-medium tracking-wider  bg-blue-500 text-white' hover:shadow-2xl hover:bg-red-600'>Follow</button>";
                  echo "</form>";
                }
                  ?>


                  </form>
                <?php
              }
                ?>

          </div>

          <div class="text-left pl-4 pt-3">
            <span class="text-base font-semibold text-gray-700 mr-2">
              <b>

                <?php

                $canPost = mysqli_query($con, "select idPost from post where idUsuario=$reg[idUsuario]");

                $numeroPost = 0;

                while ($cantidad = mysqli_fetch_array($canPost)) {
                  $numeroPost++;
                }

                echo $numeroPost;

                ?>

              </b> posts
            </span>
            <span class="text-base font-semibold text-gray-700 mr-2">
              <b>

                <?php
                $seguidores = mysqli_query($con, "select idSeguidores from seguidores where idSeguido=$reg[idUsuario]");

                $numeroSeguidores = 0;

                while ($cantidad = mysqli_fetch_array($seguidores)) {
                  $numeroSeguidores++;
                }

                echo $numeroSeguidores;
                ?>

              </b> followers
            </span>
            <span class="text-base font-semibold text-gray-700">
              <b>

                <?php
                $seguidos = mysqli_query($con, "select idSeguidores from seguidores where idSeguidor=$reg[idUsuario]");

                $numeroSeguidos = 0;

                while ($cantidad = mysqli_fetch_array($seguidos)) {
                  $numeroSeguidos++;
                }

                echo $numeroSeguidos;
                ?>


              </b> following
            </span>
          </div>

          <div class="text-left pl-4 pt-3">
            <span class="text-lg font-bold text-gray-700 mr-2 capitalize"><?php
                                                                          echo $reg['nombre'] . " " . $reg['apellido'];
                                                                          ?></span>
          </div>

          <div class="text-left pl-4 pt-3">
            <p class="text-base font-medium text-blue-700 mr-2"><?php
                                                                echo $reg['descripcion'];
                                                                ?></p>
            <p class="text-base font-medium text-gray-700 mr-2">localhost/<?php echo $reg['nombre'] . $reg['apellido'] ?></p>
          </div>
        </div>

        <div class="p-4 text-center">
          <div class=" relative md:w-3/4 text-center mt-8">
            <button class="flex rounded-full" id="user-menu" aria-label="User menu" aria-haspopup="true">
              <img class="h-40 w-52 rounded-full object-cover" src="<?php echo $reg['imagen'] ?>" alt />
            </button>
          </div>
        </div>
      </div>

      <?php
      include 'componentes/post.php';
      ?>