<?php
/*
 * Diferencia comprobada entre include y require:
 * al cambiar temporalmente el nombre de un archivo cargado con include,
 * PHP muestra una advertencia y continúa ejecutando el resto del script.
 * Si el archivo se carga con require y no existe, PHP detiene la ejecución
 * porque lo considera indispensable para continuar.
 */
require 'config/configuracion.php';
require 'includes/encabezado.php';
?>
<main>
    <section class="tarjeta">
        <h1>Soluciones tecnológicas sin complicaciones</h1>
        <p><?= NOMBRE_EMPRESA ?> ofrece accesorios y equipos para estudio, trabajo y uso cotidiano.</p>

        <div class="destacado">
            <strong>Información tributaria</strong>
            <p>Los cálculos del catálogo utilizan un ITBMS de <?= number_format(ITBMS * 100, 0) ?>% definido desde el archivo de configuración.</p>
        </div>

        <p>El encabezado, la navegación y el pie de página se reutilizan mediante archivos independientes, evitando repetir la misma estructura HTML en cada página.</p>
    </section>
</main>
<?php include 'includes/pie.php'; ?>
