<?php 

class Libro_Carrito {
    private $idLibro;
    private $cantidad;

    public function __construct($idLibro, $cantidad)
    {
        $this->idLibro=$idLibro;
        $this->$cantidad=$cantidad;
    }

    /**
     * Get the value of idLibro
     */ 
    public function getIdLibro()
    {
        return $this->idLibro;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }
}
?>