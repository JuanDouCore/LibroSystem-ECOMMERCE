<?php

class Venta {
    private $id;
    private $idUsuario;
    private $cantidadTotal;
    private $costoTotal;
    private $medioDePago;
    private $metodoDeEntrega;
    private $direccionEnvio_calle;
    private $direccionEnvio_altura;
    private $direccionEnvio_localidad;
    private $direccionEnvio_provincia;
    private $estado;

    public function __construct(
        $id, 
        $idUsuario, 
        $cantidadTotal, 
        $costoTotal, 
        $medioDePago, 
        $metodoDeEntrega, 
        $direccionEnvio_calle = null, 
        $direccionEnvio_altura = null, 
        $direccionEnvio_localidad = null, 
        $direccionEnvio_provincia = null, 
        $estado)
    {
        $this->id=$id;
        $this->idUsuario=$idUsuario;
        $this->cantidadTotal=$cantidadTotal;
        $this->costoTotal=$costoTotal;
        $this->medioDePago=$medioDePago;
        $this->metodoDeEntrega=$metodoDeEntrega;
        $this->direccionEnvio_calle=$direccionEnvio_calle;
        $this->direccionEnvio_altura=$direccionEnvio_altura;
        $this->direccionEnvio_localidad=$direccionEnvio_localidad;
        $this->direccionEnvio_provincia=$direccionEnvio_provincia;
        $this->estado=$estado;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getCantidadTotal() {
        return $this->cantidadTotal;
    }

    /**
     * Get the value of costoTotal
     */ 
    public function getCostoTotal()
    {
        return $this->costoTotal;
    }

    /**
     * Get the value of medioDePago
     */ 
    public function getMedioDePago()
    {
        return $this->medioDePago;
    }

    /**
     * Get the value of metodoDeEntrega
     */ 
    public function getMetodoDeEntrega()
    {
        return $this->metodoDeEntrega;
    }

    /**
     * Get the value of direccionEnvio_calle
     */ 
    public function getDireccionEnvio_calle()
    {
        return $this->direccionEnvio_calle;
    }

    /**
     * Get the value of direccionEnvio_altura
     */ 
    public function getDireccionEnvio_altura()
    {
        return $this->direccionEnvio_altura;
    }

    /**
     * Get the value of direccionEnvio_localidad
     */ 
    public function getDireccionEnvio_localidad()
    {
        return $this->direccionEnvio_localidad;
    }

    /**
     * Get the value of direccionEnvio_provincia
     */ 
    public function getDireccionEnvio_provincia()
    {
        return $this->direccionEnvio_provincia;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}
?>