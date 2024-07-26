<!-- Modal Agregar  -->
<div class="modal fade" id="ModalRegistermat" tabindex="-1" aria-labelledby="ModalRegistermat" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5">Registrar Matrícula</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="agregarMatricula">
                    <div class="mb-3">
                        <label for="fechaMatricula" class="form-label">Fecha de Matricula</label>
                        <input type="date" class="form-control" name="fechaMatricula" required>
                    </div>
                    <div class="mb-3">
                        <label for="codEstudiante" class="form-label">Estudiante</label>
                        <input type="text" class="form-control" name="codEstudiante" id="codEstudiante" required>
                        <div id="suggestions" class="list-group" style="display: none; position: absolute; z-index: 1000;"></div>
                        <br>
                        <input type="text" class="form-control" id="nombreEstudiante" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="especialidadAula" class="form-label">Aula</label>
                        <select class="form-control" name="especialidadAula" required>
                            <option>Elige una opción</option>
                            <?php
                            foreach ($aulas as $aula) {
                                echo "<option value='" . $aula['Id_Aula'] . "'>" . $aula['Nombre_Especialidad'] . " " . "(Turno: " . $aula['Nombre_Turno'] . " " .  $aula['Perido_Especialidad'] . ")" . "</option>";
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
<!-- Modal Editar  -->
<div class="modal fade" id="ModalEditmat" tabindex="-1" aria-labelledby="ModalEditmat" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5">Editar Matrícula</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMatricula">
                    <div class="mb-3">
                        <label for="fechaMatricula" class="form-label">Fecha de Matricula</label>
                        <input type="date" class="form-control" name="idMatriculaEdit" id="idMatriculaEdit" required>
                        <input type="date" class="form-control" name="fechaMatriculaEdit" id="fechaMatriculaEdit" required>
                    </div>
                    <div class="mb-3">
                        <label for="codEstudiante" class="form-label">Estudiante</label>
                        <input type="text" class="form-control" name="codEstudianteEdit" id="codEstudianteEdit" required>
                        <div id="suggestions" class="list-group" style="display: none; position: absolute; z-index: 1000;"></div>
                        <br>
                        <input type="text" class="form-control" id="nombreEstudiante" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="especialidadAula" class="form-label">Aula</label>
                        <select class="form-control" name="especialidadAulaEdit" required id="especialidadAulaEdit">
                            <option>Elige una opción</option>
                            <?php
                            foreach ($aulas as $aula) {
                                echo "<option value='" . $aula['Id_Aula'] . "'>" . $aula['Nombre_Especialidad'] . " " . "(Turno: " . $aula['Nombre_Turno'] . " " .  $aula['Perido_Especialidad'] . ")" . "</option>";
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
<div class="modal fade" id="ModalDeleteMat" tabindex="-1" aria-labelledby="ModalDeleteMat" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5">Eliminar Matricula</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estas seguro de Eliminar la Matricula?
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
        $('#codEstudiante').on('input', function() {
            let query = $(this).val();

            if (query.length >= 3) {
                $.ajax({
                    url: '../matriculas/buscar_usuario.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#suggestions').html(data);
                        $('#suggestions').show();
                    }
                });
            } else {
                $('#suggestions').hide();
            }
        });

        $(document).on('click', '.suggestion-item', function() {
            let codigo = $(this).data('codigo');
            let nombre = $(this).data('nombre');
            let apellidos = $(this).data('apellidos');

            $('#codEstudiante').val(codigo);
            $('#nombreEstudiante').val(nombre + " " + apellidos);
            $('#suggestions').hide();
        });

        $('#agregarMatricula').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: '../matriculas/registrar_matricula.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#ModalRegistermat').modal('hide');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al agregar Por favor, intenta nuevamente.');
                }
            });
        });

        $(document).on('click', '.eliminar-matricula', function() {
            var matIdEdit = $(this).data('id');
            $('#ModalDeleteMat').modal('show');

            $('#ModalDeleteMat .btn-eliminar').one('click', function() {
                $.ajax({
                    url: '../matriculas/eliminar-matricula.php',
                    method: 'POST',
                    data: {
                        mat_idEdit: matIdEdit
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#ModalDeleteMat').modal('hide'); // Cierra el modal
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error al eliminar. Por favor, intenta nuevamente.');
                        $('#ModalDeleteMat').modal('hide'); // Cierra el modal en caso de error
                    }
                });
            });
        });

        // Evento click del botón editar
        $(document).on('click', '.editar-matricula', function() {
            var matIdEdit = $(this).data('id');
            $.ajax({
                url: '../matricula/obtener-mat.php',
                method: 'POST',
                data: {
                    mat_idEdit: matIdEdit
                },
                dataType: 'json',
                success: function(response) {
                    $('#idturnEdit').val(response.Id_Matricula);
                    $('#nombreTurnEdit').val(response.Fecha_Matricula);
                    $('#horarioTurnEdit').val(response.Id_Aula);
                },
                error: function(xhr, status, error) {
                    toastr.error('Error al obtener los detalles. Por favor, intenta nuevamente.');
                }
            });
        });
    });
</script>