<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Inicio | Productos</h1>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders mb-5">
    <button class="añadir" type="button" onclick="frmProducto();"><span class="material-symbols-outlined">add</span></button>
    <div class="recent-orders tabla">
        <table class="table" id="tblProductos">
            <thead class="thead-light">
                <tr>
                    <td>#</td>
                    <td>Código</td>
                    <td>Nombre</td>
                    <td>Precio</td>
                    <td>Stock</td>
                    <td>Estado</td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>
<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ba-primary">
                <h5 class="modal-title title-modal titleColor" id="title">Nuevo Producto</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProducto">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo de barra">
                    </div>
                    <div class="form-group">
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del producto">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="precio_compra" class="form-control" type="text" name="precio_compra" placeholder="Precio Compra">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="precio_venta" class="form-control" type="text" name="precio_venta" placeholder="Precio Venta">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marca">Marca</label>
                                <select id="marca" name="marca" class="form-control">
                                    <?php foreach ($data['marcas'] as $row) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
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
            <div class="modal-footer">
                <button class="añadir" type="button" onclick="registrarPro(event);" id="btnAccion">Registrar</button>                                    
            </div>
        </div>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>