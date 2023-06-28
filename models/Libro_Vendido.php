<?php 
class Libro_Vendido {

    private $ventaid;
    private $libroId;
    private $titulo;
    private $cantidad;
    private $costoTotal;

    public function __construct($ventaid, $libroId, $titulo, $cantidad, $costoTotal) {
        $this->ventaid=$ventaid;
        $this->libroId=$libroId;
        $this->titulo=$titulo;
        $this->cantidad=$cantidad;
        $this->costoTotal=$costoTotal;
    }

    /**
     * Get the value of libroId
     */ 
    public function getLibroId()
    {
        return $this->libroId;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Get the value of costoTotal
     */ 
    public function getCostoTotal()
    {
        return $this->costoTotal;
    }

    /**
     * Get the value of ventaid
     */ 
    public function getVentaid()
    {
        return $this->ventaid;
    }
}
?>