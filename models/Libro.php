<?php 

class Libro {
    private $id;
    private $titulo;
    private $autor;
    private $descripcion;
    private $imagen_serializada;
    private $fecha_publicacion;
    private $categoria;
    private $stock;
    private $vendidos;

    public function __construct($id = null, $titulo, $autor, $descripicion, $imagen_serializada, $fecha_publicacion, $categoria, $stock, $vendidos) {
        $this->id=$id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->descripcion = $descripicion;
        $this->imagen_serializada = $imagen_serializada;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->categoria = $categoria;
        $this->stock = $stock;
        $this->vendidos = $vendidos;
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

    public function getImagenSer() {
        return $this->imagen_serializada;
    }
    public function setImagenSer($imagen_serializada) {
        $this->imagen_serializada=$imagen_serializada;
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



}
?>