<?php
    require_once('../../header.php');
    require_once('../../controllers/LanguageController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editar idioma</title>
    </head>
    <body>
        <div class="container">
            <?php
                $idLanguage = $_GET['id'];
                $languageObject = getLanguageData($idLanguage);

                $sendData = false;
                $languageEdited = false;

                if (isset($_POST['editBtn'])) {
                    $sendData = true;
                }

                if ($sendData) {
                    if(isset($_POST['languageName']) && isset($_POST['languageISO'])) {
                        $languageEdited = updateLanguage($_POST['languageId'], $_POST['languageName'], $_POST['languageISO']);
                    }
                }

                if (!$sendData) {
            ?>
                    <div class="row">
                        <div class="col-12">
                            <h1>Editar idioma</h1>
                        </div>
                        <div class="col-12">
                            <form name="create_language" action="" method="POST">
                                <div class="nb-3">
                                    <label for="languageName" class="form-label">Nombre idioma</label>
                                    <input id="languageName" name="languageName" type="text" placeholder="Introduce el nombre del idioma" class="form-control" required value="<?php if(isset($languageObject)) echo $languageObject->getName(); ?>"/>
                                    <label for="languageISO" class="form-label">Codigo ISO</label>
                                    <input id="languageISO" name="languageISO" type="text" placeholder="Introduce el codigo ISO del idioma" class="form-control" required value="<?php if(isset($languageObject)) echo $languageObject->getISO(); ?>"/>
                                    <input type="hidden" name="languageId" value="<?php echo $idLanguage; ?>"/>
                                </div>
                                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn"/>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    if ($languageEdited) {
            ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Idioma editado correctamente.<br><a href="list.php">Volver al listado de idiomas.</a>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                El idioma no se ha editado correctamente.<br><a href="edit.php?id=<?php echo $idLanguage; ?>">Volver a intentarlo.</a>
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