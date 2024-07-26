<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirige a la página de inicio de sesión si no está autenticado
    header("Location: ../../index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$FotoUsuario = $usuario['Foto_Usuario'];
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ISTP Tecnosur</title>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body onload="iniciarCarga()">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a class="text-nowrap logo-img" onclick="cargarcontenido('#cuerpo','./dashboard.php')">
                        <img src="../../assets/logo_ts_negro.png" width="140" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link" onclick="cargarcontenido('#cuerpo','./dashboard.php')">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Usuarios</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" onclick="cargarcontenido('#cuerpo','../usuarios/lista-usuarios.php')">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Lista de Usuarios</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" onclick="cargarcontenido('#cuerpo','../usuarios/usuarios-deshabilitados.php')">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Usuarios Deshabilitados</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Especialidades</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" onclick="cargarcontenido('#cuerpo','../especialidades/lista-especialidades.php')">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Lista de Especialidades</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Turnos</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" onclick="cargarcontenido('#cuerpo','../turnos/lista-turnos.php')">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Lista de Turnos</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Sesiones</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" onclick="cargarcontenido('#cuerpo','../sesiones/lista-sesiones.php')">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Lista de Sesiones</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">

            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php if ($FotoUsuario == null) { ?>
                                        <img src="../../assets/img-profile/default.png" width="35" height="35" class="rounded-circle" />
                                    <?php } else { ?>
                                        <img src="../../assets/<?php echo $FotoUsuario; ?>" width="35" height="35" class="rounded-circle" />
                                    <?php } ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">Mi Perfil</p>
                                        </a>
                                        <a href="./logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Cerrar Sesión</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            <div class="container-fluid" id="cuerpo">

            </div>
        </div>
    </div>
    <script>
        function cargarcontenido(div, url) {
            sessionStorage.setItem('ultimaPagina', url); // Guarda la URL en sessionStorage
            $.ajax({
                url: url,
                method: 'GET', // O 'POST' si prefieres
                success: function(response) {
                    $(div).html(response); // Actualiza el contenido del div con la respuesta del servidor
                },
                error: function(xhr, status, error) {
                    // Maneja los errores si es necesario
                    console.error('Error al cargar el contenido:', error);
                }
            });
        }

        function iniciarCarga() {
            var ultimaPagina = sessionStorage.getItem('ultimaPagina'); // Obtén la última URL de sessionStorage
            if (ultimaPagina) {
                cargarcontenido('#cuerpo', ultimaPagina); // Carga la última página si existe
            } else {
                cargarcontenido('#cuerpo', './dashboard.php'); // Carga el dashboard por defecto
            }
        }
    </script>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>