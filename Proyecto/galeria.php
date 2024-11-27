<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    include 'componentes/tailwind.php';
    include 'conexion.php';
    include 'componentes/sidebar.php';
    ?>

    <div class="bg-white py-6 sm:py-8 lg:py-12 p-20">
        <div class="ml-48 max-w-screen px-4 md:px-8">
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:gap-6 xl:gap-8">
                <!-- image - start -->
                <?php
                $imagenes = mysqli_query($con, 'select * from post');

                while ($imagen = mysqli_fetch_array($imagenes)) {

                    $image = $imagen['imagen'];

                    $formatosVideo = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'mpeg'];



                    $formato = substr($image, strlen($image) - 6);
                    $formato = substr($formato, strpos($formato, "."));



                    $esVideo = False;

                    foreach ($formatosVideo as $key => $value) {
                        if ($formato == ".$value") {
                            break;
                        } else {
                ?>

                            <a class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80">
                                <img src="<?php echo "post/" . $imagen['imagen'] ?>" loading="lazy" alt="Photo by Minh Pham" class="absolute inset-0 h-full w-full object-cover object-center transition duration-500 group-hover:scale-110" />

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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>

</html>