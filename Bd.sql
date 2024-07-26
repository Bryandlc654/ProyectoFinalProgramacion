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
