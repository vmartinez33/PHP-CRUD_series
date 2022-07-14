<?php
    require_once('../../header.php');
    require_once('../../controllers/PlatformController.php');
?>
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
<?php 
    require_once('../../footer.php');
?>