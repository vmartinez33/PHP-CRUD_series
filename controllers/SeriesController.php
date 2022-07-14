<?php
    require_once('../../models/Actor.php');
    require_once('../../utils/conexionBBDD.php');

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
?>