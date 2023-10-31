<?php
//procesar registro
$r_permisos=$_POST['r_permisos'];
$insertar=mysqli_query($conn,"insert into usuarios values(null,$nombre,$apellidoP,$apellidoM,$pass,$r_permisos)");

//procesar modificación
$usuario_s=$_POST['usuario_s'];
$insertar=mysqli_query($conn,"call v_usuarios($usuario_s)");