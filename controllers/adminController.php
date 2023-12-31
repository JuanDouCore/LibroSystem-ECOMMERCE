<?php
require_once __DIR__.'/../database/database.php';

session_start();



//Comienzo de seccion para procesar POST's & GET's en el controlador
if($_SERVER["REQUEST_METHOD"] == "POST" || ($_SERVER["REQUEST_METHOD"] == "GET")) {
    if(isset($_POST['resetpassword'])) {
        $id = $_POST['id'];

        database::resetPasswordUsuario($id);
        $_SESSION['infoMessageUsersAdminPage'] = "Contraseña del usuario establecida a 12345";

        header("Location: ../admin/usuarios.php");
        exit();
    }

    if(isset ($_POST['modificarLibro'])){
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $categoria = $_POST['categoria'];
        $descripcion = $_POST['descripcion'];
        $fechaPublicacion = $_POST['fecha_publicacion'];
        $precio = $_POST['precio'];
        $id = $_POST['id'];

        $libro = database:: leerLibro($id,null);

        $libro -> setTitulo($titulo);
        $libro -> setAutor($autor);
        $libro -> setCategoria($categoria);
        $libro -> setDescripcion($descripcion);
        $libro -> setFechaPublicacion($fechaPublicacion);
        $libro -> setPrecio($precio);


        database::modificarLibro($libro);

        $_SESSION ['confirmacionPaginaAdmin'] = "Se modifico el libro con exito";
        header("location: ../admin.php");

        exit();

    }


    if(isset($_POST['cargarLibroAmodificarStock'])) {
        if(isset ($_POST['titulo'])){
            $titulo = $_POST['titulo'];
            $libro = database::leerLibro(null,$titulo);

            if($libro != null) {
                $_SESSION['libroAmodificar'] = $libro;
            } else {
                $_SESSION['errorCargarLibroaModificar'] = "No existe un libro con este titulo";
            }
            

            header("Location: ../admin/modificar_stock_libro.php");
            exit();
        }
        
        if(isset ($_POST['id'])){

            if($_POST['id']===""){
                $_SESSION['errorCargarLibroaModificar'] = "No existe un libro con esta ID";

                header("Location: ../admin/modificar_stock_libro.php");
                exit();
            }

            $id = $_POST['id'];
            $libro = database::leerLibro($id,null);

            if($libro != null) {
                $_SESSION['libroAmodificar'] = $libro;
            } else {
                $_SESSION['errorCargarLibroaModificar'] = "No existe un libro con esta ID";
            }

            header("Location: ../admin/modificar_stock_libro.php");

            exit();

        }

        if(isset ($_POST['masvendidos'])){

            $id = $_POST['masvendidos'];
            $libro = database::leerLibro($id,null);

            if($libro != null) {
                $_SESSION['libroAmodificar'] = $libro;
            } else {
                $_SESSION['errorCargarLibroaModificar'] = "No existe un libro con esta ID";
            }

            header("Location: ../admin/modificar_stock_libro.php");

            exit();

        }
        
        if(isset ($_POST['stockbajo'])){

            $id = $_POST['stockbajo'];
            $libro = database::leerLibro($id,null);

            if($libro != null) {
                $_SESSION['libroAmodificar'] = $libro;
            } else {
                $_SESSION['errorCargarLibroaModificar'] = "No existe un libro con esta ID";
            }

            header("Location: ../admin/modificar_stock_libro.php");

            exit();

        }
    }


    if(isset ($_POST['cargarLibroAmodificar'])){
        if(isset ($_POST['titulo'])){
            $titulo = $_POST['titulo'];
            $libro = database::leerLibro(null,$titulo);

            if($libro != null) {
                $_SESSION['libroAmodificar'] = $libro;
            } else {
                $_SESSION['errorCargarLibroaModificar'] = "No existe un libro con este titulo";
            }
            

            header("Location: ../admin/modificar_libro.php");
            exit();
        }
        
        if(isset ($_POST['id'])){

            if($_POST['id']===""){
                $_SESSION['errorCargarLibroaModificar'] = "No existe un libro con esta ID";

                header("Location: ../admin/modificar_libro.php");

                exit();
            }
            $id = $_POST['id'];
            $libro = database::leerLibro($id,null);

            if($libro != null) {
                $_SESSION['libroAmodificar'] = $libro;
            } else {
                $_SESSION['errorCargarLibroaModificar'] = "No existe un libro con esta ID";
            }

            header("Location: ../admin/modificar_libro.php");

            exit();

        }
    }

    if(isset($_POST['cambiarrol'])) {
        $id = $_POST['id'];
        $rol = $_POST['rol'];

        database::cambiarRolUsuario($id, $rol);
        $_SESSION['infoMessageUsersAdminPage'] = "El usuario ahora tiene el rol de ". ($rol == 3 ? "ADMIN" : "CLIENTE");

        header("Location: ../admin/usuarios.php");
        exit();
    }

    if(isset($_POST['cargarlibro'])){

        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $fecha_publicacion = $_POST['fecha_publicacion'];
        $stock = $_POST['stock'];
        $precio = $_POST['precio'];

        if(database::compararTituloLibro($titulo)){
            $_SESSION['errorCargaLibro'] = "Ya existe un libro con este titulo";
            header("location: ../admin/cargar_libro.php");
            exit();
        }

        if($precio <= 0 || $stock < 0) {
            $_SESSION['errorCargaLibro'] = "El stock y el precio del libro deben ser positivos";
            header("location: ../admin/cargar_libro.php");
            exit();
        }

        $carpetaImagen = "../images/"; // Cambia esto a la ruta de la carpeta donde deseas almacenar las imágenes
        $imagenCargada = $_FILES["portada"];

        // Verificar si no hay errores durante la carga
        if ($imagenCargada["error"] === UPLOAD_ERR_OK) {
            $tempFilePath = $imagenCargada["tmp_name"];
            $nombreOriginalImagen = basename($imagenCargada["name"]);

            // Generar un nombre único para el archivo
            $uniqueImagenNombre = uniqid() . '' . $nombreOriginalImagen;
            $rutaDestino = $carpetaImagen . $uniqueImagenNombre;

            // Mover el archivo temporal a la ubicación deseada
            if (move_uploaded_file($tempFilePath, $rutaDestino)) {
                $referencia_imagen = $uniqueImagenNombre;
            } else {
                echo "Error al mover el archivo a la carpeta de destino.";
            }
        } else {
            echo "Error en la carga de la imagen. Código de error: " . $imagenCargada["error"];
        }

        $libro = new Libro(null, $titulo, $autor, $descripcion, $referencia_imagen, $fecha_publicacion, $categoria, $stock, 0, $precio);
        database::cargarLibro($libro);

        $_SESSION['confirmacionPaginaAdmin'] = "Libro cargado con exito";
        header("location: ../admin.php");
        exit();
    }
}



function leerUsuarios($tipo) {
    $usuarios = database::leerUsuarios($tipo);

    foreach($usuarios as $usuario) {
        $variableParaAdmin = "";
        if($usuario->getRol() == 3) {

        }

        echo '
        <tr>
        <td>'.$usuario->getName().'</td>
        <td>'.$usuario->getDni().'</td>
        <td>'.($usuario->getRol() == 1 ? "CLIENTE":"EMPLEADO").'</td>
        <td> <form action="../controllers/adminController.php" method="POST">
            <input type="hidden" name="id" value="'.$usuario->getId().'">
            <input type="submit" name="resetpassword" id="resetpassword" value="RESET PASSWORD">
        </form>
        <form action="../controllers/adminController.php" method="POST">
                <input type="hidden" name="id" value="'.$usuario->getId().'">
                <input type="hidden" name="rol" value="'.($usuario->getRol() == 1 ? 2 : 1).'">
                <input type="submit" name="cambiarrol" id="cambiarrol" value="CONVERTIR EN '.($usuario->getRol() == 1 ? "EMPLEADO":"CLIENTE").'">
            </form>
        <form action="../controllers/adminController.php" method="POST">
            <input type="hidden" name="id" value="'.$usuario->getId().'">
            <input type="hidden" name="rol" value="'.($usuario->getRol() == 3 ? 1 : 3).'">
            <input type="submit" name="cambiarrol" id="cambiarrol" value="'.($usuario->getRol() == 3 ? "REMOVER ADMIN":"AGREGAR ADMIN").'">
        </form>
        </td>
        </tr>
        ';
    }
}

function leerLibrosParaReponerStockCriterioEspecial($criterio) {
    $libros = database::getLibrosReponerStockCriterioEspecial($criterio);

    $posicion = 1;
    foreach($libros as $id) {
        $libro = database::leerLibro($id, null);

        echo '<option value="'.$libro->getId().'">#'.$posicion.' - '.$libro->getTitulo().'</option>';
        $posicion++;
    }
}

?>