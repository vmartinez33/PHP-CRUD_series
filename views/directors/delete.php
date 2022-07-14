<?php
    require_once('../../header.php');
    require_once('../controllers/DirectorController.php');
?>
<!DOCTYPE html>
    <body>
        <div class="container">
            <?php
                $idDirector = $_POST['directorId'];
                $directorDeleted = deleteDirector($idDirector);

                if ($directorDeleted) {
            ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Director borrado correctamente.<br><a href="list.php">Volver al listado de directores.</a>
                        </div>
                    </div>
            <?php
                } else {
            ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El director no se ha borrado correctamente.<br><a href="list.php">Volver a intentarlo.</a>
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