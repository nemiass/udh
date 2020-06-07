<?php
namespace Clases;

use Clases\ConexionDB as db;

require_once "config/autoload.php";


class Estudiante extends Usuario
{
    private $codigo;

    public function __construct($codigo, $nombres, $apellidos, $telefono, $correo, $id_pa)
    {
        parent::__construct($nombres, $apellidos, $telefono, $correo, $id_pa);
        $this->codigo = $codigo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    public function crearEstudiante() : bool 
    {
        try {
            $db = new db();
            $conn = $db->abrirConexion();

            $sql = "INSERT INTO estudiantes(codigo, nombres, apellidos, telefono, correo, id_pa) 
                    VALUES('$this->codigo','$this->nombres', '$this->apellidos', '$this->telefono', '$this->correo', $this->id_pa)";
            $respuesta = $conn->prepare($sql);
            $respuesta->execute();
            $numRows = $respuesta->rowCount();
            if($numRows!=0) {
                $result = true;
            }else {
                $result = false;
            }

            $db->cerrarConexion();

            return $result;
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function listar()
    {
        try {
            $db = new db();
            $conn = $db->abrirConexion();
            $sql = "SELECT e.id,nombres, apellidos, nombre FROM estudiantes as e join pa as pa on e.id_pa = pa.id";
            $respuesta = $conn->prepare($sql);
            $respuesta->execute();
            $datos = $respuesta->fetchAll();
            $db->cerrarConexion();
            return $datos;
        }
        catch (\PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function eliminar($id)
    {
        try {
            $db = new db();
            $conn = $db->abrirConexion();

            $sql = "DELETE FROM estudiantes where id=?";
            $respuesta = $conn->prepare($sql);
            $respuesta->execute([$id]);
            $numRows = $respuesta->rowCount();
            if($numRows!=0){
                $result = true;
            }else{
                $result = false;
            }

            $db->cerrarConexion();

            return $result;
        }
        catch (\PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function obtenerEstudiante($id)
    {
        try {
            $db = new db();
            $conn = $db->abrirConexion();
            $sql = "SELECT * FROM estudiantes WHERE id=?";
            $respuesta = $conn->prepare($sql);
            $respuesta->execute([$id]);
            $datos = $respuesta->fetch();
            $db->cerrarConexion();
            return $datos;
        }
        catch (\PDOException $e){
            echo $e->getMessage();
        }
    }

    public function actualizar($id)
    {
        try {
            $db = new db();
            $conn = $db->abrirConexion();

            $sql = "UPDATE estudiantes set codigo=?, nombres=?, apellidos=?, telefono=?, correo=?, id_pa=? WHERE id = ?";
            $respuesta = $conn->prepare($sql);
            $respuesta->execute([
                $this->codigo,
                $this->nombres,
                $this->apellidos,
                $this->telefono,
                $this->correo,
                $this->id_pa,
                $id
            ]);
            $numRows = $respuesta->rowCount();
            if($numRows!=0){
                $result = true;
            }else{
                $result = false;
            }

            $db->cerrarConexion();

            return $result;
        }
        catch (\PDOException $e){
            echo $e->getMessage();
        }
    }
}