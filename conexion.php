<?php
$servidor = "localhost";
$nombre = "root";
$contraseña = "";
$bd = "sesion";
$puerto ="3306";
$coneccion = mysqli_connect($servidor, $nombre, $contraseña, $bd, $puerto);
if($coneccion){
    echo'';
}else{
        echo'no conectado';

}
