<?php
session_start();

if (isset($_SESSION['idUsuario'])) {
  include '../componentes/tailwind.php';
  include '../conexion.php';
  $_SESSION['idPost'] = $_POST['id'];
  $idPost = $_SESSION['idPost'];

  $titulo = "";
  $descripcion = "";
  $fec_creted = "";
  $idUsuario = $_SESSION['idUsuario'];

  $data = mysqli_query($con, "select titulo,descripcion,imagen from post where idPost=$idPost");

  if ($post = mysqli_fetch_array($data)) {
    $titulo = $post['titulo'];
    $descripcion = $post['descripcion'];
    $imagen = $post['imagen'];
  }
  $_SESSION['imagen'] = $imagen;

?>


  <div class="flex items-center justify-center p-12">
    <!-- Author: FormBold Team -->
    <!-- Learn More: https://formbold.com -->
    <div class="mx-auto w-full max-w-[550px]">
      <form action="../modificarPost.php" method="POST" enctype='multipart/form-data'>
        <input type="hidden" name="id" value="<?php echo $idPost ?>">
        <div class="mb-5">
          <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
            Titulo
          </label>
          <input type="text" name="titulo" id="titulo" placeholder="Titulo" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="<?php echo $titulo ?>" />
        </div>
        <div class="mb-5">
          <label for="Descripcion" class="mb-3 block text-base font-medium text-[#07074D]">
            Descripcion
          </label>
          <textarea rows="4" name="descripcion" id="descripcion" placeholder="Modificar Tu descripcion" class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"><?php echo $descripcion  ?></textarea><br><br>

          <input type="file" name="imagen" id="seleccionArchivo" accept="image/*"><br><br>

          <?php
          $image = $imagen;
          $formato = substr($image, strlen($image) - 6);
          $formato = substr($formato, strpos($formato, "."));

          $formatosVideo = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'mpeg'];
          $esVideo = False;

          foreach ($formatosVideo as $key => $value) {
            if ($formato == ".$value") {
              echo '<video controls id="mediaPrevisualizacion" style="margin:0 auto;object-fit:cover;width:400px;height:300px"></video>';
              $esVideo = True;
              break;
            }
          }

          if (!$esVideo) {
            echo '<img id="mediaPrevisualizacion" style="margin:0 auto;object-fit:cover;width:400px;height:300px">';
          }else{

          }
          ?>
        

    </div>
    <div>
      <button class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none" type="submit">
        Submit
      </button>
    </div>

    </form>
  </div>
  </div>
  <script src="../post/script2.js"></script>
<?php
} else {
  header('Location: ../../principal.php');
}
?>

<!-- 


          

-->

<script>
  const mediaInput = document.getElementById("seleccionArchivo");
  const mediaPre = document.getElementById("mediaPrevisualizacion");

  mediaPre.src = "../<?php echo $imagen ?>";

  mediaInput.addEventListener("change", () => {
    const archivos = mediaInput.files;
    if (!archivos || !archivos.length) {
      return;
    }

    const primerArchivo = archivos[0];
    const objectURL = URL.createObjectURL(primerArchivo);

    mediaPre.src = objectURL;
  });
</script>