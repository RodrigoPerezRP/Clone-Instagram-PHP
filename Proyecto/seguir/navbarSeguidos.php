<nav class="bg-white shadow px-48 border-b border-gray-400">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex px-2 lg:px-0">
                <a href="../principal.php" class="flex-shrink-0 flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="block lg:hidden h-8 w-auto" src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png" alt="Workflow logo" />

                        <img class="hidden lg:block h-8 w-auto" src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png" alt="Workflow logo" />

                    </div>
                </a>
            </div>

            <div class="flex items-center lg:hidden">
            </div>
            <!-- icons-->
            <div class="lg:ml-4 lg:flex lg:items-center">

                <a href="../seguir/postSeguidos.php" class="flex-shrink-0 p-1 border-transparent text-gray-700 rounded-full hover:text-gray-600 focus:outline-none focus:text-gray-600 transition duration-150 ease-in-out" aria-label="Notifications">
                    <img src="../imagenes/corazon.png" class="w-5 h-5" alt="">
                </a>


                <div x-data="{ open: false }" class="relative inline-block">
                    <button @click="open = true" class="flex items-center justify-center p-1  focus:outline-none " aria-label="More options">
                        <img src="../imagenes/notification.png" class="w-7 h-7" alt="">
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-5 p-4 bg-white border border-gray-300 rounded-lg shadow-lg  items-center z-10 w-96">

                        <?php

                        include '../conexion.php';

                        $myId = $_SESSION['idUsuario'];

                        $notificaciones = mysqli_query($con, "select * from notificaciones where idUsuarioR=$myId");
                        $cantidadNotificaciones = 20;
                        if ($noti = mysqli_fetch_array($notificaciones)) {
                            while ($notificacion = mysqli_fetch_array($notificaciones)) {

                                $usuarios = mysqli_query($con, "select nombre from usuario where idUsuario=$notificacion[idUsuarioE]");
                                $titulos = mysqli_query($con, "select titulo from post where idPost=$notificacion[idPost]");
                                if ($usuario = mysqli_fetch_array($usuarios)) {
                                    echo "<p>$usuario[nombre] a comentado en tu publicacion  ";
                                }
    
                                if ($titulo = mysqli_fetch_array($titulos)) {
                                    echo "$titulo[titulo] </p>";
                                }
                                $cantidadNotificaciones++;
                            }
                        }else{
                            echo "No tienes Notificaciones 😔";
                        }

                        ?>

                    </div>
                </div>


                <div class="ml-4 relative flex flex-shrink-0">
                    <div class="flex items-center">
                        <button class="flex rounded-full border-gray-700 transition duration-150 ease-in-out font-semibold text-gray-700" id="user-menu" aria-label="User menu" aria-haspopup="true">
                            <img class="h-8 w-8 rounded-full mr-2" src="<?php echo $_SESSION['avatar'] ?>" alt />
                            <a href="../myProfile.php" class="capitalize"><?php echo $_SESSION['nombre'] ?></a>
                            </form>
                        </button>
                        <a href="../logout.php" class="mx-3 px-3 py-2 bg-blue-500 text-light text-white rounded-xl">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>