<?php
$calificaciones = [78, 95, 67, 88, 91, 72, 60, 84, 100, 76];

$estadisticas = [
    'cantidad' => count($calificaciones),
    'suma' => 0,
    'maxima' => $calificaciones[0],
    'minima' => $calificaciones[0],
    'desde_71' => 0,
    'menores_71' => 0
];

foreach ($calificaciones as $calificacion) {
    $estadisticas['suma'] += $calificacion;

    if ($calificacion > $estadisticas['maxima']) {
        $estadisticas['maxima'] = $calificacion;
    }

    if ($calificacion < $estadisticas['minima']) {
        $estadisticas['minima'] = $calificacion;
    }

    if ($calificacion >= 71) {
        $estadisticas['desde_71']++;
    } else {
        $estadisticas['menores_71']++;
    }
}

$estadisticas['promedio'] = $estadisticas['suma'] / $estadisticas['cantidad'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de calificaciones</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: "Segoe UI", Tahoma, sans-serif; background: #edf2ee; color: #183026; }
        .pagina { width: min(980px, 92%); margin: 38px auto; }
        .encabezado { background: #174d37; color: #fff; padding: 28px 32px; border-radius: 18px 18px 0 0; }
        .encabezado p { margin: 7px 0 0; color: #d9eadf; }
        .contenido { background: #fff; padding: 30px 32px; border-radius: 0 0 18px 18px; box-shadow: 0 18px 40px rgba(32, 61, 45, .12); }
        .metricas { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; margin-bottom: 28px; }
        .metrica { border: 1px solid #dce7df; border-radius: 12px; padding: 15px; background: #f8fbf9; }
        .metrica span { display: block; font-size: 12px; color: #60766a; text-transform: uppercase; letter-spacing: .06em; }
        .metrica strong { display: block; margin-top: 6px; font-size: 24px; color: #174d37; }
        table { width: 100%; border-collapse: collapse; overflow: hidden; border-radius: 10px; }
        th { background: #245f46; color: #fff; font-weight: 600; }
        th, td { padding: 12px 14px; text-align: left; border-bottom: 1px solid #e3ebe6; }
        tbody tr:nth-child(even) { background: #f7faf8; }
        .estado { display: inline-block; padding: 5px 10px; border-radius: 999px; font-size: 13px; font-weight: 600; }
        .cumple { background: #dff3e7; color: #17613d; }
        .no-cumple { background: #f8e5e3; color: #9f332d; }
        h2 { margin-top: 0; font-size: 20px; }
    </style>
</head>
<body>
<main class="pagina">
    <section class="encabezado">
        <h1>Reporte del grupo</h1>
        <p>Análisis de las 10 calificaciones registradas.</p>
    </section>

    <section class="contenido">
        <div class="metricas">
            <div class="metrica"><span>Evaluados</span><strong><?= $estadisticas['cantidad'] ?></strong></div>
            <div class="metrica"><span>Suma</span><strong><?= $estadisticas['suma'] ?></strong></div>
            <div class="metrica"><span>Promedio</span><strong><?= number_format($estadisticas['promedio'], 2) ?></strong></div>
            <div class="metrica"><span>Mayor nota</span><strong><?= $estadisticas['maxima'] ?></strong></div>
            <div class="metrica"><span>Menor nota</span><strong><?= $estadisticas['minima'] ?></strong></div>
            <div class="metrica"><span>Nota ≥ 71</span><strong><?= $estadisticas['desde_71'] ?></strong></div>
            <div class="metrica"><span>Nota &lt; 71</span><strong><?= $estadisticas['menores_71'] ?></strong></div>
        </div>

        <h2>Detalle de calificaciones</h2>
        <table>
            <thead>
                <tr><th>Estudiante</th><th>Calificación</th><th>Clasificación</th></tr>
            </thead>
            <tbody>
            <?php foreach ($calificaciones as $indice => $calificacion): ?>
                <tr>
                    <td>Estudiante <?= $indice + 1 ?></td>
                    <td><?= $calificacion ?></td>
                    <td>
                        <?php if ($calificacion >= 71): ?>
                            <span class="estado cumple">Igual o superior a 71</span>
                        <?php else: ?>
                            <span class="estado no-cumple">Inferior a 71</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>
</body>
</html>
