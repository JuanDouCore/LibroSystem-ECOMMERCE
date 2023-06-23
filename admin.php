<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    session_start();
    if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true && !isset($_SESSION['isAdmin'])) {
        $_SESSION['errorLogin'] = "No tienes autorizado acceder aqui";
        header("Location: index.php");
        exit();
    }
    ?>

    
</body>
</html>