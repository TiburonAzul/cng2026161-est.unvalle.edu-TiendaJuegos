<?php
include('config.php');
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("location: login.php");
    exit;
}

$orden_id = $_GET['orden_id'];

$sql = "SELECT * FROM ordenes WHERE id = $orden_id";
$orden = $conn->query($sql)->fetch_assoc();

$sql = "SELECT p.nombre, d.cantidad, d.precio FROM orden_detalle d JOIN productos p ON d.producto_id = p.id WHERE d.orden_id = $orden_id";
$detalles = $conn->query($sql);
?>

<h2>Recibo</h2>

<p><strong>Orden ID:</strong> <?php echo $orden['id']; ?></p>
<p><strong>Total:</strong> <?php echo $orden['total']; ?> USD</p>
<p><strong>Fecha:</strong> <?php echo $orden['fecha']; ?></p>

<h3>Detalles</h3>
<ul>
    <?php while ($detalle = $detalles->fetch_assoc()) { ?>
        <li>
            <?php echo $detalle['nombre']; ?> - <?php echo $detalle['cantidad']; ?> x <?php echo $detalle['precio']; ?> USD
        </li>
    <?php } ?>
</ul>

<p><strong>Cambio:</strong> 0.00 USD</p>
