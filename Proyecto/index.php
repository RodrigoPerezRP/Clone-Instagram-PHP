<?php
session_start();
if (isset($_SESSION['idUsuario'])) {
  header("Location: principal.php");
} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include 'componentes/tailwind.php';
    ?>

  </head>

  <body>
    <div class="flex h-screen w-full items-center justify-center bg-cover bg-no-repeat">
      <div class="rounded-xl  px-36 py-10  backdrop-blur-md max-sm:px-8 ">
        <div class="text-white">
          <div class="mb-8 flex flex-col items-center">
            <img src="https://www.logo.wine/a/logo/Instagram/Instagram-Glyph-Color-Logo.wine.svg" width="150" alt="" srcset="" />
            <h1 class="mb-2 text-2xl text-gray-800">Instagram</h1>
          </div>
          <form action="login.php" method="POST">
            <div class="mb-4 text-lg">
              <label for="" class="text-blue-600 ml-2 text-base">Email Address</label><br>
              <input class="rounded-md  my-3 bg-opacity-50 px-12 border border-gray-400 text-gray-900 py-2 text-center  placeholder-gray-500 shadow-lg outline-none backdrop-blur-md focus:border-indigo-600" required type="email" name="email" placeholder="test@gmail.com" />
            </div>

            <div class="mb-4 text-lg">
              <label for="" class="text-blue-600 ml-2 text-base">Password</label><br>
              <input class="rounded-md  my-3 bg-opacity-50 px-12 border border-gray-400 text-gray-900 py-2 text-center  placeholder-gray-500 shadow-lg outline-none backdrop-blur-md focus:border-indigo-600" required type="password" name="pass" placeholder="*********" />
            </div>
            <div class="mt-8 flex justify-center text-lg  text-black">
              <button type="submit" class="rounded-3xl  bg-indigo-700 text-white  px-10  text-gray-900 py-2 e shadow-xl backdrop-blur-md transition-colors duration-300 w-full">Login</button>
            </div>
            <div class="mt-8 flex justify-center text-lg text-black">
              <p class="text-center text-sm text-gray-600 mt-2">No tienes una cuenta? <a href="registerForm.php" class="text-blue-600 hover:text-blue-700 hover:underline" title="Sign In">Registrate aqui!</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>


  </body>


  </html>


<?php
}
?>
