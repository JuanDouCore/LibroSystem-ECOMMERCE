<?php 
require_once __DIR__.'/../database/database.php';

session_start();

if(isset($_POST['agregarAlCarrito'])) {
    $idLibro = $_POST['libro'];
    $cantidad = $_POST['cantidad'];

    //logica para verificar si hay stock

    //si no hay stock tiene que pasar esto
    $_SESSION['errorAgregarCarrito'] = "No hay unidades disponibles.";
    header("Location: ../libro.php?libro=$idLibro");
    exit();
}

?>