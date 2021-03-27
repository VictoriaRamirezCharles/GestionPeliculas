<?php
include '../helpers/utilities.php';
include 'serviceSession.php';

    if(isset($_POST["peliculaName"]) && isset($_POST["peliculaDescription"]) && isset($_POST["generoId"])){

        $pelicula = ["name" => $_POST["peliculaName"],"description"=>$_POST["peliculaDescription"],"generoId"=>$_POST["generoId"],"status"=>$_POST["peliculaStatus"]];
        
        if($_POST["peliculaStatus"]){

            $pelicula["status"] ="SI";
        }else{
            $pelicula["status"] = "NO";
        }
        Add($pelicula);

        header("Location: ../index.php");
    }

?>