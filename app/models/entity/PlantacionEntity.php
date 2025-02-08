<?php

class PlantacionesEntity
{

    private $id_plantacion;
    private $ubicacion;
    private $fecha_plantacion;
    private $especie;
    private $cantidad;
    private $participantes;


    public function __construct($ubicacion, $fecha_plantacion, $especie, $cantidad, $participantes)
    {
        $this->ubicacion = $ubicacion;
        $this->fecha_plantacion = $fecha_plantacion;
        $this->especie = $especie;
        $this->cantidad = $cantidad;
        $this->participantes = $participantes;
    }

    /**
     * Get the value of id_plantacion
     */
    public function getIdPlantacion()
    {
        return $this->id_plantacion;
    }

    /**
     * Set the value of id_plantacion
     */
    public function setIdPlantacion($id_plantacion): self
    {
        $this->id_plantacion = $id_plantacion;

        return $this;
    }

    /**
     * Get the value of ubicacion
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set the value of ubicacion
     */
    public function setUbicacion($ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get the value of fecha_plantacion
     */
    public function getFechaPlantacion()
    {
        return $this->fecha_plantacion;
    }

    /**
     * Set the value of fecha_plantacion
     */
    public function setFechaPlantacion($fecha_plantacion): self
    {
        $this->fecha_plantacion = $fecha_plantacion;

        return $this;
    }

    /**
     * Get the value of especie
     */
    public function getEspecie()
    {
        return $this->especie;
    }

    /**
     * Set the value of especie
     */
    public function setEspecie($especie): self
    {
        $this->especie = $especie;

        return $this;
    }

    /**
     * Get the value of cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     */
    public function setCantidad($cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of participantes
     */
    public function getParticipantes()
    {
        return $this->participantes;
    }

    /**
     * Set the value of participantes
     */
    public function setParticipantes($participantes): self
    {
        $this->participantes = $participantes;

        return $this;
    }
}
