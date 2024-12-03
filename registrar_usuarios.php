<?php
include("conexion.php");

if(isset($_POST['enviar'])){
    if(strlen($_POST['nombre'])>=1 && strlen($_POST['password'])>=1 && strlen($_POST['correo'])>=1){
           $nombre=trim($_POST['nombre']);
           $password=trim($_POST['password']);
           $correo = trim($_POST['correo']);
           $insertar = "INSERT INTO usuarios(nombre, password, correo) VALUES ('$nombre', '$password', '$correo')";
           $mostrar= mysqli_query($coneccion,$insertar);

           if($mostrar){
            ?>
            <h3 class="ok">usuario registrado</h3>
            <?php

           }else{
            ?>
            <h3 class="ok"> la conexion es erronea </h3>
            <?php
           }
    }
}
?>