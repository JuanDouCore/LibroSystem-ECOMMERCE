<?php 

require_once 'database/database.php';

session_start();

if(isset($_REQUEST['logout'])) {
    session_unset();
    session_destroy();
    
    header("Location: index.php");
    exit();
}

if(isset($_POST['login'])) {
    if($_POST['user'] === "" || $_POST['password'] === "") {
        $_SESSION['errorLogin'] = "Por favor complete todos los campos";
        header("Location: index.php");
        exit();
    }

    $user = $_POST['user'];
    $password = $_POST['password'];

    //logica que verifica el inicio de sesión
    if(database::validateUserLogin($user, $password)) {
        $_SESSION['loggedin'] = true;

        //cargamos la id del usuario en la sesion
        $_SESSION['userLogged'] = database::getUserId($user);
        
        //verificamos si es admin
        if(database::checkIfAdmin($user)) $_SESSION['isAdmin'] = true;
        //verificamos si es empleado
        if(database::checkIfEmpleoye($user)) $_SESSION['isEmpleoye'] = true;

    } else {
        $_SESSION['errorLogin'] = "Usuario o contraseña incorrecto, verifique";
    }

    header("Location: index.php");
    exit();
}

if(isset($_POST['register'])) {
    if($_POST['user'] === "" ||$_POST['name'] === ""||$_POST['password'] === ""||$_POST['DNI'] === "") {
        $_SESSION['errorLogin'] = "Por favor complete todos los campos";
        header("Location: index.php");
        exit();
    }


    $user = $_POST['user'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $dni = $_POST['DNI'];

    //logica para verificar si existe alguien con dichos datos
    if(!database::checkUserExistForRegister($user, $name, $dni)) {
        
        database::registerUser($user, $password, $name, $dni, 1);

        $_SESSION['userLogged'] = database::getUserId($user);

        $_SESSION['loggedin'] = true;
    } else {
        $_SESSION['errorLogin'] = "Ya existe alguien con estos datos";
    }

    header("Location: index.php");
    exit();
}

header("Location: index.php");
exit();
?>