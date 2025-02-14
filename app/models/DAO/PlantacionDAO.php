<?php
require_once '../core/DatabaseSingleton.php';
require '../app/models/DTO/PlantacionDTO.php';
require '../app/models/DTO/ArbolDTO.php';

class PlantacionDAO
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseSingleton::getInstance();
    }


    public function obtenerPlantaciones()
    {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM plantaciones";
        $statement = $connection->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $plantacionesDTO = [];

        foreach ($result as $fila) {
            // Crear un DTO para cada plantación
            $plantacionDTO = new PlantacionDTO(
                $fila['id'],
                $fila['ubicacion'],
                $fila['fecha'],
                $fila['participantes']
            );

            // Obtener los árboles de esta plantación
            $plantacionDTO->arboles = $this->obtenerArbolesPorPlantacion($fila['id']);

            // Agregar la plantación al array final
            $plantacionesDTO[] = $plantacionDTO;
        }

        return $plantacionesDTO;
    }

    private function obtenerArbolesPorPlantacion($plantacionId)
    {
        $connection = $this->db->getConnection();

        // Consulta para obtener los árboles de una plantación específica
        $query = "SELECT * FROM arboles WHERE plantacion_id = :plantacion_id";
        $statement = $connection->prepare($query);
        $statement->bindValue(':plantacion_id', $plantacionId, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $arboles = [];

        foreach ($result as $fila) {
            // Crear un DTO para cada árbol
            $arbolDTO = new ArbolDTO(
                $fila['id'],
                $fila['especie'],
                $fila['cantidad'],
                $fila['plantacion_id']
            );

            $arboles[] = $arbolDTO;
        }

        return $arboles;
    }

    public function obtenerPlantacionId($id)
    {
        $connection = $this->db->getConnection();

        $query = "SELECT * FROM plantaciones WHERE id = $id";
        $statement = $connection->query($query);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $plantacionDTO = new PlantacionDTO(
                $result['id'],
                $result['ubicacion'],
                $result['fecha'],
                $result['participantes']
            );
            // Obtener los árboles de esta plantación
            $plantacionDTO->arboles = $this->obtenerArbolesPorPlantacion($result['id']);

            return $plantacionDTO;
        } else {
            return false;
        }
    }

    public function crearPlantacion($plantacionDTO, $arbolesDTO)
    {
        try {
            $connection = $this->db->getConnection();

            // Iniciar la transacción
            $connection->beginTransaction();

            $query = "INSERT INTO plantaciones (ubicacion, fecha, participantes)
            VALUES (:ubicacion, :fecha, :participantes);";

            $statement = $connection->prepare($query);
            //$result = $statement->fetchall(PDO::FETCH_ASSOC);

            $statement->bindValue(':ubicacion', $plantacionDTO->getUbicacion());
            $statement->bindValue(':fecha', $plantacionDTO->getFechaPlantacion());
            $statement->bindValue(':participantes', $plantacionDTO->getParticipantes());

            $statement->execute();

            // Obtener el ID de la nueva plantación
            $plantacionId = $connection->lastInsertId();

            if (!$plantacionId) {
                throw new Exception("No se pudo obtener el ID de la plantación");
            }

            // Insertar los árboles
            $queryArbol = "INSERT INTO arboles (especie, cantidad, plantacion_id)
               VALUES (:especie, :cantidad, :plantacion_id)";
            $statementArbol = $connection->prepare($queryArbol);

            foreach ($arbolesDTO as $arbolDTO) {
                $statementArbol->bindValue(':especie', $arbolDTO->getEspecie());
                $statementArbol->bindValue(':cantidad', $arbolDTO->getCantidad());
                $statementArbol->bindValue(':plantacion_id', $plantacionId);
                $statementArbol->execute();
            }

            // Confirmar la transacción
            $connection->commit();

            return $plantacionId;
        } catch (PDOException $e) {

            // Revertir la transacción en caso de error
            $connection->rollBack();
            error_log("Error al crear plantación y árboles: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarPlantacion($id, $ubicacion, $fecha, $participantes, $arboles)
    {
        try {
            $connection = $this->db->getConnection();

            // Iniciar la transacción
            $connection->beginTransaction();

            $query = "UPDATE plantaciones
                        SET ubicacion = :ubicacion, fecha = :fecha, participantes = :participantes
                        WHERE id = :id";

            $statementPlantacion = $connection->prepare($query);

            $statementPlantacion->bindValue(':ubicacion', $ubicacion);
            $statementPlantacion->bindValue(':fecha', $fecha);
            $statementPlantacion->bindValue(':participantes', $participantes);
            $statementPlantacion->bindValue(':id', $id);

            //$result = $statement->fetchall(PDO::FETCH_ASSOC);

            $statementPlantacion->execute();



            // 2. Eliminar los árboles existentes asociados a la plantación
            $queryEliminarArboles = "DELETE FROM arboles WHERE plantacion_id = :plantacion_id";
            $statementEliminarArboles = $connection->prepare($queryEliminarArboles);
            $statementEliminarArboles->bindValue(':plantacion_id', $id, PDO::PARAM_INT);

            if (!$statementEliminarArboles->execute()) {
                throw new PDOException("Error al eliminar los árboles existentes.");
            }

            // 3. Insertar los nuevos árboles
            $queryInsertarArbol = "INSERT INTO arboles (especie, cantidad, plantacion_id)
                                  VALUES (:especie, :cantidad, :plantacion_id)";
            $statementInsertarArbol = $connection->prepare($queryInsertarArbol);

            foreach ($arboles as $arbol) {
                $statementInsertarArbol->bindValue(':especie', $arbol['especie']);
                $statementInsertarArbol->bindValue(':cantidad', $arbol['cantidad']);
                $statementInsertarArbol->bindValue(':plantacion_id', $id);
                if (!$statementInsertarArbol->execute()) {
                    throw new PDOException("Error al insertar un árbol.");
                }
            }

            // Confirmar la transacción
            $connection->commit();
            return true;
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            $connection->rollBack();
            error_log("Error en actualizarPlantacionConArboles: " . $e->getMessage());
            return false;
        }
    }
    public function eliminarPlantacion($id)
    {

        $connection = $this->db->getConnection();
        $query = "DELETE FROM plantaciones WHERE id = $id";
        $statement = $connection->query($query);


        if ($statement->rowCount() > 0) {
            return true;
        } else {
            error_log("Error al borrar la plantacion " . $id);
            return false;
        }
    }
}
