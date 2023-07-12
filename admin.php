<?php 
    if (!isset($_SESSION)) {
        session_start();
    }

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || !isset($_SESSION['isAdmin'])) {
        $_SESSION['errorLogin'] = "No tienes autorizado acceder al panel de administracion";
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    
</body>
</html>