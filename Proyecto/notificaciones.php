<?php
session_start();
include 'componentes/tailwind.php';
include 'conexion.php';
$myId = $_SESSION['idUsuario'];
$notificaciones = mysqli_query($con, "select * from notificaciones where idUsuarioR=$myId");


?>

<section class="antialiased bg-gray-100 text-gray-600 h-screen px-4">
    <div class="flex flex-col justify-center h-full">
        <!-- Table -->
        <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">Notificaciones</h2>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Nombre Usuario</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Email</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Nombre Publiacion</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">


                            <?php

                            if ($noti = mysqli_fetch_array($notificaciones)) {

                                while ($notificacion = mysqli_fetch_array($notificaciones)) {

                                    $usuarios = mysqli_query($con, "select nombre,apellido,imagen from usuario where idUsuario=$notificacion[idUsuarioE]");
                                    $titulos = mysqli_query($con, "select titulo from post where idPost=$notificacion[idPost]");
                                    // if ($usuario = mysqli_fetch_array($usuarios)) {
                                    //     echo "<p class='mb-3 text-justify'><span class='text-blue-500'>$usuario[nombre]</span> ha comentado en tu publicación";
                                    // }
                                    // if ($titulo = mysqli_fetch_array($titulos)) {
                                    //     echo "$titulo[titulo]</p>";
                                    // }
                            ?>


                                    <?php

                                    if ($usuario = mysqli_fetch_array($usuarios)) {
                                        echo "<tr class='mb-3 items-center text-justify'><td class='text-blue-500'><div><img src='$usuario[imagen]' width='40' height='40' class='rounded-full w-10 h-10'></div><div>$usuario[nombre]</div></td>                                         
                                        <td class='p-2 whitespace-nowrap'>$usuario[nombre]@gmail.com<div></td>
                                        
                                        
                                        ";
                                    }

                                    if ($titulo = mysqli_fetch_array($titulos)) {
                                        echo "<td class='p-2 whitespace-nowrap text-left font-medium text-green-500'>$titulo[titulo]<div></td>";
                                    }

                                    ?>


                                <?php
                                }


                                ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
                            }
