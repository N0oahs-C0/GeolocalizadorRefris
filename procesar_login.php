<?php
//session_start();
require("conexion.php");

if(isset($_POST['user']) && isset($_POST['pass'])){
    $usuario = $_POST['user'];
    $password = $_POST['pass'];

    $query = "SELECT * FROM users u, usuario usu WHERE usu.usuario = ".
    "'$usuario' AND u.pass = '$password' AND permisos = 'admin' and u.id=usu.fkUsers";
    $result = mysqli_query($conn, $query);
    $noAdmin=mysqli_query($conn, "SELECT * FROM users u, usuario usu WHERE usu.usuario = ".
    "'$usuario' AND u.pass = '$password' AND permisos = 'user' and u.id=usu.fkUsers");

    if (!$result) {
         die("Error en la consulta: " . mysqli_error($conn));
    }
    mysqli_close($conn);

    if((empty($nombre)||$nombre==null)&&(empty($password)||$password==null))
    {
        $_SESSION['Error'] = "Error: Credenciales no proporcionadas.";
        header('Location: index.php');
        exit;
    }
    else if (mysqli_num_rows($noAdmin) == 1) {
        $_SESSION['Error'] = "Error: El usuario propornionado no es administrador.";
        header('Location: index.php');
        exit;
    }
    else if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['permisos'] = "admin";
        header('Location: menu.php');
        exit;
    } else {
        $_SESSION['Error'] = "Error: Usuario o contraseña incorrectos.";
        header('Location: index.php');
        exit;
    }
} else {
    $_SESSION['Error'] = "Error: Credenciales no proporcionadas.";
    header('Location: index.php');
    exit;
}
?>