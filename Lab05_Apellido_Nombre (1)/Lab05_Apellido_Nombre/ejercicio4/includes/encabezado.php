<?php $paginaActual = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= NOMBRE_EMPRESA ?></title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: "Segoe UI", sans-serif; background: #f4f1e9; color: #20352b; }
        .barra { background: #163f31; color: #fff; }
        .barra-interna { width: min(1040px, 92%); margin: auto; min-height: 82px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .marca strong { display: block; font-size: 22px; }
        .marca span { display: block; margin-top: 3px; color: #b8d2c4; font-size: 13px; }
        nav { display: flex; gap: 8px; }
        nav a { color: #d9e8df; text-decoration: none; padding: 9px 14px; border-radius: 9px; }
        nav a:hover, nav a.activo { background: #2c614b; color: #fff; }
        main { width: min(1040px, 92%); margin: 34px auto; }
        .tarjeta { background: #fff; border-radius: 16px; padding: 28px; box-shadow: 0 12px 30px rgba(49, 62, 53, .08); }
        .tarjeta h1, .tarjeta h2 { margin-top: 0; color: #1e503d; }
        .destacado { background: #e5efe9; border-left: 4px solid #2c614b; padding: 15px 17px; border-radius: 0 10px 10px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 18px; }
        th, td { padding: 12px 14px; border-bottom: 1px solid #e8e4db; text-align: left; }
        th { background: #eaf1ed; color: #2c5544; font-size: 13px; }
        footer { width: min(1040px, 92%); margin: 12px auto 30px; padding-top: 16px; border-top: 1px solid #d9d5ca; color: #69766f; font-size: 14px; display: flex; justify-content: space-between; gap: 16px; }
        @media (max-width: 650px) { .barra-interna, footer { flex-direction: column; align-items: flex-start; padding: 18px 0; } }
    </style>
</head>
<body>
<header class="barra">
    <div class="barra-interna">
        <div class="marca">
            <strong><?= NOMBRE_EMPRESA ?></strong>
            <span><?= LEMA_EMPRESA ?></span>
        </div>
        <nav>
            <a class="<?= $paginaActual === 'index.php' ? 'activo' : '' ?>" href="index.php">Inicio</a>
            <a class="<?= $paginaActual === 'productos.php' ? 'activo' : '' ?>" href="productos.php">Productos</a>
        </nav>
    </div>
</header>
