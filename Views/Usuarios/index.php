<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Usuarios</h1>
<h6 class="title flex align-center"><a href="<?php echo APP_URL; ?>Administracion/home">Inicio</a> / Usuarios</h6>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders">
    <div class="justify-content-md-between">
        <button class="añadir" type="button" title="Registrar" onclick="frmUsuario();"><span class="material-symbols-outlined">add</span></button>

        <button class="añadir">
            <a class="fixText" href="<?php echo APP_URL; ?>Usuarios/Bitacora" title="Bitácora"><span class="material-symbols-outlined">
                    demography
                </span></a>
        </button>
    </div>

    <div class="recent-orders tabla">
        <div class="d-grid gap-2 d-md-flex justify-content-md-between mb-4">
            <div class="container">
                <div class="row mt-3">
                    <p class="lead">Filtrar por:</p>
                    <div class="col-md-5">
                        <select id="estFilter" class="form-select mt-2">
                            <option disabled selected>Estado</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                            <option value="">Todo</option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <select id="rolFilter" class="form-select mt-2 float">
                            <option disabled selected>Rol</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Almacenista">Almacenista</option>
                            <option value="Vendedor">Vendedor</option>
                            <option value="">Todo</option>
                        </select>
                    </div>

                </div>
            </div>

            <div>
                <button class="añadirpdf mt-2 btn-block text-right" title="Gestionar Reporte de Usuarios">
                    <a class="fixText" onclick="btnPDFUsuarios();">
                        <span class="material-symbols-outlined">
                            picture_as_pdf
                        </span>
                    </a>
                </button>
            </div>
        </div>
        <table class="table stripe hover compact " id="tblUsuarios">
            <thead class="thead-light">
                <tr>
                    <th>Cédula</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>

<div id="nuevo_usuario" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ba-primary">
                <h5 class="modal-title title-modal titleColor" id="title">Nuevo Usuario</h5>
            </div>
            <div class="modal-body">
                <form autocomplete="off" method="post" id="frmUsuario">
                    <div class="form-group">
                        <label for="ci">Cédula *</label>
                        <input type="hidden" id="id" name="id">
                        <input id="ci" class="form-control" type="text" name="ci" placeholder="Cédula" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario *</label>
                        <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario" autocomplete="off" onkeyup="mayus(this);">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre *</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" onkeyup="mayus(this);">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido *</label>
                        <input id="apellido" class="form-control" type="text" name="apellido" placeholder="Apellido" onkeyup="mayus(this);">
                    </div>
                    <div class="row" id="claves">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="clavel">Contraseña *</label>
                                <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirmar">Confirmar Contraseña *</label>
                                <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirmar Contraseña" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol *</label>
                        <select id="rol" name="rol" title="Seleccione su rol" class="form-control">
                            <option value="Administrador">Administrador</option>
                            <option value="Almacenista">Almacenista</option>
                            <option value="Vendedor">Vendedor</option>
                        </select>
                    </div>
                </form>
            </div>
            <span id="campoObligatorio">* Campo Obligatorio</span>
            <div class="modal-footer">
                <button class="añadir" type="button" onclick="registrarUser(event);" id="btnAccion">Registrar</button>
                <button class="cerrar" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>