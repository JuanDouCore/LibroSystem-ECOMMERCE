<?php 

session_start();

if(isset($_REQUEST['logout'])) {
    session_unset();
    session_destroy();
    
    header("Location: index.php");
    exit();
}

if(isset($_POST['login'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    //logica que verifica el inicio de sesión
    if($user === "bla") {
        $_SESSION['loggedin'] = true;
    } else {
        $_SESSION['errorLogin'] = "Usuario o contraseña incorrecto, verifique";
    }

    header("Location: index.php");
    exit();
}

if(isset($_POST['register'])) {
    $user = $_POST['user'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $dni = $_POST['DNI'];

    //logica para verificar si existe alguien con dichos datos
    if(true) {
        //logica para crear el usuario

        $_SESSION['loggedin'] = true;
    } else {
        $_SESSION['errorLogin'] = "Ya existe alguien con estos datos";
    }

    header("Location: index.php");
    exit();
}
?>