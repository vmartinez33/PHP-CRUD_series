<?php
    require_once('../../models/Director.php');
    require_once('../../utils/conexionBBDD.php');

    function listDirectors() {
        $mysqli = initConnectionDb();
        $directorList = $mysqli->query(query: "SELECT id, name, first_surname, second_surname, dni, DATE_FORMAT(birth_date, '%d/%m/%Y') as birth_date, nationality FROM directors");

        $directorObjectArray = [];
        foreach ($directorList as $directorItem) {
            $directorObject = new Director($directorItem['id'], $directorItem['name'], $directorItem['first_surname'], $directorItem['second_surname'], $directorItem['dni'], $directorItem['birth_date'], $directorItem['nationality']);
            array_push($directorObjectArray, $directorObject);
        }
        $mysqli->close();

        return $directorObjectArray;
    }

    function storeDirector($directorName, $directorFirstSurname, $directorSecondSurname, $directorDNI, $directorBirthDate, $directorNationality) {
        $mysqli = initConnectionDb();

        $directorCreated = false;
        //TODO: comprobar que no exista un actor con el mismo DNI.
        if ($resultadoInsert = $mysqli->query(query: "INSERT INTO directors (name, first_surname, second_surname, dni, birth_date, nationality) values ('$directorName', '$directorFirstSurname', '$directorSecondSurname', '$directorDNI', STR_TO_DATE('$directorBirthDate', '%d/%m/%Y'), '$directorNationality')")) {
            $directorCreated = true;
        }   
        $mysqli->close();

        return $directorCreated;
    }

    function updateDirector($directorId, $directorName, $directorFirstSurname, $directorSecondSurname, $directorDNI, $directorBirthDate, $directorNationality) {
        $mysqli = initConnectionDb();

        $directorEdited = false;

        if ($resultadoUpdate = $mysqli->query(query: "UPDATE directors set name = '$directorName', first_surname = '$directorFirstSurname', second_surname = '$directorSecondSurname', dni = '$directorDNI', birth_date = STR_TO_DATE('$directorBirthDate', '%d/%m/%Y'), nationality = '$directorNationality' where id = $directorId")) {
            $directorEdited = true;
        }

        $mysqli->close();

        return $directorEdited;
    }

    function getDirectorData($idDirector) {
        $mysqli = initConnectionDb();
        $directorData = $mysqli->query(query: "SELECT * FROM directors WHERE id=$idDirector");

        $directorObject = null;
        foreach ($directorData as $directorItem) {
            $directorObject = new Director($directorItem['id'], $directorItem['name'], $directorItem['first_surname'], $directorItem['second_surname'], $directorItem['dni'], $directorItem['birth_date'], $directorItem['nationality']);
            break;
        }
        $mysqli->close();

        return $directorObject;
    }

    function deleteDirector($directorId) {
        $mysqli = initConnectionDb();

        $directorDeleted = false;

        if ($resultado = $mysqli->query(query: "DELETE FROM directors where id = $directorId")) {
            $directorDeleted = true;
        }

        $mysqli->close();

        return $directorDeleted;
    }
?>