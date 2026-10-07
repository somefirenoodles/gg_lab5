<?php
$salidaFor = [];
for ($numero = 1; $numero <= 20; $numero++) {
    $salidaFor[] = [
        'numero' => $numero,
        'tipo' => ($numero % 2 === 0) ? 'Par' : 'Impar'
    ];
}

$actual = 1;
$sumaHastaCien = 0;
while ($actual <= 100) {
    $sumaHastaCien += $actual;
    $actual++;
}

$cuentaRegresiva = [];
$segundos = 10;
do {
    $cuentaRegresiva[] = $segundos;
    $segundos--;
} while ($segundos >= 1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estructuras repetitivas</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: "Segoe UI", sans-serif; background: #101d18; color: #1c3027; }
        .contenedor { width: min(1080px, 92%); margin: 42px auto; }
        .titulo { color: #fff; margin-bottom: 24px; }
        .titulo h1 { margin: 0; font-size: 32px; }
        .titulo p { color: #a7c4b4; }
        .rejilla { display: grid; grid-template-columns: 1.35fr .8fr .8fr; gap: 18px; align-items: stretch; }
        .panel { background: #f6f8f6; border-radius: 16px; padding: 24px; }
        .panel h2 { margin-top: 0; color: #174d37; font-size: 19px; }
        .numeros { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; }
        .numero { background: #fff; border: 1px solid #dbe6df; border-radius: 10px; padding: 9px; text-align: center; }
        .numero b { display: block; font-size: 18px; color: #174d37; }
        .numero span { font-size: 12px; color: #718078; }
        .resultado { display: flex; min-height: 190px; align-items: center; justify-content: center; text-align: center; flex-direction: column; }
        .resultado strong { font-size: 38px; color: #174d37; }
        .resultado small { color: #6d7a73; margin-top: 8px; }
        .regresiva { display: flex; flex-wrap: wrap; gap: 7px; justify-content: center; margin-top: 22px; }
        .regresiva span { width: 38px; height: 38px; display: grid; place-items: center; border-radius: 50%; background: #dcece3; font-weight: 700; color: #174d37; }
        .despegue { margin-top: 18px; background: #174d37; color: #fff; padding: 11px 14px; border-radius: 10px; text-align: center; font-weight: 700; }
        @media (max-width: 850px) { .rejilla { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<main class="contenedor">
    <header class="titulo">
        <h1>Laboratorio de ciclos</h1>
        <p>Tres problemas, tres estructuras repetitivas diferentes.</p>
    </header>

    <section class="rejilla">
        <article class="panel">
            <h2>for · números del 1 al 20</h2>
            <div class="numeros">
                <?php foreach ($salidaFor as $dato): ?>
                    <div class="numero">
                        <b><?= $dato['numero'] ?></b>
                        <span><?= $dato['tipo'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </article>

        <article class="panel resultado">
            <h2>while · suma del 1 al 100</h2>
            <strong><?= $sumaHastaCien ?></strong>
            <small>resultado acumulado</small>
        </article>

        <article class="panel">
            <h2>do...while · cuenta regresiva</h2>
            <div class="regresiva">
                <?php foreach ($cuentaRegresiva as $valor): ?>
                    <span><?= $valor ?></span>
                <?php endforeach; ?>
            </div>
            <div class="despegue">¡Despegue!</div>
        </article>
    </section>
</main>
</body>
</html>
