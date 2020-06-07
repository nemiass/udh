<?php
use Clases\Facultad;
use Clases\Programa;

include_once "config/autoload.php";
include_once "menu.php";
?>

    <h1>Registrar Programa Academico</h1>
    <form method="post" action="#">

        <input type="text" name="nombre" placeholder="Nombre de programa" required/><br>
        Facultad:
        <select name="id_facu">

            <?php
            $facu = new Facultad();
            $facus = $facu->verFacultad();

            foreach ($facus as $facu) {
                echo "<option value='".$facu["id"]."'>".$facu["nombre"]."</option>";
            }
            ?>

        </select><br/><br/>
        <input type="submit" name="submit" value="Guardar">
    </form>

<?php

if (isset($_POST["submit"])) {
    $nombre = $_POST["nombre"];
    $id_facu= $_POST["id_facu"];

    $programa = new Programa();
    if ($programa->crearPrograma($nombre, $id_facu)) {
        echo "Datos guardados";
    } else {
        echo "Error: Los datos no se guardaron";
    }
}
?>