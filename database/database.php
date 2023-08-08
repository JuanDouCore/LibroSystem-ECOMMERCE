<?php 

    require_once __DIR__.'/../models/Libro.php';
    require_once __DIR__.'/../models/Venta.php';
    require_once __DIR__.'/../models/Usuario.php';
    require_once __DIR__.'/../models/Libro_Vendido.php';


class database {

    private static $host = "34.176.231.10";
    private static $user = "root";
    private static $password = "librosystempassword";
    private static $database = "librosystem";
    
    //gestion de la conexion sql
    private static function getConnection() {
        $conexion = mysqli_connect(self::$host, self::$user, self::$password, self::$database)
        or die("Ocurrió un error en la conexión sql");

        return $conexion;
    }

    private static function sendQuery($query) {
        mysqli_query(self::getConnection(), $query) or die("Error en el envío de query ".mysqli_error(self::getConnection()));
    }

    private static function getQuery($query) {
        $lectura = mysqli_query(self::getConnection(), $query) or die("Error en el envío de query ".mysqli_error(self::getConnection()));
        return $lectura;
    }

    private static function closeConnection() {
        mysqli_close(self::getConnection());
    }





    //consultas para usuarios
    public static function validateUserLogin($user, $password) {
        $consulta = self::getQuery("select * from usuarios where user='".$user."' and password='".$password."';");

        if(mysqli_fetch_array($consulta))
            return true;
        else
            return false;

        self::closeConnection();
    }

    public static function registerUser($user, $password, $name, $dni, $rol) {
        self::sendQuery("insert into usuarios (user, password, name, dni, rol) values ('".$user."', '".$password."', '".$name."', ".$dni.", ". $rol . ");");

        self::closeConnection();
    }

    public static function checkUserExistForRegister($user, $name, $dni) {
        $consulta = self::getQuery("select * from usuarios where user='".$user."' or name='".$name."' or dni=".$dni.";");

        if(mysqli_fetch_array($consulta))
            return true;
        else
            return false;

        self::closeConnection();
    }

    public static function getUserId($user) {
        $consulta = self::getQuery("select id from usuarios where user='".$user."';");

        if($lectura = mysqli_fetch_array($consulta))
            return $lectura['id'];

        self::closeConnection();
    }

    public static function checkIfAdmin($user) {
        $consulta = self::getQuery("select rol from usuarios where user='".$user."';");

        if($lectura = mysqli_fetch_array($consulta)) 
            return $lectura['rol']==3;

        self::closeConnection();
    }

    public static function checkIfEmpleoye($user) {
        $consulta = self::getQuery("select rol from usuarios where user='".$user."';");

        if($lectura = mysqli_fetch_array($consulta)) 
            return $lectura['rol']==2;

        self::closeConnection();
    }

    public static function leerUsuario($idUsuario) {
        $consulta = self::getQuery("select * from usuarios where id=" .$idUsuario. ";");

        if($lectura = mysqli_fetch_array($consulta)) {
            $usuario = new Usuario($lectura['id'], $lectura['user'], $lectura['name'], $lectura['password'], $lectura['dni'], $lectura['rol']);
            return $usuario;
        }

        self::closeConnection();
    }


    public static function leerUsuarios($criterio) {

        $usuarios = array();

        switch($criterio) {
            case "TODOS":
                $consulta = self::getQuery("select * from usuarios;");

                while($lectura = mysqli_fetch_array($consulta)) {
                    $usuario = new Usuario($lectura['id'], $lectura['user'], $lectura['name'], $lectura['password'], $lectura['dni'], $lectura['rol']);
                    $usuarios[] = $usuario;
                }

                break;
            case "CLIENTES":
                $consulta = self::getQuery("select * from usuarios where rol = 1;");

                while($lectura = mysqli_fetch_array($consulta)) {
                    $usuario = new Usuario($lectura['id'], $lectura['user'], $lectura['name'], $lectura['password'], $lectura['dni'], $lectura['rol']);
                    $usuarios[] = $usuario;
                }
                
                break;
            case "EMPLEADOS":

                $consulta = self::getQuery("select * from usuarios where rol = 2;");

                while($lectura = mysqli_fetch_array($consulta)) {
                    $usuario = new Usuario($lectura['id'], $lectura['user'], $lectura['name'], $lectura['password'], $lectura['dni'], $lectura['rol']);
                    $usuarios[] = $usuario;
                }
                
                break;
        }

        self::closeConnection();
        return $usuarios;
    }
    
    public static function cambiarRolUsuario($id, $rol) {
        self::sendQuery("UPDATE usuarios SET rol = ".$rol." WHERE id = ".$id.";");

        self::closeConnection();
    }

    public static function resetPasswordUsuario($id) {
        self::sendQuery("UPDATE usuarios SET password = '123345' WHERE id = ".$id.";");

        self::closeConnection();
    }


    //consultas para libros
    public static function cargarLibro($libro) {
        self::sendQuery("insert into libros (titulo, autor, descripcion, referencia_imagen, fecha_publicacion, categoria, stock, vendidos, precio)
        values ('" . $libro->getTitulo() . "','"
         . $libro->getAutor() . "','"
          . $libro->getDescripcion() . "','"
           . $libro->getImagenRuta() . "','" 
             . $libro->getFechaPublicacion() . "','"
                . $libro->getCategoria() . "',"
                   . $libro->getStock() . ","
                    . $libro->getVendidos() . ",
                    ".$libro->getPrecio() . ");");

        self::closeConnection();
    }

    public static function leerLibro($id = null, $titulo = null) {
    if(isset ($id)  ){
        $consulta = self::getQuery("select * from libros where id=".$id.";");

        if($lectura = mysqli_fetch_array($consulta)) {
            self::closeConnection();

            return new Libro(
                $lectura['id'],
                $lectura['titulo'],
                $lectura['autor'],
                $lectura['descripcion'],
                $lectura['referencia_imagen'],
                $lectura['fecha_publicacion'],
                $lectura['categoria'],
                $lectura['stock'],
                $lectura['vendidos'],
                $lectura['precio']
            );
        } else {
            return null;
        }
    }


    if(isset ($titulo)  ){
        $consulta = self::getQuery("select * from libros where titulo='".$titulo."';");

        if($lectura = mysqli_fetch_array($consulta)) {
            self::closeConnection();

            return new Libro(
                $lectura['id'],
                $lectura['titulo'],
                $lectura['autor'],
                $lectura['descripcion'],
                $lectura['referencia_imagen'],
                $lectura['fecha_publicacion'],
                $lectura['categoria'],
                $lectura['stock'],
                $lectura['vendidos'],
                $lectura['precio']
            );
        } else {
            return null;
        }
    }
    }


    public static function leerLibrosDeCategoria($categoria) {
        $libros = array();

        $consulta = self::getQuery("select * from libros where categoria='".$categoria."';");

        while($lectura = mysqli_fetch_array($consulta)) {
            $libros[] = new Libro(
                $lectura['id'],
                $lectura['titulo'],
                $lectura['autor'],
                $lectura['descripcion'],
                $lectura['referencia_imagen'],
                $lectura['fecha_publicacion'],
                $lectura['categoria'],
                $lectura['stock'],
                $lectura['vendidos'],
                $lectura['precio']
            );
        }

        self::closeConnection();

        return $libros;
    }

    public static function buscarLibro($titulo = null, $id = null) {
        $libros = array();

        if(isset($id)) {
            $consulta = self::getQuery("select * from libros where id=".$id.";");

            while($lectura = mysqli_fetch_array($consulta)) {
                $libros[] = new Libro(
                    $lectura['id'],
                    $lectura['titulo'],
                    $lectura['autor'],
                    $lectura['descripcion'],
                    $lectura['referencia_imagen'],
                    $lectura['fecha_publicacion'],
                    $lectura['categoria'],
                    $lectura['stock'],
                    $lectura['vendidos'],
                    $lectura['precio']
                );
            }
        } 

        if(isset($titulo)) {
            $consulta = self::getQuery("select * from libros where titulo LIKE '".$titulo."%';");

            while($lectura = mysqli_fetch_array($consulta)) {
                $libros[] = new Libro(
                    $lectura['id'],
                    $lectura['titulo'],
                    $lectura['autor'],
                    $lectura['descripcion'],
                    $lectura['referencia_imagen'],
                    $lectura['fecha_publicacion'],
                    $lectura['categoria'],
                    $lectura['stock'],
                    $lectura['vendidos'],
                    $lectura['precio']
                );
            }
        }

        self::closeConnection();
        return $libros;
    }

    public static function modificarLibro($libro) {
        self::sendQuery("UPDATE libros SET titulo='" . $libro->getTitulo() . "', autor='"
         . $libro->getAutor() . "', descripcion='"
          . $libro->getDescripcion() . "', referencia_imagen='"
           . $libro->getImagenSer() . "', fecha_publicacion='" 
             . $libro->getFechaPublicacion() . "', categoria='"
                . $libro->getCategoria() . "', stock="
                   . $libro->getStock() . ", vendidos="
                    . $libro->getVendidos() . ", precio=" 
                    . $libro->getPrecio() .
                     " WHERE id=".$libro->getId().";");

        self::closeConnection();
    }

    public static function compararTituloLibro($titulo){
        $consulta = self::getQuery("select * from libros where titulo='".$titulo."';");

        if(mysqli_fetch_array($consulta)){
            self::closeConnection();
            return true;
        } else { 
            self::closeConnection();
            return false;
        }
    }

    public static function obtenerStockLibro($id) {
        $consulta = self::getQuery("SELECT stock FROM libros WHERE id=".$id.";");

        if($lectura = mysqli_fetch_array($consulta)) {
            return $lectura['stock'];
        }
    }
    public static function obtenerCostoLibro($id) {
        $consulta = self::getQuery("SELECT precio FROM libros WHERE id=".$id.";");

        if($lectura = mysqli_fetch_array($consulta)) {
            return $lectura['precio'];
        }
    }
    public static function agregarStockLibro($id, $cantidad) {
        self::sendQuery("UPDATE libros SET stock=stock+".$cantidad." WHERE id=".$id.";");
        self::closeConnection();
    }
    public static function reducirStockLibro($id, $cantidad) {
        self::sendQuery("UPDATE libros SET stock=stock-".$cantidad." WHERE id=".$id.";");
        self::closeConnection();
    }
    public static function agregarVendidosLibro($id, $cantidad) {
        self::sendQuery("UPDATE libros SET vendidos=vendidos+".$cantidad." WHERE id=".$id.";");
        self::closeConnection();
    }



    //consultas de ventas

    public static function obtenerProximoIdDeVenta() {
        $consulta = self::getQuery("SELECT IFNULL(MAX(id), 0)+1 AS proximo_id FROM ventas;");

        if($lectura = mysqli_fetch_array($consulta)) {
            self::closeConnection();
            return $lectura['proximo_id'];
        }
    }

    public static function cargarVenta($venta) {
        self::sendQuery("INSERT INTO ventas 
        (idusuario, 
        cantidadtotal, 
        costototal, 
        mediodepago, 
        metododeentrega, 
        direccionenvio_calle, 
        direccionenvio_altura,
        direccionenvio_localidad, 
        direccionenvio_provincia, 
        estado)
        VALUES (
        " . $venta->getIdUsuario() . ",
        ". $venta->getCantidadTotal() . ",
        ". $venta->getCostoTotal() . ",
        '". $venta->getMedioDePago() . "',
        '". $venta->getMetodoDeEntrega() . "',
        '". $venta->getDireccionEnvio_calle() . "',
        '". $venta->getDireccionEnvio_altura() . "',
        '". $venta->getDireccionEnvio_localidad() . "',
        '". $venta->getDireccionEnvio_provincia() . "',
        '". $venta->getEstado() . "');");

        self::closeConnection();
    }

    public static function leerVenta($idVenta) {
        $consulta = self::getQuery("SELECT * FROM ventas WHERE id=". $idVenta);

        if($lectura = mysqli_fetch_array($consulta)) {
            self::closeConnection();

            return new Venta(
                $lectura['id'],
                $lectura['idusuario'],
                $lectura['cantidadtotal'],
                $lectura['costototal'],
                $lectura['mediodepago'],
                $lectura['metododeentrega'],
                $lectura['direccionenvio_calle'],
                $lectura['direccionenvio_altura'],
                $lectura['direccionenvio_localidad'],
                $lectura['direccionenvio_provincia'],
                $lectura['estado']
            );
        }
    }

    public static function leerVentasPendientes() {
        $ventas = array();

        $consulta = self::getQuery("SELECT * FROM ventas WHERE estado='A ENVIAR' OR estado='POR RETIRAR';");

        while($lectura = mysqli_fetch_array($consulta)) {
            $ventas[] = new Venta(
                $lectura['id'],
                $lectura['idusuario'],
                $lectura['cantidadtotal'],
                $lectura['costototal'],
                $lectura['mediodepago'],
                $lectura['metododeentrega'],
                $lectura['direccionenvio_calle'],
                $lectura['direccionenvio_altura'],
                $lectura['direccionenvio_localidad'],
                $lectura['direccionenvio_provincia'],
                $lectura['estado']
            );
        }
        return $ventas;
    }

    public static function modificarEstadoVenta($idVenta, $nuevoEstado) {
        self::sendQuery("UPDATE ventas SET estado='".$nuevoEstado."' WHERE id=". $idVenta. ";");

        self::closeConnection();
    }

    public static function cargarLibroVendido($libroVendido) {
        self::sendQuery("INSERT INTO libros_vendidos (ventaid, libroid, titulo, cantidad, costototal) VALUES 
        (". $libroVendido->getVentaid() . ",
        ". $libroVendido->getLibroId() . ",
        '". $libroVendido->getTitulo() . "', 
        ". $libroVendido->getCantidad() . ",
        ". $libroVendido->getCostoTotal() . ");");
    }

    public static function leerLibrosVendidosDeVenta($idVenta) {
        $libros_vendidos = array();

        $consulta = self::getQuery("SELECT * FROM libros_vendidos WHERE ventaid=". $idVenta. ";");

        while($lectura = mysqli_fetch_array($consulta)) {
            $libros_vendidos[] = new Libro_Vendido(
                $lectura['ventaid'],
                $lectura['libroid'],
                $lectura['titulo'],
                $lectura['cantidad'],
                $lectura['costototal']
            );
        }

        self::closeConnection();

        return $libros_vendidos;
    }

    public static function eliminarLibrosVendidosDeVenta($idVenta) {
        self::sendQuery("DELETE FROM libros_vendidos WHERE ventaid=".$idVenta.";");

        self::closeConnection();
    }

    public static function calcularLibrosTotalesDeVenta($idVenta) {
        $libros_vendidos = array();

        $total = 0;

        $consulta = self::getQuery("SELECT cantidad FROM libros_vendidos WHERE ventaid=". $idVenta. ";");
        while($lectura = mysqli_fetch_array($consulta)) {
            $total += $lectura['cantidad'];
        }

        return $total;
    }
}
?>