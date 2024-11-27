<?php
session_start();

if (isset($_SESSION['idUsuario'])) {
    include 'componentes/tailwind.php';
    include 'conexion.php';

    $idUsuario = $_SESSION['idUsuario'];

    $data = mysqli_query($con, "select nombre,apellido,descripcion,imagen from usuario where idUsuario=$idUsuario");

    if ($usuario = mysqli_fetch_array($data)) {
        $nombre = $usuario['nombre'];
        $apellido = $usuario['apellido'];
        $descripcion = $usuario['descripcion'];
        $imagen = $usuario['imagen'];
    }

    $_SESSION['imagen'] = $imagen;
    


?>


    <div class="flex items-center justify-center p-12">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="mx-auto w-full max-w-[550px]">
            <form action="modificarProfile.php" method="POST" enctype='multipart/form-data'>
                <input type="hidden" name="id" value="<?php echo $idPost ?>">
                <div class="mb-5">
                    <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                        Titulo
                    </label>
                    <input type="text" name="nombre" id="titulo" placeholder="Titulo" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="<?php echo $nombre ?>" />
                </div>
                <div class="mb-5">
                    <label for="Descripcion" class="mb-3 block text-base font-medium text-[#07074D]">
                        apellido
                    </label>
                    <input type="text" name="apellido" id="apellido" placeholder="apellido" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="<?php echo $apellido ?>" />
                </div>
                <div class="mb-5">
                    <label for="Descripcion" class="mb-3 block text-base font-medium text-[#07074D]">
                        Descripcion
                    </label>
                    <input type="text" name="descripcion" id="apellido" placeholder="apellido" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="<?php echo $descripcion ?>" />
                </div>


                <div>
                    <input type="file" name="imagen" id="seleccionArchivo" accept="image/*"><br><br>
                    <img id="imagenPrevisualizacion" style="margin:0 auto;object-fit:cover;width:400px;height:300px">
                </div>

                <div class="my-4">
                    <button class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none" type="submit">
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </div>
<?php
} else {
    header('Location: /principal.php');
}
?>

<script>
    const imagen = document.getElementById("seleccionArchivo");
    const imagenPre = document.getElementById("imagenPrevisualizacion");
    imagenPre.src = "<?php echo $imagen ?>";

    imagen.addEventListener("change", () => {
        const archivos = imagen.files;
        if (!archivos || !archivos.length) {
            return;
        }

        const primerArchivo = archivos[0];
        const objectURL = URL.createObjectURL(primerArchivo);

        imagenPre.src = objectURL;

    });
</script>