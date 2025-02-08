<?php

require '../app/models/DAO/LimpiezaDAO.php';

class LimpiezaController
{

    protected $limpiezaDAO;

    public function __construct()
    {
        $this->limpiezaDAO = new LimpiezaDAO;
    }

    //GET
    public function getAll()
    {

        $limpiezas = $this->limpiezaDAO->obtenerLimpiezas();

        if ($limpiezas) {
            echo json_encode([
                'message' => 'Limpiezas encontradas con exito',
                'limpiezas' => $limpiezas,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {

            echo json_encode(['error' => 'No se ha encontrado la lista de limpiezas']);
        }
    }
    //GET by ID
    public function getLimpiezaById($id)
    {
        $limpieza = $this->limpiezaDAO->obtenerLimpiezaId($id);

        if ($limpieza) {
            echo json_encode([
                'message' => 'Limpieza encontrada con exito',
                'limpieza' => $limpieza,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {

            echo json_encode(['error' => 'No se ha encontrado la limpieza con ID: ' . $id]);
        }
    }
    //POST
    public function createLimpieza($data)
    {

        if (isset($data['ubicacion']) && isset($data['fecha']) && isset($data['cantidadRecogida']) && isset($data['participantes']) && isset($data['descripcion'])) {
            $limpiezaDTO = new LimpiezaDTO(
                null,
                $data['ubicacion'],
                $data['fecha'],
                $data['cantidadRecogida'],
                $data['participantes'],
                $data['descripcion'],
            );

            $nuevaLimpieza = $this->limpiezaDAO->crearLimpieza($limpiezaDTO);

            if ($nuevaLimpieza) {
                echo json_encode([
                    'message' => 'Limpieza creada exitosamente',
                    'limpieza' => $nuevaLimpieza,
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(['error' => 'No se ha podido crear el nuevo registro']);
            }
        } else {
            // Respuesta de error si faltan datos
            echo json_encode(['error' => 'Datos incompletos']);
        }
    }
    //PUT
    public function updateLimpieza($id, $data)
    {
        $limpiezaActualizada = $this->limpiezaDAO->actualizarLimpieza($id, $data);

        if ($limpiezaActualizada) {
            echo json_encode([
                'message' => 'Limpieza actualizada con exito',
                'limpieza' => $limpiezaActualizada,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['error' => 'Error al actualizar la limpieza con ID: ' . $id]);
        }
    }
    //DELETE
    public function deleteLimpieza($id)
    {
        $resultado = $this->limpiezaDAO->eliminarLimpieza($id);

        if ($resultado) {
            echo json_encode([
                'message' => 'Limpieza eliminada con exito'
            ]);
        } else {
            echo json_encode(['error' => 'Error al eliminar la limpieza con ID: ' . $id]);
        }
    }
}
