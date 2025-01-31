<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="<?php echo APP_URL ?>Assets/iconosFuente/material-icon.css">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>Assets/css/style.css">
</head>

<body>
    <div id="membrete">
        <p>
            SISTEMA DE CONTROL INVENTARIO PARA AUTOREPUESTOS ESPINOZA C.A, CARÚPANO ESTADO SUCRE.
        </p>
    </div>
    <div class="login-wrapper">
        <form class="form" id="frmLogin" onSubmit="frmLogin(event);">
            <img src="<?php echo APP_URL; ?>Assets/img/logo2.jpg">
            <h2>Iniciar Sesión</h2>
            <div class="input-group">
                <input type="text" name="usuario" id="usuario" required>
                <label for="usuario"><span id="icons" class="material-symbols-outlined icono">person</span>Usuario</label>
            </div>
            <div class="input-group">
                <input type="password" name="clave" id="clave" required>
                <label for="clave"><span class="material-symbols-outlined icono">key</span> Contraseña</label>
            </div>
            <div class="cBtn">
                <button class="submit-btn" type="submit">Iniciar</button>
            </div>
        </form>
    </div>
    <script>
        const APP_URL = "<?php echo APP_URL; ?>";
    </script>
    <script src="<?php echo APP_URL; ?>Assets/js/login.js"></script>
    <script src="<?php echo APP_URL; ?>Assets/js/sweetalert2.all.min.js"></script>
</body>

</html>