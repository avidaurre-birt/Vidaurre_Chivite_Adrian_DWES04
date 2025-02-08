<?php
require '../app/models/DAO/PlantacionDAO.php';

class PlantacionController
{

    protected $plantacionDao;

    public function __construct()
    {
        $this->plantacionDao = new PlantacionDAO();
    }

    //GET
    public function getAll()
    {
        $plantaciones = $this->plantacionDao->obtenerPlantaciones();

        if ($plantaciones) {
            echo json_encode([
                'message' => 'Plantaciones encontradas con éxito',
                'plantaciones' => $plantaciones,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            echo ("Error al obtener la lista de plantaciones.");
        }
    }
    //GET by ID
    public function getPlantacionById($id)
    {
        $plantacion = $this->plantacionDao->obtenerPlantacionId($id);

        if ($plantacion) {
            echo json_encode([
                'message' => 'Plantación encontrada con éxito',
                'plantacion' => $plantacion,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            echo ("Error No se encontro la plantacion con el ID " . $id);
        }
    }
    //POST
    public function createPlantacion($data)
    {
        if (isset($data['ubicacion'], $data['fecha'], $data['participantes'], $data['arboles'])) {

            // Crear un nuevo DTO con los datos recibidos
            $plantacionDTO = new PlantacionDTO(
                null, // El ID lo genera automáticamente la base de datos
                $data['ubicacion'],
                $data['fecha'],
                $data['participantes']
            );

            $arbolesDTO = [];
            foreach ($data['arboles'] as $arbolData) {
                $arbolesDTO[] = new ArbolDTO(
                    null,
                    $arbolData['especie'],
                    $arbolData['cantidad'],
                    null // El Id_plantacion se asigna después
                );
            }
            $nuevaPlantacion = $this->plantacionDao->crearPlantacion($plantacionDTO, $arbolesDTO);


            echo json_encode([
                'message' => 'Plantacion creada exitosamente',
                'plantacion' => $nuevaPlantacion,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            // Respuesta de error si faltan datos
            echo json_encode(['error' => 'Datos incompletos']);
        }
    }
    // PUT
    public function updatePlantacion($id, $data)
    {
        if (isset($data['ubicacion'], $data['fecha'], $data['participantes'], $data['arboles'])) {
            // Crear un nuevo DTO con los datos recibidos

            $plantacionActualizada = $this->plantacionDao->actualizarPlantacion(
                $id,
                $data['ubicacion'],
                $data['fecha'],
                $data['participantes'],
                $data['arboles']
            );

            if ($plantacionActualizada) {
                echo json_encode([
                    'message' => 'Plantación actualizada exitosamente',
                    'plantacion' => $plantacionActualizada,
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(['error' => 'Error al actualizar la plantación con ID: ' . $id]);
            }
        } else {
            // Respuesta de error si faltan datos
            echo json_encode(['error' => 'Datos incompletos']);
        }
    }

    //DELETE
    public function deletePlantacion($id)
    {
        $plantacionBorrada = $this->plantacionDao->eliminarPlantacion($id);

        if ($plantacionBorrada) {

            echo json_encode(['message' =>  "Plantacion eliminada con exito."]);
        } else {
            // Devuelve un mensaje de error con el código HTTP 404 (Not Found)
            echo json_encode(['error' => "No se encontro la plantacion con el ID " . $id]);
        }
    }
}
