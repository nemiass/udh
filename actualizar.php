<?php
use Clases\Estudiante;
use Clases\Programa;

include_once "config/autoload.php";
include_once "menu.php";

$id = $_GET['id'];

$dato = Estudiante::obtenerEstudiante($id);
//var_dump($dato);
?>
    <h1>Actualizar</h1>
    <form method="post" action="#">
        <input type="hidden" name="id" value="<?php echo $id?>">
        Codigo:
        <input type="text" name="codigo" placeholder="Codigo" value="<?php echo $dato[1] ?>" required/><br>
        Nombre:
        <input type="text" name="nombres" placeholder="Nombres" value="<?php echo $dato[2] ?>" required/><br>
        Apellido:
        <input type="text" name="apellidos" placeholder="Apellidos" value="<?php echo $dato[3] ?>" required/><br>
        Telefono:
        <input type="text" name="telefono" placeholder="Telefono" value="<?php echo $dato[4] ?>" /><br>
        Correo:
        <input type="email" name="correo" placeholder="Email" value="<?php echo $dato[5] ?>" /><br>
        Programa Académico:
        <select name="id_pa">

            <?php
            $programa = new Programa();
            $programas = $programa->verProgramas();     
                   
            foreach ($programas as $programa) {
                if($programa["id"] == $dato["id_pa"] ){
                    echo "<option selected value='".$programa["id"]."'>".$programa["nombre"]."</option>";
                }
                else {
                    echo "<option value='".$programa["id"]."'>".$programa["nombre"]."</option>";
                }
            }
            ?>

        </select><br/>
        <input type="submit" name="submit" value="Guardar Cambios">

    </form>

<?php

if (isset($_POST["submit"])) {

    $codigo = $_POST["codigo"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $id_pa = $_POST["id_pa"];
    $id = $_POST["id"];

    $estudiante = new Estudiante($codigo, $nombres, $apellidos, $telefono, $correo, $id_pa);
    
    if ($estudiante->actualizar($id)) {
        header("location:index.php");
    } else {
        echo "Error: Los datos no se actualizaron!!";
    }
}
?>