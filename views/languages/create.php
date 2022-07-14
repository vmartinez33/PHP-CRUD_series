<?php
    require_once('../../header.php');
    require_once('../../controllers/LanguageController.php');
?>
<!DOCTYPE html>
    <body>
        <div class="container">
            <?php
                $sendData = false;
                $languageCreated = false;

                if(isset($_POST['createBtn'])) {
                    $sendData = true;
                }

                if($sendData) {
                    if(isset($_POST['languageName']) && isset($_POST['languageISO'])) {
                        $languageCreated = storeLanguage($_POST['languageName'], $_POST['languageISO']);
                    }
                }

                if(!$sendData) {
            ?>
                    <div class="row">
                        <div>
                            <h1>Crear idioma</h1>
                        </div>
                        <div class="col-12">
                            <form name="create_language" action="" method="POST">
                                <div class="nb-3">
                                    <label for="languageName" class="form-label">Nombre idioma</label>
                                    <input id="languageName" name="languageName" type="text" placeholder="Introduce el nombre del idioma" class="form-control" required />
                                    <label for="languageISO" class="form-label">Codigo ISO</label>
                                    <input id="languageISO" name="languageISO" type="text" placeholder="Introduce el codigo ISO del idioma" class="form-control" required />
                                </div>
                                <input type="submit" value="Crear" class="btn btn-primary" name="createBtn"/>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    if($languageCreated) {
            ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Idioma creado correctamente.<br><a href="list.php">Volver al listado de idiomas.</a>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                El idioma no se ha creado correctamente.<br><a href="create.php">Volver a intentarlo.</a>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </body>
<?php 
    require_once('../../footer.php');
?>
