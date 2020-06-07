<?php

use Clases\Estudiante;

include_once "config/autoload.php";


$id = $_GET['id'];

if (Estudiante::eliminar($id)) {
    header("location:index.php");
} else {
    echo "Error: No se pudo eliminar!!";
}
?>