<?php
    require_once('../../header.php');
    require_once('../../controllers/PlatformController.php');
?>
    <body>
        <div class="container">
            <?php
                $idPlatform = $_POST['platformId'];
                $deleteConfirmed = false;

                if (isset($_POST['confirmBtn'])) {
                    $deleteConfirmed = true;
                }

                if ($deleteConfirmed) {
                    $platformDeleted = deletePlatform($idPlatform);
                }
                
                if (!$deleteConfirmed) {
            ?>
                    <div class="alert alert-warning" role="alert">
                        ¿Estás seguro de que quieres eliminar el registro?
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <form name="confirm_delete" action="" method="POST">
                            <input type="submit" value="Confirmar" class="btn btn-success" name="confirmBtn"/>
                            <input type="hidden" name="platformId" value="<?php echo $idPlatform; ?>"/>
                        </form>                      
                        <a class="btn btn-danger" href="list.php">Cancelar</a>                                           
                    </div>
            <?php
                } else {
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
                                La plataforma no se ha borrado correctamente. Asegurese de que no pertenezca a ninguna serie.<br><a href="list.php">Volver a intentarlo.</a>
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