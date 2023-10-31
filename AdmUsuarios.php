<?php
require('conexion.php');
//Funciones owo
function extraerPost($nombre)
{
    if(isset($_POST[$nombre]))
    {
        return $_POST[$nombre];
    } else
    return null;
}
//extraer post
$r_permisos=extraerPost('r_permisos');
$nombre=extraerPost('_nombre');
$apellidoP=extraerPost('_apellidoP');
$apellidoM=extraerPost('_apellidoM');
$pass=extraerPost('_pass');
$funcion=extraerPost('_enviar');
$usuarios_s=extraerPost('Usuariouwu');

//Funciones
if($funcion=="Registrar")
{
    echo "$r_permisos, $nombre, $apellidoP, $apellidoM, $pass, $funcion, $usuarios_s";
    $usuario="user123";
    $_SESSION['usuario_registrado'] = true;
    header('Location: AgregarAdmin.php?usuario=' . urlencode($usuario));
    exit;
    /*$insertar=mysqli_query($conn,"insert into usuarios values(null".
    ",$nombre,$apellidoP,$apellidoM,$pass,$r_permisos)");
    mysqli_close($conn);
    header('Location: AgregarAdmin.php');
    exit;*/
}
/*else if($funcion=="Modificar")
//procesar modificación
$usuario_s=$_POST['usuario_s'];
$insertar=mysqli_query($conn,"call v_usuarios($usuario_s)");*/