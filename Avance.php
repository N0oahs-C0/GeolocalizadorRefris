<?php
//procesar registro
$r_permisos=$_POST['r_permisos'];
$insertar=mysqli_query($conn,"insert into usuarios values(null,$nombre,$apellidoP,$apellidoM,$pass,$r_permisos)");

//procesar modificación
$usuario_s=$_POST['usuario_s'];
$insertar=mysqli_query($conn,"call v_usuarios($usuario_s)");

//menu
if($_SESSION['permisos']=="admin")
{
    echo '<li><a href="AgregarAdmin.html" style="color:#6a6f8c">Agregar Administrador</a></li>';
    echo '<li><a href="#" style="color:#6a6f8c">Agregar Refrigerador</a></li>';
}

//sql
use geolocalizador;
drop procedure if exists v_usuarios;
delimiter //
create procedure v_usuarios(in _id int)
begin
select u.nombre, u.apellidoP, u.apellidoM, u.pass, usu.usuario from users u, 
usuario usu where u.id=usu.fkUsers and u.id=_id;
end;
//
delimiter ;