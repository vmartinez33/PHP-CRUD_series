<?php
    require_once('../../controllers/LanguageController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Borrar idioma</title>
    </head>
    <body>
        <div class="container">
            <?php
                $idLanguage = $_POST['languageId'];
                $languageDeleted = deleteLanguage($idLanguage);

                if ($languageDeleted) {
            ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Idioma borrado correctamente.<br><a href="list.php">Volver al listado de idiomas.</a>
                        </div>
                    </div>
            <?php
                } else {
            ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El idioma no se ha borrado correctamente.<br><a href="list.php">Volver a intentarlo.</a>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </body>
</html>