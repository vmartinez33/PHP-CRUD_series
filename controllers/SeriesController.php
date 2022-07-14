<?php
    require_once('../../models/Series.php');
    require_once('../../utils/utils.php');

    require_once('../../controllers/PlatformController.php');
    require_once('../../controllers/DirectorController.php');
    require_once('../../controllers/ActorController.php');
    require_once('../../controllers/LanguageController.php');

    function listSeries() {
        $mysqli = initConnectionDb();
        // $series = new Series(1, "Juego de tronos", new Platform(1, "Netflix"), new Director(1, 'Alguien', 'Muy', 'Talentoso', 'dni', 'birth_date', 'nationality'), [new Actor(1, 'Alguien', 'Muy', 'Famoso', 'dni', 'birth_date', 'nationality'), new Actor(2, 'Alguien', 'Pocofamoso', 'perotalentoso', 'dni', 'birth_date', 'nationality')], [new Language(1, "Español", 'iso_code'), new Language(2, "Inglés", 'iso_code')], [new Language(1, "Español", 'iso_code'), new Language(2, "Inglés", 'iso_code')]);

        $seriesList = $mysqli->query(query: "SELECT * FROM series");

        $seriesObjectArray = [];
        foreach ($seriesList as $seriesItem) {
            $seriesId = $seriesItem['id'];
            $otherData = getOtherSeriesData($seriesId, $seriesItem['id_platform'], $seriesItem['id_director']);
            $seriesObject = new Series($seriesId, $seriesItem['title'], $otherData['platform'], $otherData['director'], $otherData['actors'], $otherData['audioLanguages'], $otherData['subtitlesLanguages']);
            array_push($seriesObjectArray, $seriesObject);
        }

        $mysqli->close();

        return $seriesObjectArray;
    }

    function storeSeries($seriesTitle, $seriesPlatformId, $seriesDirectorId, $actorsIdList, $audioLanguageIdList, $subtitlesLanguageIdList) {
        $mysqli = initConnectionDb();
        $mysqli->autocommit(false);

        $seriesCreated = true;
        
        //TODO: comprobar que no exista la serie.
        $resultadoInsert = $mysqli->query(query: "SELECT * FROM series WHERE title = '$seriesTitle'");
        if ($resultadoInsert->num_rows > 0) {
            return false;
        } 
        
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

    function updateSeries($seriesId, $seriesTitle, $seriesPlatformId, $seriesDirectorId, $actorsIdList, $audioLanguageIdList, $subtitlesLanguageIdList) {
        $mysqli = initConnectionDb();
        $mysqli->autocommit(false);

        $seriesEdited = true;

        if (!$resultadoUpdate = $mysqli->query(query: "UPDATE series set title = '$seriesTitle', id_platform = $seriesPlatformId, id_director = $seriesDirectorId where id = $seriesId")) {
            return false;
        }

        if (!updateManyToManyTable($mysqli, $seriesId, "performs", "id_actor", $actorsIdList)) {
            return false;
        }

        if (!updateManyToManyTable($mysqli, $seriesId, "audio_lang", "id_language", $audioLanguageIdList)) {
            return false;
        }

        if (!updateManyToManyTable($mysqli, $seriesId, "subtitles_lang", "id_language", $subtitlesLanguageIdList)) {
            return false;
        }

        $mysqli->commit();
        $mysqli->close();

        return $seriesEdited;
    }

    function updateManyToManyTable($mysqli, $seriesId, $tableName, $idName, $newIdList) {

        $idQuery = $mysqli->query(query: "SELECT $idName FROM $tableName WHERE id_series = $seriesId");
        $oldIdList = [];
        foreach ($idQuery as $idItem) {
            $id = $idItem[$idName];
            array_push($oldIdList, $id);
        }

        $idToInsert = [];
        foreach ($newIdList as $newId) {
            if (!in_array($newId, $oldIdList)) {
                array_push($idToInsert, $newId);
            }
        }
        
        $idToDelete = [];
        foreach($oldIdList as $oldId) {
            if (!in_array($oldId, $newIdList)) {
                array_push($idToDelete, $oldId);
            }
        }

        foreach ($idToInsert as $id) {
            if (!$resultadoInsert = $mysqli->query(query: "INSERT INTO $tableName ($idName, id_series) values ($id, $seriesId)")) {
                return false;
            }
        }

        foreach ($idToDelete as $id) {
            if (!$resultadoDelete = $mysqli->query(query: "DELETE FROM $tableName WHERE $idName = $id AND id_series = $seriesId")) {
                return false;
            }       
        }

        return true;
    }

    function getSeriesData($idSeries) {
        $mysqli = initConnectionDb();

        $seriesData = $mysqli->query(query: "SELECT * from series WHERE id=$idSeries");

        $seriesObject = null;
        foreach ($seriesData as $seriesItem) {
            $seriesId = $seriesItem['id'];
            $otherData = getOtherSeriesData($seriesId, $seriesItem['id_platform'], $seriesItem['id_director']);
            $seriesObject = new Series($seriesId, $seriesItem['title'], $otherData['platform'], $otherData['director'], $otherData['actors'], $otherData['audioLanguages'], $otherData['subtitlesLanguages']);
            break;
        }

        $mysqli->close();

        return $seriesObject;
    }

    function deleteSeries($seriesId) {
        $mysqli = initConnectionDb();
        $mysqli->autocommit(false);

        $seriesDeleted = true;

        if (!$resultado = $mysqli->query(query: "DELETE FROM performs where id_series = $seriesId")) {
            return false;
        }

        if (!$resultado = $mysqli->query(query: "DELETE FROM audio_lang where id_series = $seriesId")) {
            return false;
        }

        if (!$resultado = $mysqli->query(query: "DELETE FROM subtitles_lang where id_series = $seriesId")) {
            return false;
        }

        if (!$resultado = $mysqli->query(query: "DELETE FROM series where id = $seriesId")) {
            return false;
        }

        $mysqli->commit();
        $mysqli->close();

        return $seriesDeleted;
    }

    function getOtherSeriesData($seriesId, $platformId, $directorId) {
        $platformObject = getPlatformData($platformId);
        $directorObject = getDirectorData($directorId);

        $mysqli = initConnectionDb();

        $actorsList = $mysqli->query(query: "SELECT actors.id, actors.name, actors.first_surname, actors.second_surname, actors.dni, actors.birth_date, actors.nationality FROM series JOIN performs ON series.id = performs.id_series JOIN actors ON performs.id_actor = actors.id WHERE series.id = $seriesId;");
        $actorObjectArray = [];
        foreach ($actorsList as $actorItem) {
            $actorObject = new Actor($actorItem['id'], $actorItem['name'], $actorItem['first_surname'], $actorItem['second_surname'], $actorItem['dni'], $actorItem['birth_date'], $actorItem['nationality']);
            array_push($actorObjectArray, $actorObject);
        }

        $audioLanguagesList = $mysqli->query(query: "SELECT languages.id, languages.name, languages.iso_code FROM series JOIN audio_lang ON series.id = audio_lang.id_series JOIN languages ON audio_lang.id_language = languages.id WHERE series.id = $seriesId;");
        $audioLanguagesObjectArray = [];
        foreach ($audioLanguagesList as $languageItem) {
            $languageObject = new Language($languageItem['id'], $languageItem['name'], $languageItem['iso_code']);
            array_push($audioLanguagesObjectArray, $languageObject);
        }

        $subtitlesLanguagesList = $mysqli->query(query: "SELECT languages.id, languages.name, languages.iso_code FROM series JOIN subtitles_lang ON series.id = subtitles_lang.id_series JOIN languages ON subtitles_lang.id_language = languages.id WHERE series.id = $seriesId;");
        $subtitlesLanguagesObjectArray = [];
        foreach ($subtitlesLanguagesList as $languageItem) {
            $languageObject = new Language($languageItem['id'], $languageItem['name'], $languageItem['iso_code']);
            array_push($subtitlesLanguagesObjectArray, $languageObject);
        }

        $mysqli->close();

        $dataObject = array("platform" => $platformObject, "director" => $directorObject, "actors" => $actorObjectArray, 
                            "audioLanguages" => $audioLanguagesObjectArray, "subtitlesLanguages" => $subtitlesLanguagesObjectArray);

        return $dataObject;
    }
?>