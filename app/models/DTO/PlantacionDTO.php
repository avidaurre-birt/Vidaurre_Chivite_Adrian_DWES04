<?php

class PlantacionDTO implements JsonSerializable
{

    private $id_plantacion;
    private $ubicacion;
    private $fecha_plantacion;
    private $participantes;


    public function __construct($id_plantacion, $ubicacion, $fecha_plantacion, $participantes)
    {
        $this->id_plantacion = $id_plantacion;
        $this->ubicacion = $ubicacion;
        $this->fecha_plantacion = $fecha_plantacion;
        $this->participantes = $participantes;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of id_plantacion
     */
    public function getIdPlantacion()
    {
        return $this->id_plantacion;
    }

    /**
     * Get the value of ubicacion
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Get the value of fecha_plantacion
     */
    public function getFechaPlantacion()
    {
        return $this->fecha_plantacion;
    }


    /**
     * Get the value of participantes
     */
    public function getParticipantes()
    {
        return $this->participantes;
    }
}
