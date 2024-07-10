<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Dashboard</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='<?php echo APP_URL; ?>Assets/css/main.css'>
    <link rel="stylesheet" href="<?php echo APP_URL ?>Assets/iconosFuente/material-icon.css">
    <link rel="stylesheet" href="<?php echo APP_URL ?>Assets/css/api.css">
    <link rel="stylesheet" href="<?php echo APP_URL ?>Assets/css/datatable.min.css">
    <link rel="stylesheet" href="<?php echo APP_URL ?>Assets/estilosDataTable/datatable.min.css">
</head>

<body>
    <!-- COMIENZO DEL SIDEBAR -->
    <div class="sideBar">
        <div class="top">
            <div class="logo">
                <div id="logotipo">
                    <img src="<?php echo APP_URL; ?>Assets/img/logo.jpg" class="logoImg"></img>
                </div>
                <span>Autorepuestos Espinoza C.A</span>
            </div>
        </div>
        <div class="usuario">
            <img src="<?php echo APP_URL; ?>Assets/iconosFuente/user.png" alt="usuario" class="usuarioImg">
            <div>
                <p class="bold"><?php echo Strtoupper($_SESSION['nombre']); ?></p>
                <p><?php echo Strtoupper($_SESSION['usuario']); ?></p>
            </div>
        </div>
        <ul>
            <li>
                <a href="<?php echo APP_URL; ?>Administracion/home">
                    <span id="icons" class="material-symbols-outlined">home</span>
                    <span class="navItem">Inicio</span>
                </a>
            </li>
            <li>
                <a href="<?php echo APP_URL; ?>Categorias">
                    <span id="icons" class="material-symbols-outlined">category</span>
                    <span class="navItem">Categorias</span>
                </a>
            </li>
            <li>
                <a href="<?php echo APP_URL; ?>Marcas">
                    <span id="icons" class="material-symbols-outlined">group</span>
                    <span class="navItem">Marcas</span>
                </a>
            </li>
            <li>
                <a href="<?php echo APP_URL; ?>Proveedores">
                    <span id="icons" class="material-symbols-outlined">group</span>
                    <span class="navItem">Proveedor</span>
                </a>
            </li>
            <li>
                <a href="<?php echo APP_URL; ?>Productos">
                    <span id="icons" class="material-symbols-outlined">inventory</span>
                    <span class="navItem">Repuestos</span>
                </a>
            </li>
            <li>
                <a href="<?php echo APP_URL; ?>Compras">
                    <span id="icons" class="material-symbols-outlined">inventory</span>
                    <span class="navItem">Entrada</span>
                </a>
            </li>
            <li>
                <a href="<?php echo APP_URL; ?>Compras/ventas">
                    <span id="icons" class="material-symbols-outlined">inventory</span>
                    <span class="navItem">Salida</span>
                </a>
            </li>
            <li>
                <a href="<?php echo APP_URL; ?>Usuarios">
                    <span id="icons" class="material-symbols-outlined">person</span>
                    <span class="navItem">Usuarios</span>
                </a>
            </li>
            <li>
                <a href="<?php echo APP_URL; ?>Administracion">
                    <span id="icons" class="material-symbols-outlined">settings</span>
                    <span class="navItem">Configuracion</span>
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
    <!-- FINAL DEL SIDEBAR -->
    <!-- CONTENIDO PRINCIPAL DE LA VISTA -->
    <div class="contenidoMain">
        <span class="material-symbols-outlined" id="btn">menu</span>
        <div class="container">