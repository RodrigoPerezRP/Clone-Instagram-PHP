<?php
require_once '../funciones/obtenerNombre.php';
require_once '../funciones/obtenerImagen.php';
?>

<div class="feeds w-1/3 mx-auto pt-12">
    <div class="feed-wrapper ">
        <div class="feed-item rounded bg-gray-100">
            <div class="header p-4 flex justify-between items-center">
                <div class="bg-white shadow-2xl rounded-lg border-1 border-opacity-5">
                    <div class="flex flex-row px-2 py-3 mx-3">
                        <div class="w-auto h-auto rounded-full border-2  border-green-500 shadow-2xl">
                            <img class="w-12 h-12 object-cover rounded-full shadow cursor-pointer" alt="User avatar" src="../<?php echo obtenerImagen($con, $post['idUsuario']); ?>">
                        </div>
                        <div class="flex flex-col mb-2 ml-4 mt-1">
                            <div class="text-gray-600 text-sm font-semibold capitalize">
                                <?php
                                echo obtenerNombreUsuario($con, $post['idUsuario']);
                                ?></div>
                            <div class="flex w-full mt-1">
                                <div class="text-gray-400 font-thin text-xs">
                                    <?php echo $post['fecha_creacion'] ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($_SESSION['idUsuario'] == $post['idUsuario']) {
                            include './dropdownSeguido.php';
                        }
                        ?>
                    </div>
                    <div class="text-gray-400 font-medium text-sm mt-6 mx-3 px-2 object-cover">
                        <?php

                        $image = $post['imagen'];



                        $formatosVideo = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'mpeg'];
                        $formatosImagen = ['jpg', 'jpeg', 'png', 'jfif'];


                        $formato = substr($image, strlen($image) - 6);
                        $formato = substr($formato, strpos($formato, "."));



                        $esVideo = False;
                        $esImagen = False;

                        foreach ($formatosVideo as $key => $value) {
                            if ($formato == ".$value") {
                                $esVideo = True;
                            }
                        }

                        foreach ($formatosImagen as $key => $value) {
                            if ($formato == ".$value") {
                                $esImagen = True;
                            }
                        }




                        if ($esVideo) {
                        ?>
                            <video controls class="object-contain h-96" width="800" src="../post/<?php echo $post['imagen'] ?>">
                            <?php
                        }

                        if ($esImagen) {
                            ?>
                                <img class="object-contain h-96" width="800" src="../post/<?php echo $post['imagen'] ?>">
                            <?php
                        }

                            ?>
                            ?>
                    </div>
                    <div class="text-gray-600 font-semibold p-3 mx-3 px-2"><?php
                                                                            echo $post['titulo'];
                                                                            ?></div>
                    <div class="text-gray-500 text-sm  mx-3 px-2"><?php
                                                                    echo $post["descripcion"];
                                                                    ?></div>
                    <div class="flex justify-start ">
                        <div class="flex justify-start w-full mt-1 pt-2 pl-5">
                            <span class="transition ease-out duration-300 text-center  text-blue-400  cursor-pointer mr-4">
                                <svg aria-label="Comment" class="_8-yf5 cursor-pointer" id="comentario" fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                                    <path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path>
                                </svg>
                            </span>
                            <?php
                            $usuario = $_SESSION['idUsuario'];
                            $idPost = $post['idPost'];

                            $likes = mysqli_query($con, "select * from likes where idPost = $idPost and idUsuario = $usuario");

                            if ($like = mysqli_fetch_array($likes)) {
                            ?>
                                <form action="quitarLikeSeguido.php" method="POST" class="h-7 w-7">
                                    <input type="hidden" name="idPost" value="<?php echo $post['idPost'] ?>">
                                    <?php
                                    ?><button><img src="../imagenes/corazon.png" class="h-7 w-7" alt="" srcset=""></button>
                                    <?php
                                    ?>
                                </form>
                            <?php
                            } else {
                            ?>
                                <form action="likePostSeguido.php" method="POST" class="h-7 w-7">
                                    <input type="hidden" name="idPost" value="<?php echo $post['idPost'] ?>">
                                    <?php
                                    ?><button><img src="../imagenes/heart.png" class="h-7 w-7" alt="" srcset=""></button>
                                    <?php
                                    ?>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="flex w-full border-t border-gray-100">
                        <div class="mt-3 mx-5 w-full flex justify-start text-md">
                            <div class="flex text-gray-700  rounded-md mb-2 mr-4 items-center text-md">Likes:
                                <div class="ml-1 text-gray-400 text-md">
                                    <?php
                                    $Likes = mysqli_query($con, "select idLike from likes where idPost=$post[idPost]");
                                    $numeroLikes = 0;

                                    while ($cantidad = mysqli_fetch_array($Likes)) {
                                        $numeroLikes++;
                                    }

                                    echo $numeroLikes;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative block items-center self-center w-full max-w-xl p-4 overflow-hidden text-gray-600 ">
                        <div class="bottom border-t">
                            <div class="wrapper flex">
                                <form action="comentarioSeguido.php" method="post" class="flex w-full">
                                    <input type="hidden" name="idPost" id="" value="<?php echo $post['idPost'] ?>">
                                    <input type="text" class="text-sm h-10 w-full outline-none focus:outline-none w-10/12" placeholder="Agrega un comentario" name="comentario" required id="inputComentario">
                                    <button class="text-blue-500 opacity-75 w-2/12 text-right font-semibold">Comentar</button>
                                </form>
                            </div>
                            <div class="">
                                <?php
                                $cantidadComentarios = 0;
                                $contadorComentarios = 0;

                                $comentarios = mysqli_query($con, "select * from comentario where idPost=$post[idPost]");
                                $totalComentarios = mysqli_query($con, "select contenido from comentario where idPost=$post[idPost]");

                                while ($c = mysqli_fetch_array($totalComentarios)) {
                                    $cantidadComentarios++;
                                }
                                while ($comentario = mysqli_fetch_array($comentarios)) {
                                    if ($contadorComentarios < 2) {
                                        $usuarios = mysqli_query($con, "select nombre,imagen from usuario where idUsuario=$comentario[idUsuario]");
                                        echo "<div class='flex justify-evenly items-center text-sm my-2'>";
                                        if ($usuario = mysqli_fetch_array($usuarios)) {
                                            echo "<div class='flex items-center '>";
                                            echo "<img src='../$usuario[imagen]' class='mr-2 rounded-full cover w-10 h-10'>";
                                            echo "<b class='capitalize mr-2 w-28'>" . $usuario['nombre'] . ":</b>";
                                            echo "</div>";
                                        }
                                        echo "<span class='w-full'>$comentario[contenido]</span>" . "<br>";
                                        if ($_SESSION['idUsuario'] == $comentario['idUsuario']) {
                                            echo "<div class='text-red-500 float-right font-extrabold'><form action='eliminarComentarioSeguido.php' method='POST'><input type='hidden' name='id' value='$comentario[idComentario]'><input type='submit' value='X' class='text-red-500 font-extrabold cursor-pointer '></form></div>";
                                            echo "</div>";
                                        } else {
                                            echo "</div>";
                                        }
                                        $contadorComentarios++;
                                    } else {
                                ?>

                                        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                            <!-- Trigger for Modal -->
                                            <button type="button" @click="showModal = true" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"><?php echo "ver los " . $cantidadComentarios . " comentarios" ?></button>

                                            <!-- Modal -->
                                            <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                                <!-- Modal inner -->
                                                <div class="max-w-6xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg" @click.away="showModal = false" x-transition:enter="motion-safe:ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                                                    <!-- Title / Close-->
                                                    <div class="flex items-center justify-end">

                                                        <button type="button" class="z-50 cursor-pointer" @click="showModal = false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <!-- content -->
                                                    <div>
                                                        <div class="bg-white overflow-hidden shadow-none">
                                                            <div class="grid grid-cols-3 min-w-full">

                                                                <div class="col-span-2 w-full">
                                                                    <?php


                                                                    $image = $post['imagen'];



                                                                    $formatosVideo = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'mpeg'];
                                                                    $formatosImagen = ['jpg', 'jpeg', 'png', 'jfif'];


                                                                    $formato = substr($image, strlen($image) - 6);
                                                                    $formato = substr($formato, strpos($formato, "."));



                                                                    $esVideo = False;
                                                                    $esImagen = False;

                                                                    foreach ($formatosVideo as $key => $value) {
                                                                        if ($formato == ".$value") {
                                                                            $esVideo = True;
                                                                        }
                                                                    }

                                                                    foreach ($formatosImagen as $key => $value) {
                                                                        if ($formato == ".$value") {
                                                                            $esImagen = True;
                                                                        }
                                                                    }




                                                                    if ($esVideo) {
                                                                    ?>
                                                                        <video controls class="max-w-2xl object-contain" style="height:800px" src="../post/<?php echo $post['imagen'] ?>">
                                                                        <?php
                                                                    }

                                                                    if ($esImagen) {
                                                                        ?>
                                                                            <img class="max-w-2xl object-contain" style="height:800px" src="../post/<?php echo $post['imagen'] ?>">
                                                                        <?php
                                                                    }

                                                                        ?>

                                                                        
                                                                </div>

                                                                <div class="col-span-1 relative pl-4">
                                                                    <header class="border-b border-grey-400">
                                                                        <a href="#" class="block cursor-pointer py-4 flex items-center text-sm outline-none focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                                            <img src="<?php echo "../" . obtenerImagen($con, $post['idUsuario']) ?>" class="h-9 w-9 rounded-full object-cover" alt="user" />
                                                                            <p class="block ml-2 font-bold capitalize"><?php echo obtenerNombreUsuario($con, $post['idUsuario']); ?></p>
                                                                        </a>
                                                                    </header>

                                                                    <div>
                                                                        <?php
                                                                        $comentarios = mysqli_query($con, "select * from comentario where idPost=$post[idPost]");
                                                                        $contadorComentarios = 0;
                                                                        while ($comentario = mysqli_fetch_array($comentarios)) {
                                                                            if ($contadorComentarios < 2) {
                                                                                $usuarios = mysqli_query($con, "select nombre,imagen from usuario where idUsuario=$comentario[idUsuario]");
                                                                                echo "<div class='flex justify-evenly items-center text-sm my-2'>";
                                                                                if ($usuario = mysqli_fetch_array($usuarios)) {
                                                                                    echo "<div class='flex items-center '>";
                                                                                    echo "<img src='../$usuario[imagen]' class='mr-2 rounded-full w-10 h-10'>";
                                                                                    echo "<b class='capitalize mr-2 w-28'>" . $usuario['nombre'] . ":</b>";
                                                                                    echo "</div>";
                                                                                }
                                                                                echo "<span class='w-full'>$comentario[contenido]</span>" . "<br>";
                                                                                if ($_SESSION['idUsuario'] == $comentario['idUsuario']) {
                                                                                    echo "<div class='text-red-500 float-right font-extrabold'><form action='eliminarComentarioSeguido.php' method='POST'><input type='hidden' name='id' value='$comentario[idComentario]'><input type='submit' value='X' class='text-red-500 font-extrabold cursor-pointer '></form></div>";
                                                                                    echo "</div>";
                                                                                } else {
                                                                                    echo "</div>";
                                                                                }
                                                                            }
                                                                        } ?>

                                                                    </div>

                                                                    <div class="absolute bottom-0 left-0 right-0 pl-4">
                                                                        <div class="pt-4">
                                                                            <div class="mb-2">
                                                                                <div class="flex items-center">
                                                                                    <span class="mr-3 inline-flex items-center cursor-pointer">
                                                                                        <svg class="fill-heart text-gray-700 inline-block h-7 w-7 heart" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                                                        </svg>
                                                                                    </span>
                                                                                    <span class="mr-3 inline-flex items-center cursor-pointer">
                                                                                        <svg class="text-gray-700 inline-block h-7 w-7 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                                                        </svg>
                                                                                    </span>
                                                                                </div>
                                                                                <span class="text-gray-600 text-sm font-bold"><?php echo $numeroLikes; ?> Likes</span>
                                                                            </div>
                                                                            <span class="block ml-2 text-xs text-gray-600">5 minutes</span>
                                                                        </div>

                                                                        <div class="pt-4 pb-1 pr-3">
                                                                            <div class="flex items-start">
                                                                                <form action="comentarioSeguido.php" method="post" class="flex w-full">
                                                                                    <input type="hidden" name="idPost" id="" value="<?php echo $post['idPost'] ?>">
                                                                                    <input type="text" class="text-sm h-10 w-full outline-none focus:outline-none w-10/12" placeholder="Agrega un comentario" name="comentario" required id="inputComentario">
                                                                                    <button class="text-blue-500 opacity-75  text-right font-semibold">Comentar</button>
                                                                                </form>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>