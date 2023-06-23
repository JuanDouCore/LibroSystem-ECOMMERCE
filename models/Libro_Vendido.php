<?php 
class LibroVenta {

    private $libroId;
    private $libroTitle;
    private $cantidad;
    private $costoTotal;

    public function __construct($libroId, $libroTitle, $cantidad, $costoTotal) {
        $this->libroId=$libroId;
        $this->libroTitle=$libroTitle;
        $this->cantidad=$cantidad;
        $this->costoTotal=$costoTotal;
    }
}
?>