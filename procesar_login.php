<?php
//session_start();
require("conexion.php");

if(isset($_POST['user']) && isset($_POST['pass'])){
    $usuario = $_POST['user'];
    $password = $_POST['pass'];
    $permisos = $_POST['permisos'];

    $query = "SELECT * FROM users u, usuario usu WHERE usu.usuario = ".
    "'$usuario' AND u.pass = '$password' AND permisos = '$permisos' and u.id=usu.fkUsers";
    $result = mysqli_query($conn, $query);

    /*
    $queryNoAdmin = "SELECT * FROM users u, usuario usu WHERE usu.usuario = ".
    "'$usuario' AND u.pass = '$password' AND permisos = 'user' and u.id=usu.fkUsers";
    $noAdmin=mysqli_query($conn, $queryNoAdmin);*/

    if (!$result) {
         die("Error en la consulta: " . mysqli_error($conn));
    }
    mysqli_close($conn);

    if((empty($nombre)||$nombre==null)&&(empty($password)||$password==null))
    {
        $_SESSION['Error'] = "Error: Credenciales no proporcionadas.";
        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            // Si no hay una página anterior en el historial, redirige a una página predeterminada
            header("Location: index.php");
        }        
        exit;
    }
    /*
    else if (mysqli_num_rows($noAdmin) == 1) {
        $_SESSION['Error'] = "Error: El usuario propornionado no es administrador.";
        header('Location: index.php');
        exit;
    }*/
    else if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['permisos'] = $_POST['permisos'];
        if($permisos == 'admin') {
            header('Location: menu.html'); 
        } else if($permisos == 'user') {
            header('Location: menu.html'); //cambiar a la pagina del usuario
        }
        exit;
    } else {
        $_SESSION['Error'] = "Error: Usuario o contraseña incorrectos.";
        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            // Si no hay una página anterior en el historial, redirige a una página predeterminada
            header("Location: index.php");
        }
        exit;
    }
} else {
    $_SESSION['Error'] = "Error: Credenciales no proporcionadas.";
    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        // Si no hay una página anterior en el historial, redirige a una página predeterminada
        header("Location: index.php");
    }
    exit;
}
?>