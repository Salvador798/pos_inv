<?php include "Views/Components/header.php"; ?>
<h1 class="title flex align-center">Historial De Salida</h1>
<h6 class="title flex align-center"><a href="<?php echo APP_URL; ?>Administracion/home">Inicio</a> / <a href="<?php echo APP_URL; ?>Entradas/salidas">Salida</a> / Historial</h6>

<button class="añadir">
    <a class="fixText" href="<?php echo APP_URL; ?>Entradas/historial_salidas_g">Mostrar General</a>
</button>
<!-- -------------------- END OF TOTALS ------------>
<div class="recent-orders mb-5">
    <div class="recent-orders tabla">
        <table class="table stripe hover compact" id="t_historial_v">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Total</td>
                    <td>Fecha</td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="table__body">
            </tbody>
        </table>
    </div>
</div>

<?php include "Views/Components/footer.php"; ?>