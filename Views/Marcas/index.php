<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Marcas</h1>
<h6 class="title flex align-center"><a href="<?php APP_URL; ?>Administracion/home">Inicio</a> / Marcas</h6>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders mb-5">
    <button class="añadir" type="button" title="Registrar" onclick="frmMarca();"><span class="material-symbols-outlined">add</span></button>
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
                <button class="añadirpdf mt-2 btn-block text-right" title="Gestionar Reporte de Marcas">
                    <a class="fixText" onclick="btnPDFMarcas();">
                        <span class="material-symbols-outlined">
                            picture_as_pdf
                        </span>
                    </a>
                </button>
            </div>
        </div>
        <table class="table stripe hover compact" id="tblMarcas">
            <thead class="thead-bold">
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>
<div id="nuevo_marca" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ba-primary">
                <h5 class="modal-title title-modal titleColor" id="title">Nueva Marca</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmMarca">
                    <div class="form-group">
                        <label for="nombre">Nombre *</label>
                        <input type="hidden" id="id" name="id">
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" onkeyup="mayus(this);">
                    </div>
                </form>
            </div>
            <span id="campoObligatorio">* Campo Obligatorio</span>
            <div class="modal-footer">
                <button class="añadir" type="button" onclick="registrarMar(event);" id="btnAccion">Registrar</button>
                <button class="cerrar" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>