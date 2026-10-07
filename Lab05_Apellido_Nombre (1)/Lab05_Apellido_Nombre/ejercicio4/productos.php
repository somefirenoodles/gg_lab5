<?php
require 'config/configuracion.php';
require 'includes/encabezado.php';

$catalogo = [
    ['nombre' => 'Dock USB-C 8 en 1', 'precio' => 54.90],
    ['nombre' => 'Mouse ergonómico', 'precio' => 24.50],
    ['nombre' => 'Teclado compacto', 'precio' => 39.95],
    ['nombre' => 'Soporte ajustable', 'precio' => 27.75]
];
?>
<main>
    <section class="tarjeta">
        <h2>Catálogo disponible</h2>
        <p>El impuesto se calcula a partir de la constante <strong>ITBMS</strong> definida en la configuración general.</p>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio base</th>
                    <th>ITBMS</th>
                    <th>Precio final</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($catalogo as $articulo): ?>
                <?php
                $montoImpuesto = $articulo['precio'] * ITBMS;
                $precioFinal = $articulo['precio'] + $montoImpuesto;
                ?>
                <tr>
                    <td><?= htmlspecialchars($articulo['nombre']) ?></td>
                    <td>$<?= number_format($articulo['precio'], 2) ?></td>
                    <td>$<?= number_format($montoImpuesto, 2) ?></td>
                    <td><strong>$<?= number_format($precioFinal, 2) ?></strong></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>
<?php include 'includes/pie.php'; ?>
