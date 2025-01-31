<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title><?php echo ($titulo); ?></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="<?php echo APP_URL ?>Assets/iconosFuente/material-icon.css">
    <link rel="stylesheet" href="<?php echo APP_URL ?>Assets/css/api.css">
    <link rel="stylesheet" href="<?php echo APP_URL ?>Assets/css/datatable.min.css">
    <link rel="stylesheet" href="<?php echo APP_URL ?>Assets/estilosDataTable/datatable.min.css">
    <link rel='stylesheet' type='text/css' media='screen' href='<?php echo APP_URL; ?>Assets/css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='<?php echo APP_URL; ?>Assets/css/animate.min.css'>
</head>

<body>


    <div>
        <!-- COMIENZO DEL SIDEBAR -->
        <div class="sideBar">
            <div class="top">
                <div class="logo">
                    <div id="logotipo">
                        <img src="<?php echo APP_URL; ?>Assets/img/logo2.jpg" class="logoImg"></img>
                    </div>
                    <span>Autorepuestos Espinoza C.A</span>
                </div>
            </div>



            <!-- Botones -->
            <ul>
                <li>
                    <a href="<?php echo APP_URL; ?>Administracion/home" class="<?php echo ($titulo == 'Dashboard') ? 'active' : ''; ?>">
                        <span id="icons" class="material-symbols-outlined">home</span>
                        <span class="navItem">Inicio</span>
                    </a>
                </li>


                <li>
                    <a href="<?php echo APP_URL; ?>Repuestos" class="<?php echo ($titulo == 'Repuestos') ? 'active' : ''; ?>">
                        <span id="icons" class="material-symbols-outlined">inventory</span>
                        <span class="navItem">Repuestos</span>
                    </a>
                </li>

                <?php if ($_SESSION['rol'] <> 'Vendedor') { ?>
                    <li>
                        <a href="<?php echo APP_URL; ?>Entradas" class="<?php echo (strpos($titulo, 'Entrada') !== false) ? 'active' : ''; ?>">
                            <span id="icons" class="material-symbols-outlined">inventory_2</span>
                            <span class="navItem">Entrada</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['rol'] <> 'Almacenista') { ?>
                    <li>
                        <a href="<?php echo APP_URL; ?>Entradas/salidas" class="<?php echo (strpos($titulo, 'Salida') !== false) ? 'active' : ''; ?>">
                            <span id="icons" class="material-symbols-outlined">
                                storefront
                            </span>
                            <span class="navItem">Salida</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['rol'] <> 'Vendedor') { ?>
                    <li>
                        <a href="<?php echo APP_URL; ?>Proveedores" class="<?php echo ($titulo == 'Proveedores') ? 'active' : ''; ?>">
                            <span id="icons" class="material-symbols-outlined">
                                diversity_3
                            </span>
                            <span class="navItem">Proveedores</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['rol'] <> 'Vendedor') { ?>
                    <li>
                        <a href="<?php echo APP_URL; ?>Marcas" class="<?php echo ($titulo == 'Marcas') ? 'active' : ''; ?>">
                            <span id="icons" class="material-symbols-outlined">label</span>
                            <span class="navItem">Marcas</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['rol'] <> 'Vendedor') { ?>
                    <li>
                        <a href="<?php echo APP_URL; ?>Categorias" class="<?php echo ($titulo == 'Categorias') ? 'active' : ''; ?>">
                            <span id="icons" class="material-symbols-outlined">category</span>
                            <span class="navItem">Categorias</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['rol'] == 'Administrador') { ?>
                    <li>
                        <a href="<?php echo APP_URL; ?>Usuarios" class="<?php echo ($titulo == 'Usuarios' || $titulo == 'Bitacora') ? 'active' : ''; ?>">
                            <span id="icons" class="material-symbols-outlined">person</span>
                            <span class="navItem">Usuarios</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['rol'] == 'Administrador') { ?>
                    <li>
                        <a href="<?php echo APP_URL; ?>Administracion" class="<?php echo ($titulo == 'Configuración') ? 'active' : ''; ?>">
                            <span id="icons" class="material-symbols-outlined">settings</span>
                            <span class="navItem">Configuracion</span>
                        </a>
                    </li>
                <?php } ?>

                <li>
                    <a href="javascript:void(0);" onclick="manual();">
                        <span id="icons" class="material-symbols-outlined">
                            picture_as_pdf
                        </span>
                        <span class="navItem">Manual de Us.</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo APP_URL; ?>Usuarios/salir">
                        <span id="icons" class="material-symbols-outlined">logout</span>
                        <span class="navItem">Salir</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <!-- FINAL DEL SIDEBAR -->
    <!-- CONTENIDO PRINCIPAL DE LA VISTA -->
    <div class="contenidoMain">
        <div class="usuario">
            <div class="container">
                <div class="date">
                    <input type="date" value="<?php date_default_timezone_set('America/Caracas');
                                                echo date("Y-m-d"); ?>" disabled>
                </div>
            </div>
            <div id="usuarioContenedor">
                <img src="<?php echo APP_URL; ?>Assets/iconosFuente/user.png" alt="usuario" class="usuarioImg">
                <div>
                    <p class="bold"><?php echo Strtoupper($_SESSION['nombre']); ?></p>
                    <p><?php echo Strtoupper($_SESSION['usuario']); ?></p>
                </div>
            </div>
        </div>
        <span class="material-symbols-outlined" id="btn">menu</span>
        <div class="container">