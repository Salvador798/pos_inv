<?php include "Views/Components/header.php"; ?>
<?php print_r($data); ?>
<h1 class="title flex align-center">Bitacora De Usuarios</h1>
<h6 class="title flex align-center"><a href="<?php echo APP_URL; ?>Administracion/home">Inicio</a> / <a href="<?php echo APP_URL; ?>Usuarios/index">Usuarios</a> / Bitacora</h6>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders">
    <button class="añadir">
        <a class="fixText" href="<?php echo APP_URL; ?>Usuarios" title="Usuarios"><span class="material-symbols-outlined">
                person
            </span></a>
    </button>


    <div class="recent-orders tabla">
        <div class="d-grid gap-2 d-md-flex justify-content-md-between mb-4">
            <div class="container">
                <div class="fechas">
                    <label for="startDate">Fecha de inicio:</label>
                    <input type="date" id="startDate" name="startDate" max="" />

                    <label for="endDate">Fecha de fin:</label>
                    <input type="date" id="endDate" name="endDate" max="" />
                </div>
            </div>
            <div>
                <button class="añadirpdf mt-2 btn-block text-right" title="Gestionar Reporte de Bitacora">
                    <a class="fixText" onclick="btnPDFBitacora();">
                        <span class="material-symbols-outlined">
                            picture_as_pdf
                        </span>
                    </a>
                </button>
            </div>
        </div>
        <table class="table stripe hover compact " id="tblBitacora">
            <thead class="thead-light">
                <tr>
                    <td>Usuario</td>
                    <td>Módulo</td>
                    <td>Acción</td>
                    <td>Afectado</td>
                    <td>Fecha</td>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>

<?php include "Views/Components/footer.php"; ?>
<script>
    dateFilter(["tblBitacora"], 4);
</script>