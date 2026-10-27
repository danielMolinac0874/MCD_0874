<?php
// 1. Conectar a la base de datos
$servidor = "localhost";
$usuario_db = "root";
$password_db = "";
$nombre_db = "cinepolis";

$conexion = mysqli_connect($servidor, $usuario_db, $password_db, $nombre_db);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// 2. Recibir los datos del formulario HTML
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password_plana = $_POST['password'];

// 3. Encriptar la contraseña (Medida de seguridad obligatoria)
$password_encriptada = password_hash($password_plana, PASSWORD_DEFAULT);

// 4. Insertar los datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, correo, password) VALUES ('$nombre', '$correo', '$password_encriptada')";

if (mysqli_query($conexion, $sql)) {
    echo "¡Cuenta creada exitosamente en Cinepolis! Ya puedes iniciar sesión.";
} else {
    // Si el correo ya existe, saltará un error por la regla UNIQUE de SQL
    echo "Error al registrar: " . mysqli_error($conexion);
}

// 5. Cerrar la conexión
mysqli_close($conexion);
?>