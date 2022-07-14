<?php
    require_once('../../models/Series.php');
    require_once('../../utils/conexionBBDD.php');

    require_once('../../controllers/PlatformController.php');
    require_once('../../controllers/DirectorController.php');
    require_once('../../controllers/ActorController.php');
    require_once('../../controllers/LanguageController.php');

    function listSeries() {
        $mysqli = initConnectionDb();
        $series = new Series(1, "Juego de tronos", new Platform(1, "Netflix"), new Director(1, 'Alguien', 'Muy', 'Talentoso', 'dni', 'birth_date', 'nationality'), [new Actor(1, 'Alguien', 'Muy', 'Famoso', 'dni', 'birth_date', 'nationality'), new Actor(2, 'Alguien', 'Pocofamoso', 'perotalentoso', 'dni', 'birth_date', 'nationality')], [new Language(1, "Español", 'iso_code'), new Language(2, "Inglés", 'iso_code')], [new Language(1, "Español", 'iso_code'), new Language(2, "Inglés", 'iso_code')]);

        return [$series];
    }

    function storeSeries($seriesTitle, $seriesPlatformId, $seriesDirectorId, $actorsIdList, $audioLanguageIdList, $subtitlesLanguageIdList) {
        $mysqli = initConnectionDb();
        $mysqli->autocommit(false);

        $seriesCreated = true;

        //TODO: comprobar que no exista la serie.
        if (!$resultadoInsert = $mysqli->query(query: "INSERT INTO series (title, id_platform, id_director) values ('$seriesTitle', '$seriesPlatformId', '$seriesDirectorId')")) {
            return false;
        }

        $seriesIdObject = $mysqli->query(query: "SELECT MAX(ID) as id from series");
        foreach ($seriesIdObject as $seriesIdItem) {
            $seriesId = $seriesIdItem['id'];
            break;
        }

        foreach ($actorsIdList as $actorId) {
            if (!$resultadoInsert = $mysqli->query(query: "INSERT INTO performs (id_actor, id_series) values ($actorId, $seriesId)")) {
                return false;
            }
        }

        foreach ($audioLanguageIdList as $languageId) {
            if (!$resultadoInsert = $mysqli->query(query: "INSERT INTO audio_lang (id_language, id_series) values ($languageId, $seriesId)")) {
                return false;
            }
        }
        
        foreach ($subtitlesLanguageIdList as $languageId) {
            if (!$resultadoInsert = $mysqli->query(query: "INSERT INTO subtitles_lang (id_language, id_series) values ($languageId, $seriesId)")) {
                return false;
            }
        }

        $mysqli->commit();
        $mysqli->close();

        return $seriesCreated;
    }

    function updateSeries($seriesId) {
        $mysqli = initConnectionDb();
    }

    function getSeriesData($idSeries) {
        $mysqli = initConnectionDb();

        $seriesData = $mysqli->query(query: "SELECT * from series WHERE id=$idSeries");
        $seriesId = null;
        $seriesTitle = null;
        $platformId = null;
        $directorId = null;
        foreach ($seriesData as $seriesItem) {
            $seriesId = $seriesItem['id'];
            $seriesTitle =  $seriesItem['title'];
            $platformId = $seriesItem['id_platform'];
            $directorId = $seriesItem['id_director'];
            break;
        }

        $mysqli->close();

        $platformObject = getPlatformData($platformId);
        $directorObject = getDirectorData($directorId);

        $mysqli = initConnectionDb();

        $actorsList = $mysqli->query(query: "SELECT actors.id, actors.name, actors.first_surname, actors.second_surname, actors.dni, actors.birth_date, actors.nationality FROM series JOIN performs ON series.id = performs.id_series JOIN actors ON performs.id_actor = actors.id WHERE series.id = $seriesId;");
        $actorObjectArray = [];
        foreach ($actorsList as $actorItem) {
            $actorObject = new Actor($actorItem['id'], $actorItem['name'], $actorItem['first_surname'], $actorItem['second_surname'], $actorItem['dni'], $actorItem['birth_date'], $actorItem['nationality']);
            array_push($actorObjectArray, $actorObject);
        }

        $mysqli->close();

        $seriesObject = new Series($seriesId, $seriesTitle, $platformObject, $directorObject, $actorObjectArray, [], []);

        return $seriesObject;
    }

    function deleteSeries($seriesId) {
        $mysqli = initConnectionDb();
    }
?>