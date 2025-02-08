<?php
require_once '../core/DatabaseSingleton.php';
require '../app/models/DTO/LimpiezaDTO.php';

class LimpiezaDAO
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseSingleton::getInstance();
    }


    public function obtenerLimpiezas()
    {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM limpiezas";
        $statement = $connection->query($query);
        $result = $statement->fetchall(PDO::FETCH_ASSOC);

        $limpiezasDTO = array();

        for ($i = 0; $i < count($result); $i++) {
            $fila = $result[$i];
            $limpiezaDTO = new LimpiezaDTO(
                $fila['id'],
                $fila['ubicacion'],
                $fila['fecha'],
                $fila['cantidadRecogida_Kg'],
                $fila['participantes'],
                $fila['descripcion']
            );
            $limpiezasDTO[] = $limpiezaDTO;
        }
        return $limpiezasDTO;
    }

    public function obtenerLimpiezaId($id)
    {
        $connection = $this->db->getConnection();

        $query = "SELECT * FROM limpiezas WHERE id = $id";
        $statement = $connection->query($query);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {


            $limpiezaDTO = new LimpiezaDTO(
                $result['id'],
                $result['ubicacion'],
                $result['fecha'],
                $result['cantidadRecogida_Kg'],
                $result['participantes'],
                $result['descripcion']
            );

            return $limpiezaDTO;
        } else {
            return false;
        }
    }

    public function crearLimpieza($limpiezaDTO)
    {
        try {
            $connection = $this->db->getConnection();

            $query = "INSERT INTO limpiezas (ubicacion, fecha, cantidadRecogida_Kg, participantes, descripcion)
            VALUES (:ubicacion, :fecha, :cantidadRecogida_Kg, :participantes, :descripcion);";

            $statement = $connection->prepare($query);
            //$result = $statement->fetchall(PDO::FETCH_ASSOC);

            $statement->bindValue(':ubicacion', $limpiezaDTO->getUbicacion());
            $statement->bindValue(':fecha', $limpiezaDTO->getFechalimpieza());
            $statement->bindValue(':cantidadRecogida_Kg', $limpiezaDTO->getCantidadRecogida());
            $statement->bindValue(':participantes', $limpiezaDTO->getParticipantes());
            $statement->bindValue(':descripcion', $limpiezaDTO->getDescripcion());

            $statement->execute();

            return true;
        } catch (PDOException $e) {

            // Revertir la transacción en caso de error
            error_log("Error al crear la limpieza: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarLimpieza($id, $data)
    {
        try {
            $connection = $this->db->getConnection();

            $query = "SELECT * FROM limpiezas WHERE id = $id";
            $statement = $connection->query($query);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $limpiezaDTO = new LimpiezaDTO(
                $result['id'],
                $result['ubicacion'],
                $result['fecha'],
                $result['cantidadRecogida_Kg'],
                $result['participantes'],
                $result['descripcion']
            );

            // Actualizar los valores con los datos proporcionados
            $data['ubicacion'] = $data['ubicacion'] ?? $limpiezaDTO->getUbicacion();
            $data['fecha'] = $data['fecha'] ?? $limpiezaDTO->getFechaLimpieza();
            $data['cantidadRecogida'] = $data['cantidadRecogida'] ?? $limpiezaDTO->getCantidadRecogida();
            $data['participantes'] = $data['participantes'] ?? $limpiezaDTO->getParticipantes();
            $data['descripcion'] = $data['descripcion'] ?? $limpiezaDTO->getDescripcion();

            $query = "UPDATE limpiezas
                        SET ubicacion = :ubicacion, fecha = :fecha, cantidadRecogida_Kg = :cantidadRecogida_Kg, participantes = :participantes, descripcion = :descripcion
                        WHERE id = :id";

            $statement = $connection->prepare($query);

            $statement->bindValue(':ubicacion', $data['ubicacion']);
            $statement->bindValue(':fecha', $data['fecha']);
            $statement->bindValue(':cantidadRecogida_Kg', $data['cantidadRecogida']);
            $statement->bindValue(':participantes', $data['participantes']);
            $statement->bindValue(':descripcion', $data['descripcion']);
            $statement->bindValue(':id', $id);

            $statement->execute();

            return true;
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            error_log("Error en actualizarlimpiezaConArboles: " . $e->getMessage());
            return false;
        }
    }
    public function eliminarLimpieza($id)
    {

        $connection = $this->db->getConnection();
        $query = "DELETE FROM limpiezas WHERE id = $id";
        $statement = $connection->query($query);

        if ($statement->rowCount() > 0) {
            return true;
        } else {
            error_log("Error al borrar la limpieza " . $id);
            return false;
        }
    }
}
