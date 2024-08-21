<?php
include('config.php');
session_start();

if ($_SESSION['tipo'] != 'admin') {
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['crear'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $imagen = ""; // Manejo de imágenes aquí si es necesario

        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$imagen')";
        $conn->query($sql);
    }

    if (isset($_POST['eliminar'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM productos WHERE id = $id";
        $conn->query($sql);
    }

    if (isset($_POST['actualizar'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];

        $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock' WHERE id=$id";
        $conn->query($sql);
    }
}

$productos = $conn->query("SELECT * FROM productos");
?>

<h2>Gestión de Productos</h2>

<form method="post">
    Nombre: <input type="text" name="nombre"><br>
    Descripción: <input type="text" name="descripcion"><br>
    Precio: <input type="text" name="precio"><br>
    Stock: <input type="text" name="stock"><br>
    <input type="submit" name="crear" value="Crear Producto">
</form>

<h3>Productos existentes</h3>
<ul>
    <?php while ($producto = $productos->fetch_assoc()) { ?>
        <li>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                Nombre: <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>"><br>
                Descripción: <input type="text" name="descripcion" value="<?php echo $producto['descripcion']; ?>"><br>
                Precio: <input type="text" name="precio" value="<?php echo $producto['precio']; ?>"><br>
                Stock: <input type="text" name="stock" value="<?php echo $producto['stock']; ?>"><br>
                <input type="submit" name="actualizar" value="Actualizar">
                <input type="submit" name="eliminar" value="Eliminar">
            </form>
        </li>
    <?php } ?>
</ul>
