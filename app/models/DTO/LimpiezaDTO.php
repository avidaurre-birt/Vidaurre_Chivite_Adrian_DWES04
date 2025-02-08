<?php

class LimpiezaDTO implements JsonSerializable
{

    private $id_limpieza;
    private $ubicacion;
    private $fecha_limpieza;
    private $cantidadRecogida;
    private $participantes;
    private $descripcion;


    public function __construct($id_limpieza, $ubicacion, $fecha_limpieza, $cantidadRecogida, $participantes, $descripcion)
    {
        $this->id_limpieza = $id_limpieza;
        $this->ubicacion = $ubicacion;
        $this->fecha_limpieza = $fecha_limpieza;
        $this->cantidadRecogida = $cantidadRecogida;
        $this->participantes = $participantes;
        $this->descripcion = $descripcion;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of id_limpieza
     */
    public function getIdLimpieza()
    {
        return $this->id_limpieza;
    }

    /**
     * Get the value of ubicacion
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Get the value of fecha_limpieza
     */
    public function getFechaLimpieza()
    {
        return $this->fecha_limpieza;
    }

    /**
     * Get the value of fecha_limpieza
     */
    public function getCantidadRecogida()
    {
        return $this->cantidadRecogida;
    }

    /**
     * Get the value of participantes
     */
    public function getParticipantes()
    {
        return $this->participantes;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}
