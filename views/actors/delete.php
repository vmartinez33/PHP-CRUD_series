<?php
    require_once('../../header.php');
    require_once('../../controllers/ActorController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Borrar actor</title>
    </head>
    <body>
        <div class="container">
            <?php
                $idActor = $_POST['actorId'];
                $deleteConfirmed = false;

                if (isset($_POST['confirmBtn'])) {
                    $deleteConfirmed = true;
                }

                if ($deleteConfirmed) {
                    $actorDeleted = deleteActor($idActor);
                }
                
                if (!$deleteConfirmed) {
            ?>
                    <div class="alert alert-warning" role="alert">
                        ¿Estás seguro de que quieres eliminar el registro?
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <form name="confirm_delete" action="" method="POST">
                            <input type="submit" value="Confirmar" class="btn btn-success" name="confirmBtn"/>
                        </form>                      
                        <a class="btn btn-danger" href="list.php">Cancelar</a>                                           
                    </div>
            <?php
                } else {
                    if ($actorDeleted) {
            ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Actor borrado correctamente.<br><a href="list.php">Volver al listado de actores.</a>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                El actor no se ha borrado correctamente. Asegurese de que no pertenezca a ninguna serie.<br><a href="list.php">Volver a intentarlo.</a>
                            </div>
                        </div>
            <?php
                    }
            ?>
            <?php
                }
            ?>
        </div>
    </body>
<?php 
require_once('../../footer.php');
?>