<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Inicio | Proveedores</h1>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders mb-5">
    <button class="añadir" type="button" onclick="frmProveedor();"><span class="material-symbols-outlined">add</span></button>
    <div class="recent-orders tabla">
        <table class="table" id="tblProveedores">
            <thead class="thead-light">
                <tr>
                    <td>#</td>
                    <td>Rif</td>
                    <td>Nombre</td>
                    <td>teléfono</td>
                    <td>Dirección</td>
                    <td>Estado</td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>
<div id="nuevo_proveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ba-primary">
                <h5 class="modal-title title-modal titleColor" id="title">Nuevo Proveedor</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProveedor">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <input id="rif" class="form-control" type="text" name="rif" placeholder="Rif">
                    </div>
                    <div class="form-group">
                         <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="title-modal">Teléfono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <textarea id="direccion" class="form-control" name="direccion" placeholder="Dirección" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="añadir" type="button" onclick="registrarProve(event);" id="btnAccion">Registrar</button>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>