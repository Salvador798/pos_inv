<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="<?php echo APP_URL ?>Assets/iconosFuente/material-icon.css">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>Assets/css/style.css">
</head>

<body>
    <div class="login-wrapper">
        <form class="form" id="frmLogin">
            <img src="<?php echo APP_URL; ?>Assets/img/logo.jpg">
            <h2>Iniciar Sesión</h2>
            <div class="input-group">
                <input type="text" name="usuario" id="usuario" required>
                <label for="usuario"><span id="icons" class="material-symbols-outlined">person</span>Usuario</label>
            </div>
            <div class="input-group">
                <input type="password" name="clave" id="clave" required>
                <label for="clave"><span class="material-symbols-outlined">key</span> Contraseña</label>
            </div>
            <div class="cBtn">
                <button class="submit-btn" type="submit" onclick="frmLogin(event);">Iniciar</button>
            </div>
        </form>
    </div>
    <script>
        const APP_URL = "<?php echo APP_URL; ?>";
    </script>
    <script src="<?php echo APP_URL; ?>Assets/js/login.js"></script>
</body>

</html>