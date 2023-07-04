<?php 
require_once __DIR__.'/../database/database.php';
require_once __DIR__.'/../models/Libro_Carrito.php';

session_start();


//Comienzo de seccion para procesar POST's & GET's en el controlador
if(isset($_POST['agregarAlCarrito'])) {
    $idLibro = $_POST['libro'];
    $cantidad = $_POST['cantidad'];

    if(database::obtenerStockLibro($idLibro) >= $cantidad) {

        if(isset($_SESSION['carrito'])) {

            foreach($_SESSION['carrito'] as $clave => $objeto) {
                if($objeto->getIdLibro() == $idLibro) {

                    $_SESSION['errorAgregarCarrito'] = "Ya tienes este libro en el carrito";
                    header("Location: ../libro.php?libro=$idLibro");
                    exit();
                }
            }

            $libro = new Libro_Carrito($idLibro, $cantidad);
            $_SESSION['carrito'][] = $libro;
            header("Location: ../index.php");
            exit();
        } else {
            
            $libro = new Libro_Carrito($idLibro, $cantidad);
            $_SESSION['carrito'][] = $libro;
            header("Location: ../index.php");
            exit();
        }

    } else {
        $_SESSION['errorAgregarCarrito'] = "No hay suficientes unidades disponibles.";
        header("Location: ../libro.php?libro=$idLibro");
        exit();
    }
}

if(isset($_POST['eliminardecarrito'])) {
    $idLibro = $_POST['libro'];

    foreach($_SESSION['carrito'] as $clave => $objeto) {
        if($objeto->getIdLibro() == $idLibro) {
            unset($_SESSION['carrito'][$clave]);
            break;
        }
    }

    if(empty($_SESSION['carrito'])) {
        unset($_SESSION['carrito']);
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../checkout.php");
        exit();
    }
}
//fin seccion



//comienzo de seccion para funciones del Controlador
function cargarLibrosCarrito() {

    foreach($_SESSION['carrito'] as $clave => $objeto) {
        $libro = database::leerLibro($objeto->getIdLibro());

        $titulo = $libro->getTitulo();
        $imagen = $libro->getImagenRuta();
        $precioUnitario = $libro->getPrecio();
        $id = $libro->getId();

        $cantidadAComprar = $objeto->getCantidad();
        $costoTotal = $precioUnitario*$cantidadAComprar;

        echo '
        <div class="divLibroCheckOut">
            
        <div class="divFotoCheckOut">
            <img src="/librosystem/images/'.$imagen.'" alt="img libro" >
        </div>
        <div>
            <p>'.$titulo.'</p>
        </div>
    
        <div>
            <p>$'.$costoTotal.'</p>
        </div>
    
        <div>
            <p>x'.$cantidadAComprar.'</p>
        </div>
        
        <div>
            <form action="./controllers/sellController.php" method="post">
                            <input type="hidden" name="libro" value="'.$id.'">
                            <label for="btnLibro">
                                <input name="eliminardecarrito" id="eliminardecarrito" type="submit" value="Eliminar">
                            </label>
            </form>
        </div>
        
    </div>
        ';
    }

}

function calcularTotalCarrito() {
    $costoTotal = 0;
    foreach($_SESSION['carrito'] as $clave => $objeto) {
        $costoUnitario = database::obtenerCostoLibro($objeto->getIdLibro());
        $cantidadAComprar = $objeto->getCantidad();

        $costoTotal += $costoUnitario*$cantidadAComprar;
    }

    echo $costoTotal;
}

?>