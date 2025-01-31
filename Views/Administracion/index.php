<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Datos de la Empresa</h1>
<h6 class="title flex align-center"><a href="<?php echo APP_URL; ?>Administracion/home">Inicio</a> / Configuración</h6>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders mb-5 box1">
    <div class="recent-orders tabla">
        <div class="card">
            <div class="card-body">
                <form id="frmEmpresa">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $data['configuracion']['id']; ?>">
                                <label for="rif">RIF</label>
                                <input id="rif" class="form-control" type="text" name="rif" placeholder="RIF" value="<?php echo $data['configuracion']['rif']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $data['configuracion']['id']; ?>">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $data['configuracion']['nombre']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono" value="<?php echo $data['configuracion']['telefono']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Dirección" value="<?php echo $data['configuracion']['direccion']; ?>">
                            </div>
                        </div>
                    </div>
                    <button class="añadir" type="button" onclick="modificarEmpresa()">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="recent-orders mb-5 box1">
    <div class="recent-orders tabla">
        <div class="card">
            <div class="card-body">
                <form id="frmDolar">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $data['tasa']['id']; ?>">
                                <label for="precio_dolar">Tasa del Día</label>
                                <input id="precio_dolar" class="form-control" type="text" name="precio_dolar" placeholder="Tasa del Día<" value="<?php echo $data['tasa']['precio_dolar']; ?>">
                            </div>
                        </div>
                    </div>
                    <button class="añadir" type="button" onclick="modificarDolar()">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Components/footer.php"; ?>