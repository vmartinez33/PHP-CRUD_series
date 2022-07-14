<?php
    require_once('../../models/Language.php');
    require_once('../../utils/utils.php');

    function listLanguages() {
        $mysqli = initConnectionDb();
        $languageList = $mysqli->query(query: "SELECT * FROM languages");

        $languageObjectArray = [];
        foreach ($languageList as $languageItem) {
            $languageObject = new Language($languageItem['id'], $languageItem['name'], $languageItem['iso_code']);
            array_push($languageObjectArray, $languageObject);
        }
        $mysqli->close();

        return $languageObjectArray;
    }

    function storeLanguage($languageName, $languageISO) {
        $mysqli = initConnectionDb();

        $languageCreated = false;

        //TODO: comprobar que no exista un idioma con el mismo ISO code.
        $resultadoInsert = $mysqli->query(query: "SELECT * FROM languages WHERE iso_code = '$languageISO'");
        if ($resultadoInsert->num_rows > 0) {
            return false;
        } 

        if ($resultadoInsert = $mysqli->query(query: "INSERT INTO languages (name, iso_code) values ('$languageName', '$languageISO')")) {
            $languageCreated = true;
        }   
        $mysqli->close();

        return $languageCreated;
    }

    function updateLanguage($languageId, $languageName, $languageISO) {
        $mysqli = initConnectionDb();

        $languageEdited = false;

        if ($resultadoUpdate = $mysqli->query(query: "UPDATE languages set name = '$languageName', iso_code = '$languageISO' where id = $languageId")) {
            $languageEdited = true;
        }

        $mysqli->close();

        return $languageEdited;
    }

    function getLanguageData($idLanguage) {
        $mysqli = initConnectionDb();
        $languageData = $mysqli->query(query: "SELECT * FROM languages WHERE id=$idLanguage");

        $languageObject = null;
        foreach ($languageData as $languageItem) {
            $languageObject = new Language($languageItem['id'], $languageItem['name'], $languageItem['iso_code']);
            break;
        }
        $mysqli->close();

        return $languageObject;
    }

    function deleteLanguage($languageId) {
        $mysqli = initConnectionDb();

        $languageDeleted = false;

        if ($resultado = $mysqli->query(query: "DELETE FROM languages where id = $languageId")) {
            $languageDeleted = true;
        }

        $mysqli->close();

        return $languageDeleted;
    }
?>