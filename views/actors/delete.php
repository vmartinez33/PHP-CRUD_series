<?php
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
                $actorDeleted = deleteActor($idActor);

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
                            El actor no se ha borrado correctamente.<br><a href="list.php">Volver a intentarlo.</a>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </body>
</html>