<?php
    require_once('../../header.php');
    require_once('../../controllers/SeriesController.php');
?>
<!DOCTYPE html>
    <body>
        <div class="container">
            <?php
                $idSeries = $_POST['seriesId'];
                $deleteConfirmed = false;

                if (isset($_POST['confirmBtn'])) {
                    $deleteConfirmed = true;
                }

                if ($deleteConfirmed) {
                    $seriesDeleted = deleteSeries($idSeries);
                }
                
                if (!$deleteConfirmed) {
            ?>
                    <div class="alert alert-warning" role="alert">
                        ¿Estás seguro de que quieres eliminar el registro?
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <form name="confirm_delete" action="" method="POST">
                            <input type="submit" value="Confirmar" class="btn btn-success" name="confirmBtn"/>
                            <input type="hidden" name="seriesId" value="<?php echo $idSeries; ?>"/>
                        </form>                      
                        <a class="btn btn-danger" href="list.php">Cancelar</a>                                           
                    </div>
            <?php
                } else {
                    if ($seriesDeleted) {
            ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Serie borrada correctamente.<br><a href="list.php">Volver al listado de series.</a>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                La serie no se ha borrado correctamente.<br><a href="list.php">Volver a intentarlo.</a>
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