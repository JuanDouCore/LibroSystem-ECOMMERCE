<?php 


session_start();
require_once __DIR__.'/../database/database.php';

if($_SERVER["REQUEST_METHOD"] == "POST" || ($_SERVER["REQUEST_METHOD"] == "GET")) {
    if(isset($_POST['reponerStockLibro'])) {
        $id = $_POST['id'];
        $cantidad = $_POST['cantidad'];

        database::agregarStockLibro($id, $cantidad);

        $_SESSION['confirmacionPaginaAdmin'] = "Se repuso el stock del libro con exito";
        header("Location: ../admin.php");
        exit();

    }
}

    function leerLibros($categoria){
        $libros = database::leerLibrosDeCategoria($categoria);
        
        foreach($libros as $libro){
            echo '<div class="divLibros">
            <p class="tituloLibro">'.$libro->getTitulo().'</p>
            <br>
            <div class="divImgLibro"><img src="/images/'.$libro->getImagenRuta().'" alt="imagenLibros"></div>
            <br>
            <p class="precioLibro">$'.$libro->getPrecio().'</p>
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