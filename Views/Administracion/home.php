<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Inicio</h1>
<h6>Inicio</h6>
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
            <h3><?php echo $data['repuestos']['total']; ?></h3>
        </div>
    </div>
</div>
<!-- TABLA DE RECIENTES VENTAS -->
<div class="recent-orders mb-5">
    <div class="recent-orders tabla">
        <div class="d-grid gap-2 d-md-flex justify-content-md-between mb-4">
            <div class="centro">
                <h3>Repuestos por Reponer</h3>
            </div>
        </div>
        <table class="table stripe hover compact" id="tblReposicion">
            <thead class="thead-bold">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Stock Disp</th>
                    <th>Stock Minimo</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>