<?php
class DataSource
{
    private $cadenaParaConexion;
    private $conexion;

    public function __construct()
    {
        try {
            // Asegúrate de que el nombre de la base de datos sea correcto
            $this->cadenaParaConexion = "mysql:host=127.0.0.1;dbname=prueba"; 
            $this->conexion = new PDO($this->cadenaParaConexion, "root", "interianx"); // Usuario "root" y contraseña vacía
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar excepciones
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
    }

    public function ejecutarConsulta($sql = "", $values = [])
    {
        if ($this->conexion === null) {
            throw new Exception("La conexión a la base de datos no está establecida.");
        }
        if ($sql != "") {
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute($values);
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return 0;
        }
    }


    public function ejecutarActualizacion($sql = "", $values = [])
    {
        if ($sql != "") {
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute($values);
            return $consulta->rowCount();
        } else {
            return 0;
        }
    }

    public function getLastInsertId()
    {
        return $this->conexion->lastInsertId(); // Devuelve el último ID insertado
    }
}
?>