<?php
class Pedido {
    const IMPUESTO = 0.07;

    private $cliente;
    private $producto;
    private $precioUnitario;
    private $cantidad;

    public function __construct($cliente, $producto, $precioUnitario, $cantidad) {
        if ($cantidad <= 0) {
            throw new Exception('No se puede procesar un pedido con cantidad igual o menor que cero.');
        }

        if ($precioUnitario <= 0) {
            throw new Exception('El precio unitario debe ser mayor que cero.');
        }

        $this->cliente = $cliente;
        $this->producto = $producto;
        $this->precioUnitario = $precioUnitario;
        $this->cantidad = $cantidad;
    }

    public function calcularSubtotal() {
        return $this->precioUnitario * $this->cantidad;
    }

    public function calcularImpuesto() {
        return $this->calcularSubtotal() * self::IMPUESTO;
    }

    public function calcularTotal() {
        return $this->calcularSubtotal() + $this->calcularImpuesto();
    }

    public function mostrarResumen() {
        return [
            'cliente' => $this->cliente,
            'producto' => $this->producto,
            'precio' => $this->precioUnitario,
            'cantidad' => $this->cantidad,
            'subtotal' => $this->calcularSubtotal(),
            'impuesto' => $this->calcularImpuesto(),
            'total' => $this->calcularTotal()
        ];
    }
}

$casos = [
    [
        'titulo' => 'Pedido válido',
        'cliente' => 'Ana Pérez',
        'producto' => 'Monitor',
        'precio' => 185.00,
        'cantidad' => 2
    ],
    [
        'titulo' => 'Pedido con excepción',
        'cliente' => 'Carlos Díaz',
        'producto' => 'Teclado',
        'precio' => 25.00,
        'cantidad' => 0
    ]
];

$resultados = [];

foreach ($casos as $caso) {
    try {
        $pedido = new Pedido(
            $caso['cliente'],
            $caso['producto'],
            $caso['precio'],
            $caso['cantidad']
        );

        $resultados[] = [
            'titulo' => $caso['titulo'],
            'estado' => 'correcto',
            'datos' => $pedido->mostrarResumen()
        ];
    } catch (Exception $excepcion) {
        $resultados[] = [
            'titulo' => $caso['titulo'],
            'estado' => 'error',
            'cliente' => $caso['cliente'],
            'producto' => $caso['producto'],
            'mensaje' => $excepcion->getMessage()
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesamiento de pedidos</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: "Segoe UI", sans-serif; background: #17251f; color: #20342a; }
        .pagina { width: min(960px, 92%); margin: 42px auto; }
        .cabecera { color: #fff; margin-bottom: 24px; }
        .cabecera h1 { margin: 0; }
        .cabecera p { color: #abc2b5; }
        .casos { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; }
        .caso { background: #f8faf8; border-radius: 16px; overflow: hidden; }
        .caso header { padding: 17px 20px; border-bottom: 1px solid #e2e8e4; display: flex; justify-content: space-between; align-items: center; }
        .caso header h2 { margin: 0; font-size: 18px; }
        .etiqueta { font-size: 12px; font-weight: 700; padding: 5px 9px; border-radius: 999px; }
        .correcto .etiqueta { background: #dcefe4; color: #17603b; }
        .error .etiqueta { background: #f5dfdd; color: #9b332c; }
        .cuerpo { padding: 20px; }
        .fila { display: flex; justify-content: space-between; gap: 16px; padding: 9px 0; border-bottom: 1px solid #e8ece9; }
        .fila:last-child { border-bottom: 0; }
        .total { margin-top: 15px; background: #20543f; color: #fff; padding: 14px; border-radius: 10px; display: flex; justify-content: space-between; }
        .mensaje-error { background: #fff0ee; color: #8b302a; border: 1px solid #f0cbc7; padding: 15px; border-radius: 10px; line-height: 1.5; }
        @media (max-width: 700px) { .casos { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<main class="pagina">
    <header class="cabecera">
        <h1>Sistema de pedidos</h1>
        <p>Validación de datos, cálculo de ITBMS y control de excepciones.</p>
    </header>

    <section class="casos">
        <?php foreach ($resultados as $resultado): ?>
            <article class="caso <?= $resultado['estado'] ?>">
                <header>
                    <h2><?= htmlspecialchars($resultado['titulo']) ?></h2>
                    <span class="etiqueta"><?= $resultado['estado'] === 'correcto' ? 'Procesado' : 'Excepción' ?></span>
                </header>
                <div class="cuerpo">
                    <?php if ($resultado['estado'] === 'correcto'): ?>
                        <?php $datos = $resultado['datos']; ?>
                        <div class="fila"><span>Cliente</span><strong><?= htmlspecialchars($datos['cliente']) ?></strong></div>
                        <div class="fila"><span>Producto</span><strong><?= htmlspecialchars($datos['producto']) ?></strong></div>
                        <div class="fila"><span>Precio unitario</span><strong>$<?= number_format($datos['precio'], 2) ?></strong></div>
                        <div class="fila"><span>Cantidad</span><strong><?= $datos['cantidad'] ?></strong></div>
                        <div class="fila"><span>Subtotal</span><strong>$<?= number_format($datos['subtotal'], 2) ?></strong></div>
                        <div class="fila"><span>Impuesto (<?= Pedido::IMPUESTO * 100 ?>%)</span><strong>$<?= number_format($datos['impuesto'], 2) ?></strong></div>
                        <div class="total"><span>Total</span><strong>$<?= number_format($datos['total'], 2) ?></strong></div>
                    <?php else: ?>
                        <div class="fila"><span>Cliente</span><strong><?= htmlspecialchars($resultado['cliente']) ?></strong></div>
                        <div class="fila"><span>Producto</span><strong><?= htmlspecialchars($resultado['producto']) ?></strong></div>
                        <p class="mensaje-error"><strong>Pedido rechazado:</strong><br><?= htmlspecialchars($resultado['mensaje']) ?></p>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
</main>
</body>
</html>
