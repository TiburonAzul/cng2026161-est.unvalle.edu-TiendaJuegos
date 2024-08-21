<!-- /templates/header.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Tienda de Juegos</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Tienda de Juegos</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <?php if (isset($_SESSION['usuario_id'])) { ?>
                <a href="ordenes.php">Mis Órdenes</a>
                <a href="logout.php">Cerrar Sesión</a>
            <?php } else { ?>
                <a href="login.php">Login</a>
                <a href="register.php">Registro</a>
            <?php } ?>
        </nav>
    </header>



    <!-- /templates/footer.php -->
    <footer>
        <p>&copy; 2024 Tienda de Juegos. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
