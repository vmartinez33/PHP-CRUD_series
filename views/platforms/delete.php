<?php
    require_once('../../controllers/PlatformController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Borrar plataforma</title>
    </head>
    <body>
        <div class="container">
            <?php
                $idPlatform = $_POST['platformId'];
                $platformDeleted = deletePlatform($idPlatform);

                if ($platformDeleted) {
            ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Plataforma borrada correctamente.<br><a href="list.php">Volver al listado de plataformas.</a>
                        </div>
                    </div>
            <?php
                } else {
            ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            La plataforma no se ha borrado correctamente.<br><a href="list.php">Volver a intentarlo.</a>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </body>
</html>