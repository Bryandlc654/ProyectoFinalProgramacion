<!-- Modal Agregar Usuarios -->
<div class="modal fade" id="ModalRegisterUser" tabindex="-1" aria-labelledby="ModalRegisterUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalRegisterUser">Editar Usuario</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="nombresUser" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombresUser">
                    </div>
                    <div class="mb-3">
                        <label for="ApellidosUser" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="ApellidosUser">
                    </div>
                    <div class="mb-3">
                        <label for="ndocumentosUser" class="form-label">Número de Documento</label>
                        <input type="text" class="form-control" id="ndocumentosUser">
                    </div>
                    <div class="mb-3">
                        <label for="correoUser" class="form-label">Correo</label>
                        <input type="text" class="form-control" id="correoUser">
                    </div>
                    <div class="mb-3">
                        <label for="celularUser" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="celularUser">
                    </div>
                    <div class="mb-3">
                        <label for="fnacimientoUser" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fnacimientoUser">
                    </div>
                    <div class="mb-3">
                        <label for="direccionoUser" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccionoUser">
                    </div>
                    <div class="mb-3">
                        <label for="generoUser" class="form-label">Género</label>
                        <select class="form-control" name="generoUser" id="generoUser">
                            <option>Elige una opción</option>
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fregistroUser" class="form-label">Fecha de Registro</label>
                        <input type="date" class="form-control" id="fregistroUser">
                    </div>
                    <div class="mb-3">
                        <label for="estadoUser" class="form-label">Estado</label>
                        <select class="form-control" name="estadoUser" id="estadoUser">
                            <option>Elige una opción</option>
                            <option value="1">Habilitado</option>
                            <option value="0">Deshabilitado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fotoUser" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoUser">
                    </div>
                    <div class="mb-3">
                        <label for="rolUser" class="form-label">Estado</label>
                        <select class="form-control" name="rolUser" id="rolUser">
                            <option>Elige una opción</option>
                            <?php
                            while ($filaRoles = mysqli_fetch_array($resultRoles)) {
                                echo "<option value=' $filaRoles[0]'>" . $filaRoles[1] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Ver Usuarios -->
<div class="modal fade" id="ModalViewUser" tabindex="-1" aria-labelledby="ModalViewUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalViewUser">Información de Usuario</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


<!-- Modal Editar Usuarios -->
<div class="modal fade" id="ModalEditUser" tabindex="-1" aria-labelledby="ModalEditUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalEditUser">Editar Usuario</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="nombresUser" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombresUser">
                    </div>
                    <div class="mb-3">
                        <label for="ApellidosUser" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="ApellidosUser">
                    </div>
                    <div class="mb-3">
                        <label for="ndocumentosUser" class="form-label">Número de Documento</label>
                        <input type="text" class="form-control" id="ndocumentosUser">
                    </div>
                    <div class="mb-3">
                        <label for="correoUser" class="form-label">Correo</label>
                        <input type="text" class="form-control" id="correoUser">
                    </div>
                    <div class="mb-3">
                        <label for="celularUser" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="celularUser">
                    </div>
                    <div class="mb-3">
                        <label for="fnacimientoUser" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fnacimientoUser">
                    </div>
                    <div class="mb-3">
                        <label for="direccionoUser" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccionoUser">
                    </div>
                    <div class="mb-3">
                        <label for="generoUser" class="form-label">Género</label>
                        <select class="form-control" name="generoUser" id="generoUser">
                            <option>Elige una opción</option>
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fregistroUser" class="form-label">Fecha de Registro</label>
                        <input type="date" class="form-control" id="fregistroUser">
                    </div>
                    <div class="mb-3">
                        <label for="estadoUser" class="form-label">Estado</label>
                        <select class="form-control" name="estadoUser" id="estadoUser">
                            <option>Elige una opción</option>
                            <option value="1">Habilitado</option>
                            <option value="0">Deshabilitado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fotoUser" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoUser">
                    </div>
                    <div class="mb-3">
                        <label for="rolUser" class="form-label">Estado</label>
                        <select class="form-control" name="rolUser" id="rolUser">
                            <option>Elige una opción</option>
                            <?php
                            while ($filaRoles = mysqli_fetch_array($resultRoles)) {
                                echo "<option value=' $filaRoles[0]'>" . $filaRoles[1] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success">Guardar</button>
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
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>