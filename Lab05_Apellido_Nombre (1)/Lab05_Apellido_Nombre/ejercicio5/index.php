<?php
class Producto {
    private $codigo;
    private $nombre;
    private $precio;
    private $cantidadDisponible;

    public function __construct($codigo, $nombre, $precio, $cantidadDisponible) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidadDisponible = $cantidadDisponible;
    }

    public function mostrarInformacion() {
        return [
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'cantidad' => $this->cantidadDisponible
        ];
    }

    public function calcularValorInventario() {
        return $this->precio * $this->cantidadDisponible;
    }

    public function tieneExistencia() {
        return $this->cantidadDisponible > 0;
    }
}

$listaProductos = [
    new Producto('AC-101', 'Disco externo 2 TB', 89.50, 5),
    new Producto('AC-205', 'Cargador USB-C 65 W', 42.90, 11),
    new Producto('AC-318', 'Webcam Full HD', 58.75, 0),
    new Producto('AC-422', 'Parlante Bluetooth', 36.40, 7)
];

$totalGeneral = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objetos Producto</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: "Segoe UI", sans-serif; background: #eaf0ec; color: #23362d; }
        .contenedor { width: min(1050px, 92%); margin: 40px auto; }
        .titulo { display: flex; justify-content: space-between; align-items: end; gap: 20px; margin-bottom: 22px; }
        .titulo h1 { margin: 0; color: #173f31; }
        .titulo p { margin: 5px 0 0; color: #6a796f; }
        .productos { display: grid; grid-template-columns: repeat(auto-fit, minmax(225px, 1fr)); gap: 16px; }
        .producto { background: #fff; border-radius: 15px; padding: 20px; border-top: 5px solid #2d684f; box-shadow: 0 9px 24px rgba(31, 57, 44, .08); }
        .codigo { color: #728078; font-size: 12px; letter-spacing: .08em; }
        .producto h2 { margin: 8px 0 18px; font-size: 19px; }
        .fila { display: flex; justify-content: space-between; gap: 10px; padding: 8px 0; border-bottom: 1px solid #edf0ee; }
        .fila:last-of-type { border-bottom: 0; }
        .disponible, .agotado { display: inline-block; margin-top: 15px; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .disponible { background: #dff1e6; color: #1c6a43; }
        .agotado { background: #f4dfdd; color: #9a3931; }
        .total { margin-top: 22px; background: #173f31; color: #fff; border-radius: 15px; padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; }
        .total strong { font-size: 26px; }
    </style>
</head>
<body>
<main class="contenedor">
    <header class="titulo">
        <div>
            <h1>Gestión de productos</h1>
            <p>Inventario modelado mediante objetos de la clase Producto.</p>
        </div>
    </header>

    <section class="productos">
        <?php foreach ($listaProductos as $producto): ?>
            <?php
            $datos = $producto->mostrarInformacion();
            $valorProducto = $producto->calcularValorInventario();
            $totalGeneral += $valorProducto;
            ?>
            <article class="producto">
                <span class="codigo"><?= htmlspecialchars($datos['codigo']) ?></span>
                <h2><?= htmlspecialchars($datos['nombre']) ?></h2>
                <div class="fila"><span>Precio</span><strong>$<?= number_format($datos['precio'], 2) ?></strong></div>
                <div class="fila"><span>Cantidad</span><strong><?= $datos['cantidad'] ?></strong></div>
                <div class="fila"><span>Valor inventario</span><strong>$<?= number_format($valorProducto, 2) ?></strong></div>

                <?php if ($producto->tieneExistencia()): ?>
                    <span class="disponible">Con existencia</span>
                <?php else: ?>
                    <span class="agotado">Sin existencia</span>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    </section>

    <section class="total">
        <span>Valor total del inventario</span>
        <strong>$<?= number_format($totalGeneral, 2) ?></strong>
    </section>
</main>
</body>
</html>
