<?php

class ActividadEntity
{

    private $id_actividad;
    private $titulo;
    private $fecha_actividad;
    private $ubicacion;
    private $duracion;
    private $descripcion;
    private $publico;

    private function __construct($titulo, $fecha_actividad, $ubicacion, $duracion, $descripcion, $publico)
    {
        $this->titulo = $titulo;
        $this->fecha_actividad = $fecha_actividad;
        $this->ubicacion = $ubicacion;
        $this->duracion = $duracion;
        $this->descripcion = $descripcion;
        $this->publico = $publico;
    }



    /**
     * Get the value of id_actividad
     */
    public function getIdActividad()
    {
        return $this->id_actividad;
    }

    /**
     * Set the value of id_actividad
     */
    public function setIdActividad($id_actividad): self
    {
        $this->id_actividad = $id_actividad;

        return $this;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of fecha_actividad
     */
    public function getFechaActividad()
    {
        return $this->fecha_actividad;
    }

    /**
     * Set the value of fecha_actividad
     */
    public function setFechaActividad($fecha_actividad): self
    {
        $this->fecha_actividad = $fecha_actividad;

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
     * Get the value of duracion
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set the value of duracion
     */
    public function setDuracion($duracion): self
    {
        $this->duracion = $duracion;

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

    /**
     * Get the value of publico
     */
    public function getPublico()
    {
        return $this->publico;
    }

    /**
     * Set the value of publico
     */
    public function setPublico($publico): self
    {
        $this->publico = $publico;

        return $this;
    }
}
