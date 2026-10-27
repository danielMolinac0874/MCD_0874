<?php
// 1. Configuración de la conexión
$servidor = "localhost";
$usuario_db = "root";     
$password_db = "";        
$nombre_db = "oxxo";  

$conexion = mysqli_connect($servidor, $usuario_db, $password_db, $nombre_db);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// 2. Recibir los datos del formulario de Login de OXXO
$correo = $_POST['correo'];
$password_plana = $_POST['password'];

// 3. Buscar al usuario por su correo electrónico
$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);
    
    // 4. Verificar si la contraseña ingresada coincide
    if (password_verify($password_plana, $usuario['password'])) {
        
        // ¡ÉXITO! Alerta personalizada para OXXO Club
        $nombre_usuario = $usuario['nombre'];
        echo "<script>
                alert('Bienvenido: $nombre_usuario a OXXO Club');
                window.location.href = 'index.html'; // Te regresa a la tienda OXXO
              </script>";
              
    } else {
        echo "<script>
                alert('Contraseña incorrecta.');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
                alert('El correo electrónico no está registrado en OXXO Club.');
                window.history.back();
              </script>";
}

mysqli_close($conexion);
?>
