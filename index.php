<?php

include_once "menu.php";

?>
<table border="1" style="border-collapse: collapse;">
    <tr>
        <th style="padding:10px;">&nbsp</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Programa</th>
        <th colspan="2">&nbsp;</th>
    </tr>
    <?php

        use Clases\Estudiante;
        include_once "config/autoload.php";

        $datos = Estudiante::listar();
       //var_dump($datos);
        $cont=1;
        foreach($datos as $reg){
    ?>
    <tr>
        <td><?php echo $cont;?></td>
        <td><?php echo $reg[1]?></td>
        <td><?php echo $reg[2]?></td>
        <td><?php echo $reg[3]?></td>
        <td><a href="actualizar.php?id=<?php echo $reg[0]?>">Actualizar</a></td>
        <td><a href="eliminar.php?id=<?php echo $reg[0]?>">Eliminar</a></td>
    </tr>

    <?php 
        $cont+=1;
        }
    ?>
</table>
