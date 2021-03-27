<?php
include 'helpers/utilities.php';
include 'movies/serviceSession.php';
include 'layout/layout.php';

$peliculas = GetList();

if(isset($_GET['generoId'])){
if(!empty($peliculas)){
    $peliculas = searchProperty($peliculas,'generoId',$_GET['generoId']);
}
}else{
    $peliculas = GetList();
}

?>

<?php echo printHeader(true); ?>

<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2">

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nueva-pelicula-modal">
            Nueva Pelicula
        </button>
        
    </div>
</div>
<br>
<div class="container" style="display:flex">
<div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">
        <div class="btn-group">
        <a href="index.php" class="btn btn-dark text-light">Todos</a>
        <a href="index.php?generoId=1" class="btn btn-dark text-light">Accion</a>
        <a href="index.php?generoId=2" class="btn btn-dark text-light">Terror</a>
        <a href="index.php?generoId=3" class="btn btn-dark text-light">Comedia</a>
        <a href="index.php?generoId=4" class="btn btn-dark text-light">Suspenso</a>
        <a href="index.php?generoId=5" class="btn btn-dark text-light">Documentales</a>
        </div>
    </div>
</div>
</div>
<br>
<div class="row">

    <?php if (count($peliculas) == 0) : ?>

        <h2>No hay Peliculas registradas</h2>

    <?php else : ?>

        <?php foreach ($peliculas as $key => $pelicula) : ?>
         
            <div class="col-md-3">
           
            
            <?php 
     
            if ($pelicula['status']=="NO") : ?>
                    
                <div class="card inactiva">
                <?php else : ?>
                   
                    <div class="card">
                            
                    <?php endif; ?>
                   
                    <div class="card-body">
                        <h5 class="card-title"><?= $pelicula['name'] ?></h5>
                        <br>
                        <p class="card-text"><strong>Descripcion: </strong><?= $pelicula['description'] ?></p>
                        <p class="card-text"><strong>Genero: </strong><?php echo $generos[$pelicula["generoId"]] ?></p>
                        <strong>Activa: </strong><?= $pelicula['status'] ?>
                    </div>

                    <div class="card-body">
                       <a href="movies/edit.php?id=<?= $pelicula['id']?>" class="btn btn-primary">Editar</a>

                        <a href="movies/delete.php?id=<?= $pelicula['id']?>" class="btn btn-danger">Eliminar</a>
                    </div>
                    
                </div>
                
            </div>
            
        <?php endforeach; ?>



    <?php endif; ?>



</div>



<div class="modal fade" id="nueva-pelicula-modal" tabindex="-1" aria-labelledby="editPeliculaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPeliculaLabel">Nuevo Pelicula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="movies/add.php" method="POST">
                    <div class="mb-3">
                        <label for="pelicula-name" class="form-label">Nombre de la Pelicula</label>
                        <input name="peliculaName" type="text" class="form-control" id="pelicula-name">

                    </div>
                    <div class="mb-3">
                        <label for="pelicula-description" class="form-label">Descripcion</label>
                        <input name="peliculaDescription" type="text" class="form-control" id="pelicula-description">
                    </div>
                    <div class="mb-3">
                        <label for="pelicula-status" class="form-label">Activa</label>
                        <input name="peliculaStatus" type="checkbox" class="form-check-input" id="pelicula-status" checked value="1">
                    </div>
                    <div class="mb-3">
                        <label for="pelicula-genero" class="form-label">Genero</label>
                        <select name="generoId" class="form-select" id="pelicula-genero">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($generos as $value => $text) : ?>

                                <option value="<?php echo $value; ?>"> <?= $text ?> </option>

                            <?php endforeach; ?>
                        </select>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo printFooter(true); ?>

