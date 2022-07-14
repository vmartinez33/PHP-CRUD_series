<?php
    require_once('../../header.php');
    require_once('../../controllers/PlatformController.php');
    require_once('../../controllers/DirectorController.php');
    require_once('../../controllers/ActorController.php');
    require_once('../../controllers/LanguageController.php');
    require_once('../../controllers/SeriesController.php');
?>
    <body>
        <div class="container">
            <?php
                $sendData = false;
                $seriesCreated = false;

                if(isset($_POST['createBtn'])) {
                    $sendData = true;
                }

                if($sendData) {
                    $condition = isset($_POST['seriesTitle']) && isset($_POST['seriesPlatformId']) && isset($_POST['seriesDirectorId']) && isset($_POST['seriesActors']) && isset($_POST['seriesAudioLanguages']) && isset($_POST['seriesSubtitlesLanguages']);
                    if($condition) {
                        $seriesCreated = storeSeries($_POST['seriesTitle'], $_POST['seriesPlatformId'], $_POST['seriesDirectorId'], 
                                                $_POST['seriesActors'], $_POST['seriesAudioLanguages'], $_POST['seriesSubtitlesLanguages']);
                    }
                }

                if(!$sendData) {
            ?>
                    <div class="row">
                        <div>
                            <h1>Crear serie</h1>
                        </div>
                        <div class="col-12">
                            <form name="create_series" action="" method="POST">
                                <div class="nb-3">
                                    <label for="seriesTitle" class="form-label">Título de la serie: </label>
                                    <input id="seriesTitle" name="seriesTitle" type="text" placeholder="Introduce el nombre de la serie" class="form-control" required />
                                    <br>
                                    <label for="seriesPlatformName" class="form-label">Selecciona la plataforma: </label>
                                    <br>
                                    <select id="seriesPlatformId" name="seriesPlatformId" required>
                                        <?php
                                            $platformsList = listPlatforms();
                                            
                                            foreach ($platformsList as $platform) {
                                        ?>
                                                <option value="<?php echo $platform->getId()?>"> <?php echo $platform->getName() ?> </option>
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
                                                <option value="<?php echo $director->getId()?>"> <?php echo $director->getName() .' '. $director->getFirstSurname() .' '. $director->getSecondSurname() ?> </option>
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
                                            <input type="checkbox" name="seriesActors[]" value="<?php echo $actor->getId() ?>"> <?php echo $actor->getName() .' '. $actor->getFirstSurname() .' '. $actor->getSecondSurname() ?>
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
                                            <input type="checkbox" name="seriesAudioLanguages[]" value="<?php echo $language->getId() ?>"> <?php echo $language->getName() ?>
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
                                            <input type="checkbox" name="seriesSubtitlesLanguages[]" value="<?php echo $language->getId() ?>"> <?php echo $language->getName() ?>
                                            <br>
                                    <?php 
                                        } 
                                    ?>                                   
                                    <br>
                                </div>
                                <input type="submit" value="Crear" class="btn btn-primary" name="createBtn"/>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    if($seriesCreated) {
            ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Serie creada correctamente.<br><a href="list.php">Volver al listado de series.</a>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                La serie no se ha creado correctamente.<br><a href="create.php">Volver a intentarlo.</a>
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