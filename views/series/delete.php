<?php
    require_once('../../header.php');
    require_once('../controllers/DirectorController.php');
?>
<!DOCTYPE html>
    <body>
        <div class="container">
            <?php
                $idSeries = $_POST['seriesId'];
                $seriesDeleted = deleteseries($idseries);

                if ($seriesDeleted) {
            ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Serie borrado correctamente.<br><a href="list.php">Volver al listado de series.</a>
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
        </div>
    </body>
<?php 
    require_once('../../footer.php');
?>