<?php

$idUsuario = $reg['idUsuario'];

$cantidades = mysqli_query($con, "select idPost from post where idUsuario=$idUsuario");

$contador = 0;

while ($cantidad = mysqli_fetch_array($cantidades)) {
    $contador++;
}

if ($contador <= 0) {
?>

    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1><span><img src="imagenes/emoji.png" alt=""></span></h1>
            </div>
            <h2>Oops! No hay Posts</h2>
            <p>No hay Publicaciones en este Perfil</p>
        </div>
    </div>

<?php
} else {
?>

    <div class="grid grid-cols-3 px-32 gap-10">
        <?php

        $idUsuario = $reg['idUsuario'];

        $imagenes = mysqli_query($con, "select * from post where idUsuario=$idUsuario");

        while ($imagen = mysqli_fetch_array($imagenes)) {

            $image = $imagen['imagen'];

            $formatosVideo = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'mpeg'];



            $formato = substr($image, strlen($image) - 6);
            $formato = substr($formato, strpos($formato, "."));



            $esVideo = False;

            foreach ($formatosVideo as $key => $value) {
                if ($formato == ".$value") {
        ?>

                    <a class="group relative flex h-60 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80">
                        <video controls src="<?php echo "post/" . $imagen['imagen'] ?>" loading="lazy" alt="Photo by Minh Pham" class="absolute inset-0 h-full w-full  object-center"></video>

                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                        </div>

                        <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg"><?php echo $imagen['titulo'] ?></span>
                    </a>

                <?php
                    break;
                } else {
                ?>

                    <a class="group relative flex h-60 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80">
                        <img src="<?php echo "post/" . $imagen['imagen'] ?>" loading="lazy" alt="Photo by Minh Pham" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                        </div>

                        <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg"><?php echo $imagen['titulo'] ?></span>
                    </a>

            <?php break;
                }
            }



            ?>




        <?php
        }
        ?>
        <!-- image - end -->

    </div>

<?php
}

?>