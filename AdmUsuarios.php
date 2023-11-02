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
function extraerId($nombre)
{
    global $conn;
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $id = mysqli_fetch_assoc(mysqli_query($conn,"select id from users where nombre = '$nombre' order by id desc"));
    return $id['id'];
}
function consultarUsuario($id)
{
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn,"call v_usuarios($id)"));
}

$funcion=extraerPost('_enviar');
//Funciones
if($funcion=="Registrar")
{
    //extraer post
    $r_permisos=extraerPost('r_permisos');
    $nombre=extraerPost('_nombre');
    $apellidoP=extraerPost('_apellidoP');
    $apellidoM=extraerPost('_apellidoM');
    $pass=extraerPost('_pass');
    $insertar=mysqli_query($conn,"insert into users values(null".
    ",'$nombre','$apellidoP','$apellidoM','$pass','$r_permisos')");
    $c_usuario=consultarUsuario(extraerId($nombre));
    $usuario = $c_usuario['usuario'];
    $_SESSION['usuario_registrado'] = true;
    //echo "insert into users values(null,$nombre,$apellidoP,$apellidoM,$pass,$r_permisos)";
    mysqli_close($conn);
    header('Location: AgregarAdmin.php?usuario=' . urlencode($usuario));
    exit;
}
else if($funcion=="Modificar")
{
    //extraer post
    $m_r_permisos=extraerPost('r_permisos');
    $m_nombre=extraerPost('_nombre');
    $m_apellidoP=extraerPost('_apellidoP');
    $m_apellidoM=extraerPost('_apellidoM');
    $m_pass=extraerPost('_pass');
    $id_usuario=extraerPost('Usuariouwu');
    $lista_usuario=consultarUsuario($id_usuario);
    $usuario=$lista_usuario['usuario'];
    $_SESSION['usuario_registrado'] = true;
    //$modificar=mysqli_query($conn,"update users set nombre=$m_nombre, apellidoP=$m_apellidoP, apellidoM=$m_apellidoM".
    //", pass=$m_pass, permisos=$m_r_permisos where id=$id_usuario");
    echo "update users set nombre=$m_nombre, apellidoP=$m_apellidoP, apellidoM=$m_apellidoM".
    ", pass=$m_pass, permisos=$m_r_permisos where id=$id_usuario";
    mysqli_close($conn);
    //header('Location: AgregarAdmin.php?usuario=' . urlencode($usuario));
    //exit;
}
else if($funcion=="Eliminar")
{
    $id_usuario=extraerPost('Usuariouwu');
    $lista_usuario=consultarUsuario($id_usuario);
    $usuario=$lista_usuario['usuario'];
    //$eliminar=mysqli_query($conn,"delete from users where id=$id_usuario");
    echo "delete from users where id=$id_usuario";
    /*mysqli_close($conn);
    header('Location: AgregarAdmin.php?usuario=' . urlencode($usuario));
    exit;*/
}
    /*create table usuario(
    id int primary key auto_increment,
    fkUsers int,
    usuario varchar(7),
    foreign key(fkUsers) references users(id));*/