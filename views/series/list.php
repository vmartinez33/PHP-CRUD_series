<?php
    require_once('../../header.php');
    require_once('../../controllers/SeriesController.php');
?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Listado de series</h1>
                </div>
                <div class="col-6">
                    <a class="btn btn-primary" href="create.php">+ Crear serie</a>
                </div>
                <div class="col-12">
                    <?php
                        $seriesList = listSeries();

                        if (count($seriesList) > 0) {
                    ?>
                            <table class="table">
                                <thead>
                                    <th>Id</th>
                                    <th>Titulo</th>
                                    <th>Plataforma</th>
                                    <th>Director</th>
                                    <th>Actores</th>
                                    <th>Idiomas AUDIO</th>
                                    <th>Idiomas SUBTITULOS</th>
                                </thead>
                                <tbody>
                    <?php
                                    foreach ($seriesList as $series) {
                                        $platform = $series->getPlatform();
                                        $director = $series->getDirector();
                                        $actorsList = $series->getActors();
                                        $audioLanguages = $series->getAudioLanguages();
                                        $subtitlesLanguages = $series->getSubtitlesLanguages();
                    ?>
                                        <tr>
                                            <td><?php echo $series->getId(); ?></td>
                                            <td><?php echo $series->getTitle(); ?></td>
                                            <td><?php echo $platform->getName(); ?></td>
                                            <td><?php echo $director->getName() . " " . $director->getFirstSurname() . " " . $director->getSecondSurname() . " (" . $director->getDNI() . ")"; ?></td>
                                            <td>
                                                <?php 
                                                    foreach($actorsList as $actor) {
                                                        echo $actor->getName() . " " . $actor->getFirstSurname() . " " . $actor->getSecondSurname() . " (" . $actor->getDNI() . ")";
                                                ?>
                                                    <br>
                                                <?php 
                                                    } 
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    foreach($audioLanguages as $language) {
                                                        echo $language->getName() . " (" . $language->getISO() . ")";
                                                ?>
                                                    <br>
                                                <?php 
                                                    } 
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    foreach($subtitlesLanguages as $language) {
                                                        echo $language->getName() . " (" . $language->getISO() . ")";
                                                ?>
                                                    <br>
                                                <?php 
                                                    } 
                                                ?>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a class="btn btn-success" href="edit.php?id=<?php echo $series->getId(); ?>">Editar</a>

                                                    <form name="delete_series" action="delete.php" method="POST">
                                                        <input type="hidden" name="seriesId" value="<?php echo $series->getId(); ?>" />
                                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                    <?php
                                    }
                    ?>
                                </tbody>
                            </table>
                    <?php
                        } else {
                    ?>
                            <div class="alert alert-warning" role="alert">
                                Aún no existen series.
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
<?php 
require_once('../../footer.php');
?>