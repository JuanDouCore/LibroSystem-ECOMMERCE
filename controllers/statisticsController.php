<?php
require_once __DIR__.'/../database/database.php';



function calcularEstadisticas ($tipoEstadistica){

switch ($tipoEstadistica) {
    case 'libros':
        $libros = database::getTop10LibrosVendidos();
        $posicion = 1;

        foreach ($libros as $libro) {
            echo '<li>'.$posicion.' - '.$libro.'</li>';
            $posicion++;
        }
        break;
    case 'autores':
        $libros = database::getTop10Autores();
        $posicion = 1;

        foreach ($libros as $libro) {
            echo '<li>'.$posicion.' - '.$libro.'</li>';
            $posicion++;
        }
        break;
    case 'categorias':
        $libros = database::getTop10Categorias();
        $posicion = 1;

        foreach ($libros as $libro) {
            echo '<li>'.$posicion.' - '.$libro.'</li>';
            $posicion++;
        }
        break;
}


}






?>