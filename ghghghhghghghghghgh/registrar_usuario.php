<?php
// 1. Configuración de los datos de conexión a la base de datos SQL
$servidor = "localhost";
$usuario_db = "root";     
$password_db = "";        
$nombre_db = "oxxo";

// 2. Establecer la conexión con MySQL
$conexion = mysqli_connect($servidor, $usuario_db, $password_db, $nombre_db);

if (!$conexion) {
    die("Error crítico de conexión: " . mysqli_connect_error());
}

// 3. Recuperar los datos enviados desde el formulario HTML de OXXO
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password_plana = $_POST['password'];

// 4. Encriptar la contraseña por seguridad
$password_encriptada = password_hash($password_plana, PASSWORD_DEFAULT);

// 5. Preparar la consulta SQL para insertar al nuevo miembro de OXXO Club
$sql = "INSERT INTO usuarios (nombre, correo, password) VALUES ('$nombre', '$correo', '$password_encriptada')";

// 6. Ejecutar la consulta y verificar el éxito
if (mysqli_query($conexion, $sql)) {
    echo "<script>
            alert('¡Registro exitoso en OXXO Club! Bienvenido.');
            window.location.href = 'index.html'; // Te regresa automáticamente a la tienda OXXO
          </script>";
} else {
    echo "<script>
            alert('Error al registrar: El correo electrónico ya está vinculado a una cuenta de OXXO Club.');
            window.history.back(); // Regresa al formulario para corregirlo
          </script>";
}

// 7. Cerrar la conexión
mysqli_close($conexion);
?>
