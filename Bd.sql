index.php
/database
    /database.php
/config
    /config.php



Tabla: Sesiones
Id_Sesion PK
Id_Usuario FK
Fecha_Sesion
Hora_Sesion

Tabla: Usuarios
Id_Usuario PK
Codigo_Usuario
Contrasena_Usuario
Nombre_Usuario
Apellidos_Usuario
NroDocumento_Usuario
Correo_Usuario
Celular_Usuario
FechaNacimiento_Usuario
Direccion_Usuario
Genero_Usuario
FechaRegistro_Usuario
Estatus_Usuario
Id_Rol FK

Tabla: Roles
Id_Rol PK
Nombre_Rol

Tabla: Sesiones
Id_Sesion	PK
Id_Usuario	FK
Fecha_Sesion	
Hora_Sesion	

Tabla: Registros
Id_Registro PK
Id_Usuario	FK
Fecha_Registro	
Hora_Registro	
Accion_Registro
Tabla_Registro
IdDato_Registro


TABLA: Aulas
Id_Aula
Id_Especialidad 
Semestre_Especialidad
Seccion_Especialidad
Perido_Especialidad
Id_Turno 

Tabla:Turnos
Id_Turno
Nombre_Turno
Horario_Turno

Tabla: Especialidades
Id_Especialidad
Nombre_Especialidad


tabla Matriculas: 
Codigo_Matricula	
Fecha_Matricula
Ficha_Matricula	
Id_Usuario
Id_Aula