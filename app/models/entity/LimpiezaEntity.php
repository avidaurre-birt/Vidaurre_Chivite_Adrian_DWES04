<?php

class LimpiezaEntity
{

    private $id_limpieza;
    private $ubicacion;
    private $fecha_limpieza;
    private $cantidadRecogida;
    private $participantes;
    private $descripcion;

    public function __construct($ubicacion, $fecha_limpieza, $cantidadRecogida, $participantes, $descripcion)
    {
        $this->ubicacion = $ubicacion;
        $this->fecha_limpieza = $fecha_limpieza;
        $this->cantidadRecogida = $cantidadRecogida;
        $this->participantes = $participantes;
        $this->descripcion = $descripcion;
    }



    /**
     * Get the value of id_limpieza
     */
    public function getIdLimpieza()
    {
        return $this->id_limpieza;
    }

    /**
     * Set the value of id_limpieza
     */
    public function setIdLimpieza($id_limpieza): self
    {
        $this->id_limpieza = $id_limpieza;

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
     * Get the value of fecha_limpieza
     */
    public function getFechaLimpieza()
    {
        return $this->fecha_limpieza;
    }

    /**
     * Set the value of fecha_limpieza
     */
    public function setFechaLimpieza($fecha_limpieza): self
    {
        $this->fecha_limpieza = $fecha_limpieza;

        return $this;
    }

    /**
     * Get the value of cantidadRecogida
     */
    public function getCantidadRecogida()
    {
        return $this->cantidadRecogida;
    }

    /**
     * Set the value of cantidadRecogida
     */
    public function setCantidadRecogida($cantidadRecogida): self
    {
        $this->cantidadRecogida = $cantidadRecogida;

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

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     */
    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}
