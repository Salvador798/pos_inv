<?php include "Views/Components/header.php"; ?>
<h1>Inicio</h1>
<div class="date">
    <input type="date" value="<?php date_default_timezone_set('America/Caracas');
                                echo date("Y-m-d"); ?>" disabled>
</div>
<!-- CONTENIDO DE RESUMEN -->
<div class="elementos">
    <div class="elemento">
        <div class="topElemento">
            <span class="material-symbols-outlined">person</span>
            <span class="material-symbols-outlined">analytics</span>
        </div>
        <div class="centro">
            <h3>Usuarios</h3>
            <h3><?php echo $data['usuarios']['total']; ?></h3>
        </div>
    </div>
    <!-- ------------- Carta de Proveedor -------------- -->
    <div class="elemento2">
        <div class="topElemento">
            <span class="material-symbols-outlined">group</span>
            <span class="material-symbols-outlined">analytics</span>
        </div>
        <div class="centro">
            <h3>Proveedores</h3>
            <h3><?php echo $data['proveedores']['total']; ?></h3>
        </div>
    </div>
    <!-- ------------- Cartas de Producto -------------- -->
    <div class="elemento3">
        <div class="topElemento">
            <span class="material-symbols-outlined">construction</span>
            <span class="material-symbols-outlined">analytics</span>
        </div>
        <div class="centro">
            <h3>Repuestos</h3>
            <h3><?php echo $data['productos']['total']; ?></h3>
        </div>
    </div>
    <!-- ------------- Carta de las Compras -------------- -->
    <div class="elemento">
        <div class="topElemento">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="material-symbols-outlined">analytics</span>
        </div>
        <div class="centro">
            <h3>Entrada de Repuestos</h3>
            <h3><?php echo $data['compras']['total']; ?></h3>
        </div>
    </div>
    <!-- ------------- Card de las Ventas -------------- -->
    <div class="elemento2">
        <div class="topElemento">
            <span class="material-symbols-outlined">inventory</span>
            <span class="material-symbols-outlined">analytics</span>
        </div>
        <div class="centro">
            <h3>Salida de Repuestos</h3>
            <h3><?php echo $data['ventas']['total']; ?></h3>
        </div>
    </div>
    <!-- ------------- Fin de la carta Ventas -------------- -->
</div>
<!-- TABLA DE RECIENTES VENTAS -->
<div class="container">
</div>
<?php include "Views/Components/footer.php"; ?>