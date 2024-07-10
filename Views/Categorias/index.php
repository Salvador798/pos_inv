<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Inicio | Categorias</h1>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders mb-5">
    <button class="añadir" type="button" onclick="frmCategoria();"><span class="material-symbols-outlined">add</span></button>
    <div class="recent-orders tabla">
        <table class="text-center table" id="tblCategorias">
            <thead class="thead-light">
                <tr>
                    <td>#</td>
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
<div id="nuevo_categoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ba-primary">
                <h5 class="modal-title title-modal titleColor" id="title">Nueva Categoria</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCategoria">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button class="añadir" type="button" onclick="registrarCat(event);" id="btnAccion">Registrar</button>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Components/footer.php"; ?>