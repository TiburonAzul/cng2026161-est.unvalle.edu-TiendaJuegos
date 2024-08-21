<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('config.php'); // Incluye el archivo de configuración
session_start(); // Inicia la sesión

echo "El archivo se está ejecutando correctamente.<br>";

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.<br>";
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Formulario enviado.<br>";

    // Recoge los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "Email recibido: " . $email . "<br>";
    echo "Contraseña recibida: " . $password . "<br>";

    // Ejecutar la consulta SQL
    $sql = "SELECT id, nombre, password, tipo FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Usuario encontrado en la base de datos.<br>";

        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Contraseña verificada correctamente.<br>";
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['tipo'] = $row['tipo'];

            if ($row['tipo'] == 'admin') {
                echo "Redirigiendo a la página de administrador...<br>";
                header("location: admin.php");
            } else {
                echo "Redirigiendo a la página de inicio...<br>";
                header("location: index.php");
            }
        } else {
            echo "Contraseña incorrecta.<br>";
        }
    } else {
        echo "No existe el usuario.<br>";
    }
} else {
    echo "Formulario no enviado.<br>";
}
?>

<!-- Formulario de inicio de sesión -->
<form method="post" action="">
    Email: <input type="email" name="email" required><br>
    Contraseña: <input type="password" name="password" required><br>
    <input type="submit" value="Iniciar Sesión">
</form>
