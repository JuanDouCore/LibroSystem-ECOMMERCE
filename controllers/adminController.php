<?php
require_once __DIR__.'/../database/database.php';

session_start();

//Comienzo de seccion para procesar POST's & GET's en el controlador
if(isset($_POST['resetpassword'])) {
    $id = $_POST['id'];

    database::resetPasswordUsuario($id);
    $_SESSION['infoMessageUsersAdminPage'] = "Contraseña del usuario establecida a 12345";

    header("Location: ../admin/usuarios.php");
    exit();
}

if(isset($_POST['cambiarrol'])) {
    $id = $_POST['id'];
    $rol = $_POST['rol'];

    database::cambiarRolUsuario($id, $rol);
    $_SESSION['infoMessageUsersAdminPage'] = "El usuario ahora tiene el rol de ". ($rol == 1 ? "CLIENTE" : "EMPLEADO");

    header("Location: ../admin/usuarios.php");
    exit();
}


//fin seccion

function leerUsuarios($tipo) {
    $usuarios = database::leerUsuarios($tipo);

    foreach($usuarios as $usuario) {
        echo '
        <tr>
        <td>'.$usuario->getName().'</td>
        <td>'.$usuario->getDni().'</td>
        <td>'.($usuario->getRol() == 1 ? "CLIENTE":"EMPLEADO").'</td>
        <td> <form action="../controllers/adminController.php" method="POST">
            <input type="hidden" name="id" value="'.$usuario->getId().'">
            <input type="submit" name="resetpassword" id="resetpassword" value="RESET PASSWORD">
        </form>
        </td>
        <td><form action="../controllers/adminController.php" method="POST">
                <input type="hidden" name="id" value="'.$usuario->getId().'">
                <input type="hidden" name="rol" value="'.($usuario->getRol() == 1 ? 2 : 1).'">
                <input type="submit" name="cambiarrol" id="cambiarrol" value="CONVERTIR EN '.($usuario->getRol() == 1 ? "EMPLEADO":"CLIENTE").'">
            </form>
        </td>
        </tr>
        ';
    }
}


?>