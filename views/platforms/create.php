<?php
    require_once('../../header.php');
    require_once('../../controllers/PlatformController.php');
    
?>

        <div class="container">
            <?php
                $sendData = false;
                $platformCreated = false;

                if(isset($_POST['createBtn'])) {
                    $sendData = true;
                }

                if($sendData) {
                    if(isset($_POST['platformName'])) {
                        $platformCreated = storePlatform($_POST['platformName']);
                    }
                }

                if(!$sendData) {
            ?>
                    <div class="row">
                        <div style="text-align: center;">
                            <h1>Crear plataforma</h1>
                        </div>
                        <div class="col-12">
                            <form name="create_platform" action="" method="POST">
                                <div class="nb-3">
                                    <label for="plataformName" class="form-label">Nombre plataforma</label>
                                    <input id="platformName" name="platformName" type="text" placeholder="Introduce el nombre de la plataforma" class="form-control" required />
                                </div>
                                <br>
                                <div style="text-align: center;">
                                <input type="submit" value="Crear" class="btn btn-primary" name="createBtn"/>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    if($platformCreated) {
            ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Plataforma creada correctamente.<br><a href="list.php">Volver al listado de plataformas.</a>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                La plataforma no se ha creado correctamente.<br><a href="create.php">Volver a intentarlo.</a>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
<?php
    require_once('../../footer.php');
?>



