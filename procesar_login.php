<?php
// Conectar a la base de datos y validar las credenciales aquí
//require("conexion.php");
session_start();
require("conexion.php");
$usuario = $_POST['user'];
$password = $_POST['pass'];
$consultaPermisos = mysqli_query($conn,"select u.permisos from users u, usuario, usu where usu.usuario="$usuario);
$permisos=mysqli_fetch_assoc($consultaPermisos)
// // Validar usuario y contraseña en la base de datos
$query = "SELECT * FROM USERS WHERE nombre = '$usuario' AND pass = '$password' AND permisos = 'admin'";
$result = mysqli_query($conn, $query);

if (!$result) {
     die("Error en la consulta: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 1 && $permisos['permisos']=='admin') {
//     // Las credenciales son correctas
   $_SESSION['user'] = $_POST['user'];
   $_SESSION['permisos'] = "admin";
   header('Location: menu.php');
   exit;
} else {
    echo "Error: Usuario o contraseña incorrectos.";
}