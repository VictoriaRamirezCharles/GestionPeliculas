<?php
include '../helpers/utilities.php';
include 'serviceSession.php';

$pelicula = null;
if (isset($_GET["id"])) {

    $pelicula = GetById($_GET["id"]);

        Delete($pelicula);

        header("Location: ../index.php");
        exit();
    
}


?>