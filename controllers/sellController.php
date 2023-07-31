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


if(isset($_POST['procesarCompra_Envio'])){

    if($_POST['calle'] === "" || $_POST['altura'] === "" || $_POST['localidad'] === "" || $_POST['provincia'] === "" || $_POST['metodoPago'] === ""){
        $_SESSION['errorCheckout'] = "Por favor complete todos los campos";
        header("Location: ../checkout.php");
        exit();
    }

    $direccionCalle = $_POST['calle'];
    $direccionAltura = $_POST['altura'];
    $direccionLocalidad = $_POST['localidad'];
    $direccionProvincia = $_POST['provincia'];
    $metodoPago = $_POST['metodoPago'];

    $costoTotalCompra = 0;
    $cantidadLibros = 0 ;
    
    $librosDelCarrito = array();

    
    foreach($_SESSION['carrito'] as $clave => $objeto) {

        $libro = database::leerLibro($objeto->getIdLibro());
        $costoTotal = $objeto->getCantidad()*$libro->getPrecio();
        $titulo = $libro->getTitulo();
        $costoTotalCompra+=$costoTotal;

        $libroCarrito = new Libro_Vendido(database::obtenerProximoIdDeVenta(), $objeto->getIdLibro(),$titulo,$objeto->getCantidad(),$costoTotal);

        $cantidadLibros++;
        $librosDelCarrito[] = $libroCarrito;


    }
    
    $venta = new Venta(database::obtenerProximoIdDeVenta(),
        $_SESSION['userLogged'],
        $cantidadLibros,
        $costoTotalCompra,
        $metodoPago,"ENVIAR",
        $direccionCalle,
        $direccionAltura,
        $direccionLocalidad,
        $direccionProvincia,
        "A ENVIAR");

    database::cargarVenta($venta);

    foreach($librosDelCarrito as $libroDelCarrito){
        database::cargarLibroVendido($libroDelCarrito);
        database::reducirStockLibro($libroDelCarrito->getLibroId(),$libroDelCarrito->getCantidad());
        database::agregarVendidosLibro($libroDelCarrito->getLibroId(), $libroDelCarrito->getCantidad());
    }
        unset($_SESSION['carrito']);
        header("Location: ../index.php");
        exit();

}

if(isset($_POST['procesarCompra_Retiro'])){

    if($_POST['metodoPago'] === ""){
        $_SESSION['errorCheckout'] = "Por favor complete todos los campos";
        header("Location: ../checkout.php");
        exit();
    }

    $metodoPago = $_POST['metodoPago'];
    
    $librosDelCarrito = array();
    $costoTotalCompra = 0;
    $cantidadLibros = 0 ;
    
    foreach($_SESSION['carrito'] as $clave => $objeto) {

        $libro = database::leerLibro($objeto->getIdLibro());
        $costoTotal = $objeto->getCantidad()*$libro->getPrecio();
        $titulo = $libro->getTitulo();
        $costoTotalCompra+=$costoTotal;

        $libroCarrito = new Libro_Vendido(database::obtenerProximoIdDeVenta(), $objeto->getIdLibro(),$titulo,$objeto->getCantidad(),$costoTotal);
        $cantidadLibros++;

        $librosDelCarrito[] = $libroCarrito;
    }
    
    $venta = new Venta(database::obtenerProximoIdDeVenta(),
        $_SESSION['userLogged'],
        $cantidadLibros,
        $costoTotalCompra,
        $metodoPago,"RETIRAR",
        null,
        0,
        null,
        null,
        "POR RETIRAR");

    database::cargarVenta($venta);

    foreach($librosDelCarrito as $libroDelCarrito){
        database::cargarLibroVendido($libroDelCarrito);
        database::reducirStockLibro($libroDelCarrito->getLibroId(),$libroDelCarrito->getCantidad());
        database::agregarVendidosLibro($libroDelCarrito->getLibroId(), $libroDelCarrito->getCantidad());
    }

        unset($_SESSION['carrito']);
        header("Location: ../index.php");
        exit();

}

if(isset($_POST['procesarEstadoVenta'])) {
    $id = $_POST['venta'];
    $estado = $_POST['estadoVenta'];

    database::modificarEstadoVenta($id, $estado);
    database::eliminarLibrosVendidosDeVenta($id);

    header("Location: ../ventas.php");
    exit();
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

function leerVentasPendientes(){
  $ventasPendientes = database::leerVentasPendientes();

  foreach($ventasPendientes as $venta){
    echo '
    <div class="divVenta">
                    <div>
                        <p>#'.$venta->getId().'</p>
                    </div>
                    <div>
                        <p>Ejemplares: '. $venta ->getCantidadTotal().'</p>
                        <p>Cant. Total: '.database::calcularLibrosTotalesDeVenta($venta->getId()).'</p>
                        <p>Precio total: '.$venta->getCostoTotal().'$</p>
                    </div>
                    <div>
                    <p>Estado: '.$venta->getEstado().'</p>
                    <p>Pago: Pagado '.$venta->getMedioDePago().'</p>
                    </div>
                
                    <div>
                        <form action="venta.php" method="get">
                                    <input type="hidden" name="venta" value="'.$venta->getId().'">
                                    <label for="btnLibro">
                                        <input id="verVenta" type="submit" value="Ver venta">
                                    </label>
                        </form>
                    </div>      
            </div>
    ';
    

  }

}

function LeerVenta($IdVenta){

    $venta = database::leerVenta($IdVenta);
    
    return $venta;
}

function leerUsuarioDeVenta($idUsuario) {
    $usuario = database::leerUsuario($idUsuario);

    return $usuario;
}

function mostrarLibrosDeVenta($IdVenta){
    $libros = database::leerLibrosVendidosDeVenta($IdVenta);

    foreach($libros as $libro){

    echo '<li>'.$libro->getTitulo().' | '.$libro->getCantidad().'U | TOTAL $'.$libro->getCostoTotal().'</li>';
    
    }
}



//utilidades
function mostrarModal($mensaje) {
    echo '<script type="text/javascript">';
    echo 'alert("' . $mensaje . '");';
    echo '</script>';
}

?>