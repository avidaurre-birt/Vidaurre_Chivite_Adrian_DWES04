<?php
require '../app/models/DAO/PlantacionDAO.php';
require '../app/controllers/PlantacionController.php';

$plantacionDAO = new PlantacionDAO();
$plantacionController = new PlantacionController();

$plantaciones = $$plantacionController->obtenerPlantaciones();
//echo var_dump($plantaciones);


//$plantacion = $plantacionDAO->obtenerPlantacionId(3);
echo json_encode($plantaciones);
