<!-- Modal Agregar  -->
<div class="modal fade" id="ModalRegisterAula" tabindex="-1" aria-labelledby="ModalRegisterAula" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5">Registrar Aula</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="agregaraula">
                    <div class="mb-3">
                        <label for="especialidadAula" class="form-label">Especialidad</label>
                        <select class="form-control" name="especialidadAula">
                            <option>Elige una opción</option>
                            <?php
                            foreach ($esps as $esp) {
                                echo "<option value='" . $esp['Id_Especialidad'] . "'>" . $esp['Nombre_Especialidad'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="semestreAula" class="form-label">Semestre</label>
                        <input type="text" class="form-control" name="semestreAula">
                    </div>
                    <div class="mb-3">
                        <label for="seccionAula" class="form-label">Sección</label>
                        <input type="text" class="form-control" name="seccionAula">
                    </div>
                    <div class="mb-3">
                        <label for="periodoAula" class="form-label">Periodo</label>
                        <input type="text" class="form-control" name="periodoAula">
                    </div>
                    <div class="mb-3">
                        <label for="turnoAula" class="form-label">Turno</label>
                        <select class="form-control" name="turnoAula">
                            <option>Elige una opción</option>
                            <?php
                            foreach ($turns as $turn) {
                                echo "<option value='" . $turn['Id_Turno'] . "'>" . $turn['Nombre_Turno'] . "</option>";
                            }
                            ?>
                        </select>
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

<!-- Modal Editar -->
<div class="modal fade" id="ModalEditAula" tabindex="-1" aria-labelledby="ModalEditAula" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5">Editar Aula</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editaula">
                    <div class="mb-3">
                        <input type="text" hidden name="idaulaEdit" id="idaulaEdit">
                        <label for="especialidadAula" class="form-label">Especialidad</label>
                        <select class="form-control" name="especialidadAulaEdit" id="especialidadAulaEdit">
                            <option>Elige una opción</option>
                            <?php
                            foreach ($esps as $esp) {
                                echo "<option value='" . $esp['Id_Especialidad'] . "'>" . $esp['Nombre_Especialidad'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="semestreAula" class="form-label">Semestre</label>
                        <input type="text" class="form-control" name="semestreAulaEdit" id="semestreAulaEdit">
                    </div>
                    <div class="mb-3">
                        <label for="seccionAula" class="form-label">Sección</label>
                        <input type="text" class="form-control" name="seccionAulaEdit" id="seccionAulaEdit">
                    </div>
                    <div class="mb-3">
                        <label for="periodoAula" class="form-label">Periodo</label>
                        <input type="text" class="form-control" name="periodoAulaEdit" id="periodoAulaEdit">
                    </div>
                    <div class="mb-3">
                        <label for="turnoAula" class="form-label">Turno</label>
                        <select class="form-control" name="turnoAulaEdit" id="turnoAulaEdit">
                            <option>Elige una opción</option>
                            <?php
                            foreach ($turns as $turn) {
                                echo "<option value='" . $turn['Id_Turno'] . "'>" . $turn['Nombre_Turno'] . "</option>";
                            }
                            ?>
                        </select>
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
<div class="modal fade" id="ModalDeleteAula" tabindex="-1" aria-labelledby="ModalDeleteAula" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5">Eliminar Aula</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estas seguro de Eliminar el Aula?
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
        $(document).on('submit', '#agregaraula', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);

            $.ajax({
                url: '../aulas/guardar_aula.php', // Cambia esto a la ruta de tu archivo PHP
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        actualizarLista();
                        $('#ModalRegisterAula').modal('hide'); // Cierra el modal
                        $('#agregaraula')[0].reset(); // Limpia los inputs
                    } else {
                        toastr.error(response.message);
                    }
                    submitButton.prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al agregar Por favor, intenta nuevamente.');
                    $('#ModalRegisterAula').modal('hide'); // Cierra el modal
                }
            });
        });

        // Evento click del botón editar
        $(document).on('click', '.editar-aula', function() {
            var aulaIdEdit = $(this).data('id');
            $.ajax({
                url: '../aulas/obtener-aula.php',
                method: 'POST',
                data: {
                    aula_idEdit: aulaIdEdit
                },
                dataType: 'json',
                success: function(response) {
                    $('#idaulaEdit').val(response.Id_Aula);
                    $('#especialidadAulaEdit').val(response.Id_Especialidad);
                    $('#semestreAulaEdit').val(response.Semestre_Especialidad);
                    $('#seccionAulaEdit').val(response.Seccion_Especialidad);
                    $('#periodoAulaEdit').val(response.Perido_Especialidad);
                    $('#turnoAulaEdit').val(response.Id_Turno);
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al obtener los detalles. Por favor, intenta nuevamente.');
                }
            });
        });

        // Evento submit del formulario para editar sede
        $(document).on('submit', '#editaula', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '../aulas/editar-aula.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        actualizarLista();
                        $('#ModalEditAula').modal('hide'); // Cierra el modal
                        $('#editaula')[0].reset(); // Limpia los inputs
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error. Por favor, intenta nuevamente.');
                    $('#ModalEditAula').modal('hide'); // Cierra el modal en caso de error
                }
            });
        });


        $(document).on('click', '.eliminar-aula', function() {
            var aulaIdEdit = $(this).data('id');
            $('#ModalDeleteAula').modal('show');

            $('#ModalDeleteAula .btn-eliminar').one('click', function() {
                $.ajax({
                    url: '../aulas/eliminar-aula.php',
                    method: 'POST',
                    data: {
                        aula_idEdit: aulaIdEdit
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            actualizarLista();
                            $('#ModalDeleteAula').modal('hide'); // Cierra el modal
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error al eliminar. Por favor, intenta nuevamente.');
                        $('#ModalDeleteAula').modal('hide'); // Cierra el modal en caso de error
                    }
                });
            });
        });

        function actualizarLista() {
            $.ajax({
                url: '../aulas/obtener-lista.php',
                method: 'GET',
                success: function(data) {
                    $('#listaAulas').html(data);
                    toastr.success("Lista actualizada");
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al actualizar la lista.');
                }
            });
        }

    });
</script>