<?php
    require_once('../../header.php');
    require_once('../../controllers/DirectorController.php');
?>
<!DOCTYPE html>
    <body>
        <div class="container">
            <?php
                $idDirector = $_POST['directorId'];
                $deleteConfirmed = false;

                if (isset($_POST['confirmBtn'])) {
                    $deleteConfirmed = true;
                }

                if ($deleteConfirmed) {
                    $directorDeleted = deleteDirector($idDirector);
                }
                
                if (!$deleteConfirmed) {
            ?>
                    <div class="alert alert-warning" role="alert">
                        ¿Estás seguro de que quieres eliminar el registro?
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <form name="confirm_delete" action="" method="POST">
                            <input type="submit" value="Confirmar" class="btn btn-success" name="confirmBtn"/>
                            <input type="hidden" name="directorId" value="<?php echo $idDirector; ?>"/>
                        </form>                      
                        <a class="btn btn-danger" href="list.php">Cancelar</a>                                           
                    </div>
            <?php
                } else {
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
                                El director no se ha borrado correctamente. Asegurese de que no pertenezca a ninguna serie.<br><a href="list.php">Volver a intentarlo.</a>
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