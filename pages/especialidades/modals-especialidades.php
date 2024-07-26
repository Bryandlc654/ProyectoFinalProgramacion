<!-- Modal Agregar Usuarios -->
<div class="modal fade" id="ModalRegisterEsp" tabindex="-1" aria-labelledby="ModalRegisterEsp" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalRegisterEsp">Registrar Especialidad</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="agregarEspecialidad">
                    <div class="mb-3">
                        <label for="nombresEsp" class="form-label">Nombre de Especidad</label>
                        <input type="text" class="form-control" id="nombresEsp" name="nombresEsp">
                    </div>
                    <br>
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
<div class="modal fade" id="ModalEditEsp" tabindex="-1" aria-labelledby="ModalEditEsp" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalEditEsp">Editar Especialidad</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formeditEsp">
                    <div class="mb-3">
                        <label for="nombresEsp" class="form-label">Nombres</label>
                        <input type="text" class="form-control" hidden id="idespEdit" name="idespEdit">
                        <input type="text" class="form-control" id="nombresEspEdit" name="nombresEspEdit">
                    </div>
                    <br>
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
<div class="modal fade" id="ModalDeleteEsp" tabindex="-1" aria-labelledby="ModalDeleteEsp" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalDeleteEsp">Eliminar Especialidad</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estas seguro de Eliminar la Especialidad?
                <form id="confrimareliminaresp">
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
        $(document).on('submit', '#agregarEspecialidad', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);

            $.ajax({
                url: '../especialidades/guardar_especialidad.php', // Cambia esto a la ruta de tu archivo PHP
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        actualizarLista()
                        $('#ModalRegisterEsp').modal('hide'); // Cierra el modal
                        $('#agregarEspecialidad')[0].reset(); // Limpia los inputs
                    } else {
                        toastr.error(response.message);
                    }
                    submitButton.prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al agregar Por favor, intenta nuevamente.');
                    $('#ModalRegisterEsp').modal('hide'); // Cierra el modal
                    submitButton.prop('disabled', false); // Habilita el botón de nuevo
                }
            });
        });

        // Evento click del botón editar
        $(document).on('click', '.editar-esp', function() {
            var espIdEdit = $(this).data('id');
            $.ajax({
                url: '../especialidades/obtener-esp.php',
                method: 'POST',
                data: {
                    esp_idEdit: espIdEdit
                },
                dataType: 'json',
                success: function(response) {
                    $('#idespEdit').val(response.Id_Especialidad);
                    $('#nombresEspEdit').val(response.Nombre_Especialidad);
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al obtener los detalles. Por favor, intenta nuevamente.');
                }
            });
        });

        function actualizarLista() {
            $.ajax({
                url: '../especialidades/obtener-lista.php',
                method: 'GET',
                success: function(data) {
                    $('#listaEsp').html(data);
                    toastr.success("Lista actualizada");
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al actualizar la lista.');
                }
            });
        }

        // Evento submit del formulario para editar sede
        $(document).on('submit', '#formeditEsp', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '../especialidades/editar-esp.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        actualizarLista()
                        $('#ModalEditEsp').modal('hide'); // Cierra el modal
                        $('#formeditEsp')[0].reset(); // Limpia los inputs
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error. Por favor, intenta nuevamente.');
                    $('#ModalEditEsp').modal('hide'); // Cierra el modal en caso de error
                }
            });
        });

        $(document).on('click', '.eliminar-esp', function() {
            var espIdEdit = $(this).data('id');
            $('#ModalDeleteEsp').modal('show');

            $('#ModalDeleteEsp .btn-eliminar').one('click', function() {
                $.ajax({
                    url: '../especialidades/eliminar-esp.php',
                    method: 'POST',
                    data: {
                        esp_idEdit: espIdEdit
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            actualizarLista()
                            $('#ModalDeleteEsp').modal('hide'); // Cierra el modal
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error al eliminar. Por favor, intenta nuevamente.');
                        $('#ModalDeleteEsp').modal('hide'); // Cierra el modal en caso de error
                    }
                });
            });
        });

    });
</script>