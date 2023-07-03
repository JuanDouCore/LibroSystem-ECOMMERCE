<?php 

class Libro {
    private $id;
    private $titulo;
    private $autor;
    private $descripcion;
    private $referencia_imagen;
    private $fecha_publicacion;
    private $categoria;
    private $stock;
    private $vendidos;
    private $precio;

    public function __construct($id = null, $titulo, $autor, $descripicion, $referencia_imagen, $fecha_publicacion, $categoria, $stock, $vendidos, $precio){
        $this->id=$id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->descripcion = $descripicion;
        $this->referencia_imagen = $referencia_imagen;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->categoria = $categoria;
        $this->stock = $stock;
        $this->vendidos = $vendidos;
        $this->precio = $precio;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }
    public function setTitulo($titulo) {
        $this->titulo=$titulo;
    }

    public function getAutor() {
        return $this->autor;
    }
    public function setAutor($autor) {
        $this->autor=$autor;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion=$descripcion;
    }

    public function getImagenRuta() {
        return $this->referencia_imagen;
    }
    public function setImagenRuta($referencia_imagen) {
        $this->referencia_imagen=$referencia_imagen;
    } 

    public function getFechaPublicacion() {
        return $this->fecha_publicacion;
    }
    public function setFechaPublicacion($fecha_publicacion) {
        $this->fecha_publicacion=$fecha_publicacion;
    }

    public function getCategoria() {
        return $this->categoria;
    }
    public function setCategoria($categoria) {
        $this->categoria=$categoria;
    }

    public function getStock() {
        return $this->stock;
    }
    public function setStock($stock) {
        $this->stock=$stock;
    }

    public function getVendidos() {
        return $this->vendidos;
    }
    public function setVendidos($vendidos) {
        $this->vendidos=$vendidos;
    }

    public function getPrecio() {
        return $this->precio;
    }
    public function setPrecio($precio) {
        $this->precio=$precio;
    }


}
?>