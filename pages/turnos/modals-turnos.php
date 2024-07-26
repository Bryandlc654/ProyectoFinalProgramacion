<!-- Modal Agregar Usuarios -->
<div class="modal fade" id="ModalRegisterTurn" tabindex="-1" aria-labelledby="ModalRegisterTurn" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalRegisterTurn">Registrar Turno</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="agregarturn">
                    <div class="mb-3">
                        <label for="nombreTurn" class="form-label">Nombre del Turno</label>
                        <input type="text" class="form-control" name="nombreturn">
                    </div>
                    <div class="mb-3">
                        <label for="hoarioTurn" class="form-label">Horario del Turno</label>
                        <input type="text" class="form-control" name="hoRarioturn">
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
<div class="modal fade" id="ModalEditTurn" tabindex="-1" aria-labelledby="ModalEditTurn" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5">Editar Turno</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formeditTurn">
                    <div class="mb-3">
                        <label for="nombreTurn" class="form-label">Nombre del Turno</label>
                        <input type="text" hidden class="form-control" id="idturnEdit" name="idturnEdit">
                        <input type="text" class="form-control" id="nombreTurnEdit" name="nombreturnEdit">
                    </div>
                    <div class="mb-3">
                        <label for="hoarioTurn" class="form-label">Horario del Turno</label>
                        <input type="text" class="form-control" id="horarioTurnEdit" name="hoRarioturnEdit">
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


<!-- Modal Eliminar  -->
<div class="modal fade" id="ModalDeleteTurn" tabindex="-1" aria-labelledby="ModalDeleteTurn" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5">Eliminar Turno</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estas seguro de Eliminar el Turno?
                <form>
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
        $(document).on('submit', '#agregarturn', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);

            $.ajax({
                url: '../turnos/guardar_turno.php', // Cambia esto a la ruta de tu archivo PHP
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        actualizarLista();
                        $('#ModalRegisterTurn').modal('hide'); // Cierra el modal
                        $('#agregarturn')[0].reset(); // Limpia los inputs
                    } else {
                        toastr.error(response.message);
                    }
                    submitButton.prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al agregar Por favor, intenta nuevamente.');
                    $('#ModalRegisterTurn').modal('hide'); // Cierra el modal
                }
            });
        });

        // Evento click del botón editar
        $(document).on('click', '.editar-turno', function() {
            var turnIdEdit = $(this).data('id');
            $.ajax({
                url: '../turnos/obtener-turn.php',
                method: 'POST',
                data: {
                    turn_idEdit: turnIdEdit
                },
                dataType: 'json',
                success: function(response) {
                    $('#idturnEdit').val(response.Id_Turno);
                    $('#nombreTurnEdit').val(response.Nombre_Turno);
                    $('#horarioTurnEdit').val(response.Horario_Turno);
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al obtener los detalles. Por favor, intenta nuevamente.');
                }
            });
        });

        // Evento submit del formulario para editar sede
        $(document).on('submit', '#formeditTurn', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '../turnos/editar-turn.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        actualizarLista();
                        $('#ModalEditTurn').modal('hide'); // Cierra el modal
                        $('#formeditTurnp')[0].reset(); // Limpia los inputs
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error. Por favor, intenta nuevamente.');
                    $('#ModalEditTurn').modal('hide'); // Cierra el modal en caso de error
                }
            });
        });

        $(document).on('click', '.eliminar-turno', function() {
            var turnIdEdit = $(this).data('id');
            $('#ModalDeleteTurn').modal('show');

            $('#ModalDeleteTurn .btn-eliminar').one('click', function() {
                $.ajax({
                    url: '../turnos/eliminar-turn.php',
                    method: 'POST',
                    data: {
                        turn_idEdit: turnIdEdit
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            actualizarLista();
                            $('#ModalDeleteTurn').modal('hide'); // Cierra el modal
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error al eliminar. Por favor, intenta nuevamente.');
                        $('#ModalDeleteturn').modal('hide'); // Cierra el modal en caso de error
                    }
                });
            });
        });

        function actualizarLista() {
            $.ajax({
                url: '../turnos/obtener-lista.php',
                method: 'GET',
                success: function(data) {
                    $('#listaturn').html(data);
                    toastr.success("Lista actualizada");
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al actualizar la lista.');
                }
            });
        }

    });
</script>