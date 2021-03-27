<?php
include '../layout/layout.php';
include '../helpers/utilities.php';
include 'serviceSession.php';

$pelicula = null;
if (isset($_GET["id"])) {

    $pelicula = GetById($_GET["id"]);

    if(isset($_POST["peliculaName"]) && isset($_POST["peliculaDescription"]) && isset($_POST["generoId"])){
        $pelicula = ["id"=> $_GET["id"],"name" => $_POST["peliculaName"],"description"=>$_POST["peliculaDescription"],"generoId"=>$_POST["generoId"],"status"=>$_POST["peliculaStatus"]];
        
        if(isset($_POST['peliculaStatus'])){

            $pelicula["status"] ="SI";
        }else{
            $pelicula["status"] = "NO";
        }
        Edit($pelicula);

        header("Location: ../index.php");
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>

    <?php echo printHeader() ?>

    <?php if ($pelicula == null && count($pelicula) == 0) : ?>
        <h2>No existe esta pelicula</h2>
    <?php else : ?>
        <div class="card">
        <div class="card-body">
        <form action="edit.php?id=<?= $pelicula["id"]?>" method="POST">
            <div class="mb-3">
                <label for="pelicula-name" class="form-label">Nombre de la Pelicula</label>
                <input name="peliculaName" type="text" class="form-control" id="pelicula-name" value="<?= $pelicula['name'] ?>">

            </div>
            <div class="mb-3">
                <label for="pelicula-description" class="form-label">Descripcion</label>
                <input name="peliculaDescription" type="text" class="form-control" id="pelicula-description" value="<?= $pelicula['description'] ?>">
            </div>
                <div class="mb-3">
                <label for="pelicula-status" class="form-label">Activa</label>
                <?php if($pelicula["status"]=="SI" || $pelicula["status"]==1):?>
                <input name="peliculaStatus" type="checkbox" class="form-check-input" id="pelicula-status" checked value="1">
                <?php else :?>
                <input name="peliculaStatus" type="checkbox" class="form-check-input" id="pelicula-status"  >
                <?php endif;?>   
            </div>
            <div class="mb-3">
                <label for="pelicula-genero" class="form-label">Genero</label>
                <select name="generoId" class="form-select" id="pelicula-genero">
                    <option value="">Seleccione una opcion</option>
                    <?php foreach ($generos as $value => $text) : ?>

                        <?php if($value == $pelicula["generoId"]):?>
                            <option selected value="<?php echo $value; ?>"> <?= $text ?> </option>
                         <?php else :?>
                            <option value="<?php echo $value; ?>"> <?= $text ?> </option>
                        <?php endif;?>   

                        

                    <?php endforeach; ?>
                </select>
            </div>
            <a href="../index.php" class="btn btn-warning">Volver atras </a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        </div>
        </div>
    <?php endif; ?>




    <?php echo printFooter() ?>

</body>

</html>