<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Historial De Salida</h1>
<h6 class="title flex align-center"><a href="<?php echo APP_URL; ?>Administracion/home">Inicio</a> / <a href="<?php echo APP_URL; ?>Entradas/salidas">Salida</a> / Historial</h6>

<button class="añadir">
    <a class="fixText" href="<?php echo APP_URL; ?>Entradas/historial_salidas">Mostrar por Lotes</a>
</button>

<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders mb-5">
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
                <button class="añadirpdf mt-2 btn-block text-right" title="Gestionar Reporte de Salidas">
                    <a class="fixText" onclick="btnPDFSalidas();">
                        <span class="material-symbols-outlined">
                            picture_as_pdf
                        </span>
                    </a>
                </button>
            </div>
        </div>
        <table class="table stripe hover compact" id="tblHSalidas">
            <thead>
                <tr>
                    <td>Ref</td>
                    <td>Repuesto</td>
                    <td>Marca</td>
                    <td>Categoria</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Subtotal</td>
                    <td>Fecha de Salida</td>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>

<?php include "Views/Components/footer.php"; ?>
<script>
    dateFilter(["tblHEntradas"], 7);
</script>