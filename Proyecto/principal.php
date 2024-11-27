<?php
  session_start();

  $_SESSION['noValido'] = True;

  if (!isset($_SESSION['idUsuario'])) {
    session_destroy();
    header("Location: index.php");
  }else{
    include 'principal2.php';
  }

  if (isset($_SESSION['alertaNoValido'])){
    if ($_SESSION['alertaNoValido']) {
    ?>
    <script>
      Swal.fire(
        'Oops',
        'Algo a salido mal',
        'error',
      )
      <?php $_SESSION['alertaNoValido'] = False; ?>
    </script>
    <?php
    }
  }


  if (isset($_SESSION['postEliminado'])){
    if ($_SESSION['postEliminado']) {
    ?>
    <script>
      Swal.fire(
        'Eliminado',
        'Post Eliminado correctamente',
        'success',
      )
      <?php $_SESSION['postEliminado'] = False; ?>
    </script>
    <?php
    }
  }
?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>