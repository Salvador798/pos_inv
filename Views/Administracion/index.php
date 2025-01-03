<?php include "Views/Components/header.php"; ?>

<h1 class="title flex align-center">Inicio | Configuración | Datos Personales</h1>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders mb-5 box1">
    <div class="recent-orders tabla">
        <div class="card">
            <div class="card-body">
                <form id="frmEmpresa">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $data['nombre']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono" value="<?php echo $data['telefono']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Dirección" value="<?php echo $data['direccion']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mensaje">Mensaje</label>
                                <textarea id="mensaje" class="form-control" name="mensaje" placeholder="Mensaje" rows="3"><?php echo $data['mensaje']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="modificarEmpresa()">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Components/footer.php"; ?>