<div x-data="{ open: false }" class="relative inline-block">
    <button @click="open = true" class="flex items-center justify-center p-1 border border-gray-300 rounded-full hover:bg-gray-100 focus:outline-none focus:bg-gray-100" aria-label="More options">
        <svg class="w-4 h-4 text-gray-600" fill="#262626" viewBox="0 0 48 48">
            <circle clip-rule="evenodd" cx="8" cy="24" fill-rule="evenodd" r="4.5"></circle>
            <circle clip-rule="evenodd" cx="24" cy="24" fill-rule="evenodd" r="4.5"></circle>
            <circle clip-rule="evenodd" cx="40" cy="24" fill-rule="evenodd" r="4.5"></circle>
        </svg>
    </button>
    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 bg-white border border-gray-300 rounded-lg shadow-lg w-48 h-20 items-center">
        <form action="./post/modificarPostForm.php/" class="text-center mt-2" method="POST">
            <?php
            $_SESSION['idPost' . $post['idPost']] = $post['idPost'];
            ?>
            <input type="hidden" name="id" value="<?php echo "$post[idPost]"; ?>">
            <button type="submit">
                Modificar Post
            </button>
        </form>
        <form action="./post/eliminarPostForm.php/" class="text-center mt-2" method="POST" id="eliminarForm">
            <input type="hidden" name="id" value="<?php echo "$post[idPost]"; ?>">
            <button type="submit" onclick="event.preventDefault(); alerta()">
                Eliminar Post
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function alerta() {
        Swal.fire({
            title: 'Estás seguro?',
            text: 'No podrás revertir esto',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('eliminarForm').submit(); // Enviar el formulario después de la alerta
            }
        });
    }
</script>