<?php
$inventario = [
    ['nombre' => 'Disco SSD 1 TB', 'precio' => 79.90, 'cantidad' => 6],
    ['nombre' => 'Hub USB-C', 'precio' => 32.50, 'cantidad' => 3],
    ['nombre' => 'Memoria RAM 16 GB', 'precio' => 47.25, 'cantidad' => 9],
    ['nombre' => 'Base para laptop', 'precio' => 28.00, 'cantidad' => 4],
    ['nombre' => 'Adaptador HDMI', 'precio' => 14.75, 'cantidad' => 12],
    ['nombre' => 'Micrófono USB', 'precio' => 68.40, 'cantidad' => 2]
];

function calcularValorProducto($articulo) {
    return $articulo['precio'] * $articulo['cantidad'];
}

function calcularInventarioCompleto($articulos) {
    $acumulado = 0;

    foreach ($articulos as $articulo) {
        $acumulado += calcularValorProducto($articulo);
    }

    return $acumulado;
}

function contarExistenciasBajas($articulos) {
    $cantidadBaja = 0;

    foreach ($articulos as $articulo) {
        if ($articulo['cantidad'] < 5) {
            $cantidadBaja++;
        }
    }

    return $cantidadBaja;
}

function imprimirFilasInventario($articulos) {
    foreach ($articulos as $posicion => $articulo) {
        $valor = calcularValorProducto($articulo);
        $alerta = $articulo['cantidad'] < 5 ? ' stock-bajo' : '';

        echo '<tr class="' . trim($alerta) . '">';
        echo '<td>' . ($posicion + 1) . '</td>';
        echo '<td>' . htmlspecialchars($articulo['nombre']) . '</td>';
        echo '<td>$' . number_format($articulo['precio'], 2) . '</td>';
        echo '<td>' . $articulo['cantidad'] . '</td>';
        echo '<td>$' . number_format($valor, 2) . '</td>';
        echo '</tr>';
    }
}

$totalInventario = calcularInventarioCompleto($inventario);
$productosBajos = contarExistenciasBajas($inventario);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de accesorios</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: "Trebuchet MS", Arial, sans-serif; background: #f3efe7; color: #24342c; }
        .envoltura { width: min(1000px, 92%); margin: 40px auto; }
        .cabecera { display: flex; justify-content: space-between; gap: 20px; align-items: end; margin-bottom: 20px; }
        .cabecera h1 { margin: 0; font-size: 30px; color: #234f3d; }
        .cabecera p { margin: 6px 0 0; color: #6d786f; }
        .resumen { display: flex; gap: 10px; }
        .dato { background: #234f3d; color: #fff; border-radius: 12px; padding: 12px 16px; min-width: 145px; }
        .dato span { display: block; font-size: 11px; text-transform: uppercase; opacity: .75; }
        .dato b { display: block; margin-top: 4px; font-size: 20px; }
        .tabla { background: #fff; border-radius: 16px; padding: 10px; box-shadow: 0 12px 28px rgba(57, 55, 42, .10); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 13px 14px; border-bottom: 1px solid #ece8df; text-align: left; }
        th { color: #58665e; font-size: 12px; text-transform: uppercase; letter-spacing: .05em; }
        tbody tr:last-child td { border-bottom: 0; }
        .stock-bajo { background: #fff8e7; }
        .nota { margin-top: 12px; font-size: 13px; color: #7b7054; }
        @media (max-width: 760px) { .cabecera { display: block; } .resumen { margin-top: 16px; flex-wrap: wrap; } .tabla { overflow-x: auto; } }
    </style>
</head>
<body>
<main class="envoltura">
    <header class="cabecera">
        <div>
            <h1>Inventario de accesorios</h1>
            <p>Consulta de existencias y valor almacenado por producto.</p>
        </div>
        <div class="resumen">
            <div class="dato"><span>Valor total</span><b>$<?= number_format($totalInventario, 2) ?></b></div>
            <div class="dato"><span>Stock menor a 5</span><b><?= $productosBajos ?> productos</b></div>
        </div>
    </header>

    <section class="tabla">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Precio unitario</th>
                    <th>Disponibles</th>
                    <th>Valor almacenado</th>
                </tr>
            </thead>
            <tbody>
                <?php imprimirFilasInventario($inventario); ?>
            </tbody>
        </table>
    </section>
    <p class="nota">Las filas resaltadas corresponden a productos con menos de 5 unidades.</p>
</main>
</body>
</html>
