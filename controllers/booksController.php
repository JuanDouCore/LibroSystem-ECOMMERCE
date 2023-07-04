<?php 
require_once './database/database.php';


function leerLibros($categoria){
    $libros = database::leerLibrosDeCategoria($categoria);
    foreach($libros as $libro){
        echo '<div class="divLibros">
        <p class="tituloLibro">'.$libro->getTitulo().'</p>
        <br>
        <div class="divImgLibro"><img src="/librosystem/images/'.$libro->getImagenRuta().'" alt="imagenLibros"></div>
        <br>
        <p class="precioLibro">'.$libro->getPrecio().'</p>
        <div class="botonFlex">
            <form method="get" action="libro.php">
                <input type="hidden" name="libro" value="'.$libro->getId().'">
                <label for="btnLibro">
                    <input id="btnLibro" type="submit" value="Ver libro">
                </label>
            </form>
        </div>
    </div>';
    }
}

function leerLibro($id){
    $libro = database::leerLibro($id);
    return $libro;
}

?>