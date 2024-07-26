<?php


// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirige a la página de inicio de sesión si no está autenticado
    header("Location: ../../index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$idUser = $usuario['Id_Usuario'];
?>


<!-- Modal Agregar Usuarios -->
<div class="modal fade" id="ModalRegisterUser" tabindex="-1" aria-labelledby="ModalRegisterUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalRegisterUser">Editar Usuario</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerUserForm">
                    <input type="text" hidden class="form-control" id="idUser" name="idUser" value="<?php echo $Id_Usuario ?>">
                    <div class="mb-3">
                        <label for="nombresUser" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="nombresUser" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidosUser" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidosUser" required>
                    </div>
                    <div class="mb-3">
                        <label for="ndocumentosUser" class="form-label">Número de Documento</label>
                        <input type="text" class="form-control" name="ndocumentosUser" required>
                    </div>
                    <div class="mb-3">
                        <label for="correoUser" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correoUser">
                    </div>
                    <div class="mb-3">
                        <label for="celularUser" class="form-label">Celular</label>
                        <input type="text" class="form-control" name="celularUser">
                    </div>
                    <div class="mb-3">
                        <label for="fnacimientoUser" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="fnacimientoUser">
                    </div>
                    <div class="mb-3">
                        <label for="direccionoUser" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccionoUser">
                    </div>
                    <div class="mb-3">
                        <label for="generoUser" class="form-label">Género</label>
                        <select class="form-control" name="generoUser">
                            <option value="">Elige una opción</option>
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fregistroUser" class="form-label">Fecha de Registro</label>
                        <input type="date" class="form-control" name="fregistroUser" required>
                    </div>
                    <div class="mb-3">
                        <label for="estadoUser" class="form-label">Estado</label>
                        <select class="form-control" name="estadoUser" required>
                            <option value="">Elige una opción</option>
                            <option value="1">Habilitado</option>
                            <option value="0">Deshabilitado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fotoUser" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="fotoUser">
                    </div>
                    <div class="mb-3">
                        <label for="rolUser" class="form-label">Rol</label>
                        <select class="form-control" name="rolUser" required>
                            <option>Elige una opción</option>
                            <?php
                            while ($filaRoles = mysqli_fetch_array($resultRoles)) {
                                echo "<option value='{$filaRoles[0]}'>" . $filaRoles[1] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Usuarios -->
<div class="modal fade" id="ModalEditUser" tabindex="-1" aria-labelledby="ModalEditUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5">Editar Usuario</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarUser">
                    <input type="text" hidden class="form-control" id="idUserEdit" name="idUserEdit">
                    <div class="mb-3">
                        <label for="nombresUser" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombresUserEdit" name="nombresUserEdit">
                    </div>
                    <div class="mb-3">
                        <label for="ApellidosUser" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="ApellidosUserEdit" name="ApellidosUserEdit">
                    </div>
                    <div class="mb-3">
                        <label for="ndocumentosUser" class="form-label">Número de Documento</label>
                        <input type="text" class="form-control" id="ndocumentosUserEdit" name="ndocumentosUserEdit">
                    </div>
                    <div class="mb-3">
                        <label for="correoUser" class="form-label">Correo</label>
                        <input type="text" class="form-control" id="correoUserEdit" name="correoUserEdit">
                    </div>
                    <div class="mb-3">
                        <label for="celularUser" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="celularUserEdit" name="celularUserEdit">
                    </div>
                    <div class="mb-3">
                        <label for="fnacimientoUser" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fnacimientoUserEdit" name="fnacimientoUserEdit">
                    </div>
                    <div class="mb-3">
                        <label for="direccionoUser" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccionoUserEdit" name="direccionoUserEdit">
                    </div>
                    <div class="mb-3">
                        <label for="generoUser" class="form-label">Género</label>
                        <select class="form-control" id="generoUserEdit" name="generoUserEdit">
                            <option>Elige una opción</option>
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fregistroUser" class="form-label">Fecha de Registro</label>
                        <input type="date" class="form-control" id="fregistroUserEdit" name="fregistroUserEdit">
                    </div>
                    <div class="mb-3">
                        <label for="estadoUser" class="form-label">Estado</label>
                        <select class="form-control" id="estadoUserEdit" name="estadoUserEdit">
                            <option>Elige una opción</option>
                            <option value="1">Habilitado</option>
                            <option value="0">Deshabilitado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fotoUser" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoUserEdit" name="fotoUserEdit">
                    </div>
                    <div class="mb-3">
                        <label for="rolUser" class="form-label">Rol</label>
                        <select class="form-control" name="rolUserEdit" required id="rolUserEdit">
                            <option>Elige una opción</option>
                            <?php
                            foreach ($roles as $rol) {
                                echo "<option value='" . $rol['Id_Rol'] . "'>" . $rol['Nombre_Rol'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Eliminar Usuarios -->
<div class="modal fade" id="ModalDeleteUser" tabindex="-1" aria-labelledby="ModalDeleteUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalDeleteUser">Deshabilitar Usuario</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estas seguro de Deshabilitar el usuarios?
                <form action="">
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger btn-eliminar">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Activar Usuarios -->
<div class="modal fade" id="ModalDeleteUser" tabindex="-1" aria-labelledby="ModalDeleteUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalDeleteUser">Habilitar Usuario</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estas seguro de Habilitar el usuarios?
                <form action="">
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger btn-eliminar">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('submit', '#registerUserForm', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);

            $.ajax({
                url: '../usuarios/guardar_usuario.php', // Cambia esto a la ruta de tu archivo PHP
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#ModalRegisterUser').modal('hide'); // Cierra el modal
                        $('#registerUserForm')[0].reset(); // Limpia los inputs
                        actualizarLista();
                    } else {
                        toastr.error(response.message);
                    }
                    submitButton.prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al agregar la sede. Por favor, intenta nuevamente.');
                    $('#ModalRegisterUser').modal('hide'); // Cierra el modal
                    submitButton.prop('disabled', false); // Habilita el botón de nuevo
                }
            });
        });

        $(document).on('click', '.eliminar-usuario', function() {
            var usuarioId = $(this).data('id');
            $('#ModalDeleteUser').modal('show');


            $('#ModalDeleteUser .btn-eliminar').one('click', function() {
                $.ajax({
                    url: '../usuarios/eliminar-usuario.php',
                    method: 'POST',
                    data: {
                        eliminarUsuarioId: usuarioId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            actualizarLista();
                            $('#ModalDeleteUser').modal('hide'); // Cierra el modal
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error al eliminar. Por favor, intenta nuevamente.');
                        $('#ModalDeleteUser').modal('hide'); // Cierra el modal en caso de error
                    }
                });
            });
        });

        // Evento click del botón editar
        $(document).on('click', '.editar-usuario', function() {
            var usuarioIdEdit = $(this).data('id');
            $.ajax({
                url: '../usuarios/obtener_usuarios.php',
                method: 'POST',
                data: {
                    usuario_idEdit: usuarioIdEdit
                },
                dataType: 'json',
                success: function(response) {
                    $('#idUserEdit').val(response.Id_Usuario);
                    $('#nombresUserEdit').val(response.Nombre_Usuario);
                    $('#ApellidosUserEdit').val(response.Apellidos_Usuario);
                    $('#ndocumentosUserEdit').val(response.NroDocumento_Usuario);
                    $('#correoUserEdit').val(response.Correo_Usuario);
                    $('#celularUserEdit').val(response.Celular_Usuario);
                    $('#fnacimientoUserEdit').val(response.FechaNacimiento_Usuario);
                    $('#direccionoUserEdit').val(response.Direccion_Usuario);
                    $('#generoUserEdit').val(response.Genero_Usuario);
                    $('#fregistroUserEdit').val(response.FechaRegistro_Usuario);
                    $('#estadoUserEdit').val(response.Estatus_Usuario);
                    $('#rolUserEdit').val(response.Id_Rol);
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al obtener los detalles. Por favor, intenta nuevamente.');
                }
            });
        });
        // Evento submit del formulario para editar sede
        $(document).on('submit', '#formEditarUser', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            // Deshabilita el botón de envío para evitar múltiples envíos
            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);

            $.ajax({
                url: '../usuarios/editar-usuario.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        actualizarLista();
                        $('#ModalEditUser').modal('hide'); // Cierra el modal
                        $('#formEditarUser')[0].reset(); // Limpia los inputs
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error. Por favor, intenta nuevamente.');
                    $('#ModalEditUser').modal('hide'); // Cierra el modal en caso de error
                }
            });
        });

        function actualizarLista() {
            $.ajax({
                url: '../usuarios/obtener-lista.php',
                method: 'GET',
                success: function(data) {
                    $('#listaUsuarios').html(data);
                    toastr.success("Lista actualizada");
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al actualizar la lista .');
                }
            });
        }

    });
</script>