<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Repuestos</h1>
<h6 class="title flex align-center"><a href="<?php APP_URL; ?>Administracion/home">Inicio</a> / Repuestos</h6>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders mb-5">
    <?php if ($_SESSION['rol'] <> 'Vendedor') { ?>
        <button class="añadir" type="button" title="Registrar" onclick="frmRepuesto();"><span class="material-symbols-outlined">add</span></button>
    <?php } ?>
    <div class="recent-orders tabla">
        <div class="d-grid gap-2 d-md-flex justify-content-md-between mb-4">
            <div class="container">
                <div class="filtros">
                    <p class="lead">Filtrar por:</p>
                    <div class="filtro">
                        <div class="col-md-10">
                            <select id="estFilter" class="form-select mt-2 float">
                                <option selected disabled>Estado</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="">Todo</option>
                            </select>
                        </div>
                        <div class="col-md-10">

                            <select id="filter-marca" class="form-select mt-2 float">
                                <option value="">Marca</option>
                                <?php foreach ($data['marcas'] as $marca) : ?>
                                    <option value="<?php echo $marca['nombre']; ?>"><?php echo $marca['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-10">
                            <select id="filter-categoria" class="form-select mt-2 float">
                                <option value="">Categoria</option>
                                <?php foreach ($data['categorias'] as $categoria) : ?>
                                    <option value="<?php echo $categoria['nombre']; ?>"><?php echo $categoria['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div>
                <button class="añadirpdf mt-2 btn-block text-right" title="Gestionar Reporte de Repuestos">
                    <a class="fixText" onclick="btnPDFRepuestos();">
                        <span class="material-symbols-outlined">
                            picture_as_pdf
                        </span>
                    </a>
                </button>
                <button class="añadirpdf" id="clear-filters" title="Eliminar Filtro">
                    <span class="material-symbols-outlined">
                        close
                    </span>
                </button>
            </div>
        </div>
        <div class="filters-container">

        </div>

        <div id="active-filters" class="active-filters">
            <!-- Aquí aparecerán los filtros activos -->
        </div>


        <table class="table stripe hover compact" id="tblRepuestos">
            <thead class="thead-light">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                    <th>Precio Dolar</th>
                    <th>Precio Bs</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>
<div id="nuevo_repuesto" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ba-primary">
                <h5 class="modal-title title-modal titleColor" id="title">Nuevo Repuesto</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmRepuesto">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="codigo">Código</label>
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo del Repuesto" onkeyup="mayus(this);">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre *</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Repuesto" onkeyup="mayus(this);">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precio_compra">Precio de Compra</label>
                                <input id="precio_compra" class="form-control" type="number" name="precio_compra" placeholder="Precio Compra">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precio_venta">Precio de Venta Dolar *</label>
                                <input id="precio_venta" class="form-control" type="number" name="precio_venta" placeholder="Precio Venta Dolar">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock_minimo">Stock Minimo *</label>
                                <input id="stock_minimo" class="form-control" type="text" name="stock_minimo" placeholder="Stock Minimo">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marca">Marca *</label>
                                <select id="marca" name="marca" class="form-control">
                                    <?php foreach ($data['marcas'] as $row) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">Categoria *</label>
                                <select id="categoria" name="categoria" class="form-control">
                                    <?php foreach ($data['categorias'] as $row) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <span id="campoObligatorio">* Campo Obligatorio</span>
            <div class="modal-footer">
                <button class="añadir" type="button" onclick="registrarRep(event);" id="btnAccion">Registrar</button>
                <button class="cerrar" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>