<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Inicio | Usuarios</h1>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders">
    <button class="añadir" type="button" onclick="frmUsuario();"><span class="material-symbols-outlined">add</span></button>
    <div class="recent-orders tabla">
        <table class="table " id="tblUsuarios">
            <thead class="thead-light">
                <tr>
                    <td>#</td>
                    <td>Usuario</td>
                    <td>Nombre</td>
                    <td>Estado</td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>
<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ba-primary">
                <h5 class="modal-title title-modal titleColor" id="title">Nuevo Usuario</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmUsuario">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="row" id="claves">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="clave" class="form-control" type="password" name="clave" placeholder="Clave">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirmar Contraseñá">
                            </div>
                        </div>
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
            <button class="añadir" type="button" onclick="registrarUser(event);" id="btnAccion">Registrar</button>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>