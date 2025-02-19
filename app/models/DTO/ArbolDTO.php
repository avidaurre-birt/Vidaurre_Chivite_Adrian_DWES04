<?php

class ArbolDTO implements JsonSerializable
{
    private $id;
    private $especie;
    private $cantidad;
    private $plantacionId;

    public function __construct($id, $especie, $cantidad, $plantacionId)
    {
        $this->id = $id;
        $this->especie = $especie;
        $this->cantidad = $cantidad;
        $this->plantacionId = $plantacionId;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEspecie()
    {
        return $this->especie;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getPlantacionId()
    {
        return $this->plantacionId;
    }
}
