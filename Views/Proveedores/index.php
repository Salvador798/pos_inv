<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Proveedores</h1>
<h6 class="title flex align-center"><a href="<?php APP_URL; ?>Administracion/home">Inicio</a> / Proveedores</h6>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders mb-5">
    <button class="añadir" type="button" title="Registrar" onclick="frmProveedor();"><span class="material-symbols-outlined">add</span></button>
    <div class="recent-orders tabla">
        <div class="d-grid gap-2 d-md-flex justify-content-md-between mb-4">
            <div class="container">
                <div class="row mt-3">
                    <p class="lead">Filtrar por:</p>
                    <div class="col-md-10">
                        <select id="estFilter" class="form-select mt-2 float">
                            <option disabled selected>Estado</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                            <option value="">Todo</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <button class="añadirpdf mt-2 btn-block text-right" title="Gestionar Reporte de Proveedores">
                    <a class="fixText" onclick="btnPDFProve();">
                        <span class="material-symbols-outlined">
                            picture_as_pdf
                        </span>
                    </a>
                </button>
            </div>
        </div>

        <table class="table stripe hover compact" id="tblProveedores">
            <thead class="thead-light">
                <tr>
                    <th>Rif</th>
                    <th>Nombre</th>
                    <th>teléfono</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>
<div id="nuevo_proveedor" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ba-primary">
                <h5 class="modal-title title-modal titleColor" id="title">Nuevo Proveedor</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProveedor">
                    <div class="form-group">
                        <label for="rif">RIF *</label>
                        <input type="hidden" id="id" name="id">
                        <div style="display: flex; align-items: center;">
                            <select id="tRif" name="tRif" class="form-control" style="width: 80px; margin-right: 5px;">
                                <option value="J-">J-</option>
                                <option value="V-">V-</option>
                            </select>
                            <input id="rif" class="form-control" type="text" name="rif" placeholder="Numero de Rif">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre *</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" onkeyup="mayus(this);">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono *</label>
                        <input id="telefono" class="form-control" type="number" name="telefono" placeholder="Teléfono">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección *</label>
                        <textarea id="direccion" class="form-control" name="direccion" placeholder="Dirección" rows="3" onkeyup="mayus(this);"></textarea>
                    </div>
                </form>
            </div>
            <span id="campoObligatorio">* Campo Obligatorio</span>
            <div class="modal-footer">
                <button class="añadir" type="button" onclick="registrarProve(event);" id="btnAccion">Registrar</button>
                <button class="cerrar" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>