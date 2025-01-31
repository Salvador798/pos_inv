<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Salida</h1>
<h6 class="title flex align-center"><a href="<?php echo APP_URL; ?>Administracion/home">Inicio</a> / Salida</h6>

<?php if ($_SESSION['rol'] == 'Administrador') { ?>
    <button class="añadir ">
        <a class="fixText" href="<?php echo APP_URL; ?>Entradas/historial_salidas">Historial de Salidas</a>
    </button>
<?php } ?>
<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders5">
    <div class="recent-orders">
        <div class="card-body">
            <form id="frmVenta" autocomplete="off">
                <div class="row tabla">
                    <div class="col-md-3 venta">
                        <div class="form-group">
                            <input type="hidden" id="id" name="id">
                            <label for="codigo">Código del Repuesto</label>
                            <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código del Repuesto" onkeyup="buscarCodigoSalida(event)">
                        </div>
                    </div>
                    <div class="col-md-5 venta">
                        <div class="form-group">
                            <label for="nombre">Descripción del Repuesto</label>
                            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Descripción del Repuesto" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 venta">
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="Cantidad" onkeyup="calcularPrecioSalida(event)" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 venta">
                        <div class="form-group">
                            <label for="Precio Salida">Precio Salida</label>
                            <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio Salida" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 venta">
                        <div class="form-group">
                            <label for="sub_total">Sub Total</label>
                            <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub Total" disabled>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tabla">
            <table class="table stripe hover compact">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sub total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tblDetalleSalida">
                </tbody>
            </table>
        </div>
        <div class="row tabla">
            <div class="col-md-4 ml-auto ventaTotal">
                <div class="form-group">
                    <label for="total">Total:</label>
                    <input id="total" class="form-control" type="text" name="total" placeholder="Total" disabled>
                </div>
            </div>
            <div class="col-md-4 mt-3 ventaTotal">
                <div class="form-group">
                    <button class="btn btn-success mt-2 btn-block " type="button" onclick="procesar(0)">Generar Salida</button>

                </div>
            </div>

        </div>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>