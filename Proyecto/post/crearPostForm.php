<?php
session_start();


if (isset($_SESSION['idUsuario'])) {
  include '../componentes/tailwind.php';
?>

  <div class="heading text-center font-bold text-2xl m-5 text-gray-800">New Post</div>
  <form action="createPost.php" method="POST" enctype='multipart/form-data'>
    <?php
    if ($_SESSION['noValido']) {
    } else {
      echo "<div class='mx-auto max-w-2xl py-3 my-2 bg-red-500 text-white indent-4'>El formato No es valido</div>";
      $_SESSION['noValido'] = True;
    }
    ?>
    <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
      <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" placeholder="Title" type="text" name="titulo" required>
      <textarea class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false" placeholder="Describe everything about this post here" name="descripcion" required></textarea><br><br>
      <input type="file" name="imagen" id="fileInput" accept="image/*,video/*" required><br><br>
      <div id="preview" style="margin:10px auto"></div>
      <script>
        document.getElementById('fileInput').addEventListener('change', function(event) {
          const file = event.target.files[0];
          if (!file) {
            return;
          }

          const preview = document.getElementById('preview');
          preview.innerHTML = ''; // Limpia la previsualización anterior si la hay

          const fileType = file.type.split('/')[0];
          if (fileType === 'image') {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.maxWidth = '100%';
            img.style.maxHeight = '300px';
            preview.appendChild(img);
          } else if (fileType === 'video') {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(file);
            video.controls = true;
            video.style.maxWidth = '100%';
            video.style.maxHeight = '300px';
            preview.appendChild(video);
          } else {
            const errorMessage = document.createElement('p');
            errorMessage.textContent = 'Formato de archivo no compatible. Por favor, seleccione una imagen o un video.';
            preview.appendChild(errorMessage);
          }
        });
      </script>
      <div class="buttons flex">
        <button type="submit" class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500">Post</button>
        <a href="../principal.php" class="btn border p-1 px-2 font-semibold cursor-pointer text-gray-700 ml-2 bg-gray-300 ">Cancelar</a>
      </div>

  </form>
  </div>



<?php
} else {
  header("Location: ../index.php");
}
?>