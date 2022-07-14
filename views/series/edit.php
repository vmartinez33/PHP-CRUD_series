<?php
    require_once('../../header.php');
    require_once('../../controllers/PlatformController.php');
    require_once('../../controllers/DirectorController.php');
    require_once('../../controllers/ActorController.php');
    require_once('../../controllers/LanguageController.php');
    require_once('../../controllers/SeriesController.php');
?>
<!DOCTYPE html>
    <body>
        <div class="container">
            <?php
                $idSeries = $_GET['id'];
                $seriesObject = getSeriesData($idSeries);

                $sendData = false;
                $seriesEdited = false;

                if (isset($_POST['editBtn'])) {
                    $sendData = true;
                }

                if($sendData) {
                    $condition = isset($_POST['seriesTitle']) && isset($_POST['seriesPlatformId']) && isset($_POST['seriesDirectorId']) && isset($_POST['seriesActors']) && isset($_POST['seriesAudioLanguages']) && isset($_POST['seriesSubtitlesLanguages']);
                    if($condition) {
                        $seriesEdited = updateSeries($_POST['seriesId'], $_POST['seriesTitle'], $_POST['seriesPlatformId'], 
                                                     $_POST['seriesDirectorId'], $_POST['seriesActors'], $_POST['seriesAudioLanguages'], 
                                                     $_POST['seriesSubtitlesLanguages']);
                    }
                }

                if (!$sendData) {
            ?>
                    <div class="row">
                        <div class="col-12">
                            <h1>Editar serie</h1>
                        </div>
                        <div class="col-12">
                        <form name="create_series" action="" method="POST">
                                <div class="nb-3">
                                    <label for="seriesTitle" class="form-label">Título de la serie: </label>
                                    <input id="seriesTitle" name="seriesTitle" type="text" placeholder="Introduce el nombre de la serie" class="form-control" required value="<?php echo $seriesObject->getTitle(); ?>"/>
                                    <br>
                                    <label for="seriesPlatformId" class="form-label">Selecciona la plataforma: </label>
                                    <br>
                                    <select id="seriesPlatformId" name="seriesPlatformId" required >
                                        <?php
                                            $platformsList = listPlatforms();
                                            
                                            foreach ($platformsList as $platform) {
                                        ?>
                                                <option value="<?php echo $platform->getId()?>" <?php if ($platform->getId() == $seriesObject->getPlatform()->getId()) {echo "selected";} ?> > <?php echo $platform->getName() ?> </option>
                                        <?php 
                                            } 
                                        ?>
                                    </select>
                                    <br>
                                    <br>
                                    <label for="seriesDirectorId" class="form-label">Selecciona el director: </label>
                                    <br>  
                                    <select id="seriesDirectorId" name="seriesDirectorId" required>
                                        <?php
                                            $directorsList = listDirectors();
                                            
                                            foreach ($directorsList as $director) {
                                        ?>
                                                <option value="<?php echo $director->getId()?>" <?php if ($director->getId() == $seriesObject->getDirector()->getId()) {echo "selected";} ?> > <?php echo $director->getName() .' '. $director->getFirstSurname() .' '. $director->getSecondSurname() . " (" . $director->getDNI() . ")" ?> </option>
                                        <?php 
                                            } 
                                        ?>
                                    </select>  
                                    <br>
                                    <br>
                                    <label for="seriesActors[]" class="form-label">Selecciona los actores: </label>          
                                    <br>
                                    <?php
                                        $actorsList = listActors();

                                        foreach ($actorsList as $actor) {
                                    ?>
                                            <input type="checkbox" name="seriesActors[]" value="<?php echo $actor->getId() ?>" 
                                            <?php foreach ($seriesObject->getActors() as $actorObject) { 
                                                    if ($actor->getId() == $actorObject->getId()) { 
                                                        echo "checked"; 
                                                        break;
                                                    } 
                                                } ?> > 
                                            <?php echo $actor->getName() .' '. $actor->getFirstSurname() .' '. $actor->getSecondSurname() . " (" . $actor->getDNI() . ")" ?>
                                            <br>
                                    <?php 
                                        } 
                                    ?>
                                    <br>
                                    <label for="seriesAudioLanguages[]" class="form-label">Selecciona los idiomas disponibles en AUDIO: </label> 
                                    <br>
                                    <?php
                                        $languagesList = listLanguages();

                                        foreach ($languagesList as $language) {
                                    ?>
                                            <input type="checkbox" name="seriesAudioLanguages[]" value="<?php echo $language->getId() ?>"
                                            <?php foreach ($seriesObject->getAudioLanguages() as $languageObject) { 
                                                    if ($language->getId() == $languageObject->getId()) { 
                                                        echo "checked"; 
                                                        break;
                                                    } 
                                                } ?> >
                                            <?php echo $language->getName() . " (" . $language->getISO() . ")" ?>
                                            <br>
                                    <?php 
                                        } 
                                    ?>                                   
                                    <br>
                                    <label for="seriesSubtitlesLanguages[]" class="form-label">Selecciona los idiomas disponibles en SUBTITULOS: </label> 
                                    <br>
                                    <?php
                                        foreach ($languagesList as $language) {
                                    ?>
                                            <input type="checkbox" name="seriesSubtitlesLanguages[]" value="<?php echo $language->getId() ?>" 
                                            <?php foreach ($seriesObject->getSubtitlesLanguages() as $languageObject) { 
                                                    if ($language->getId() == $languageObject->getId()) { 
                                                        echo "checked"; 
                                                        break;
                                                    } 
                                                } ?> >
                                            <?php echo $language->getName() . " (" . $language->getISO() . ")" ?>
                                            <br>
                                    <?php 
                                        } 
                                    ?>                                   
                                    <br>
                                </div>
                                <input type="hidden" name="seriesId" value="<?php echo $idSeries; ?>"/>
                                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn"/>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    if ($seriesEdited) {
            ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Serie editada correctamente.<br><a href="list.php">Volver al listado de series.</a>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                La serie no se ha editado correctamente.<br><a href="edit.php?id=<?php echo $idSeries; ?>">Volver a intentarlo.</a>
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