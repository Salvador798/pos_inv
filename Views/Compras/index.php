<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Inicio | Entrada</h1>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders">
    <div class="recent-orders">
        <div class="card-body">
            <form id="frmCompra">
                <div class="row tabla">
                    <div class="col-md-3 venta">
                        <div class="form-group">
                            <input type="hidden" id="id" name="id">
                            <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código de barras" onkeyup="buscarCodigo(event)">
                        </div>
                    </div>
                    <div class="col-md-5 venta">
                        <div class="form-group">
                            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Descripción del producto" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 venta">
                        <div class="form-group">
                            <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="Cantidad" onkeyup="calcularPrecio(event)" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 venta">
                        <div class="form-group">
                            <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio" disabled>
                        </div>
                    </div>
                    <div class="col-md-2 mt-4 venta">
                        <div class="form-group">
                            <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub Total" disabled>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tabla">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sub total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tblDetalle">
                </tbody>
            </table>
        </div>
        <div class="row tabla">
            <div class="col-md-4 ml-auto ventaTotal">
                <div class="form-group">
                    <input id="total" class="form-control" type="text" name="total" placeholder="Total" disabled>
                    <br>
                    <button class="btn btn-primary mt-2 btn-block" type="button" onclick="procesar(1)">Generar Compra</button>
                    <button class="btn btn-success mt-2 btn-block ">
                        <a class="fixText" href="<?php echo APP_URL; ?>Compras/historial">Historial de Compras</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>