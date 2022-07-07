<?php
    require_once('../models/Actor.php');

    function initConnectionDb() {
        $db_host = 'localhost';
        $db_user = 'root';
        $db_password = 'root';
        $db_db = 'bibliotecaseries';

        $mysqli = @new mysqli(
            $db_host,
            $db_user,
            $db_password,
            $db_db
        );

        if ($mysqli->connect_error) {
            die('Error: '.$mysqli->connect_error);
        }

        return $mysqli;
    }

    function listActors() {
        $mysqli = initConnectionDb();
        $actorList = $mysqli->query(query: "SELECT * FROM actors");

        $actorObjectArray = [];
        foreach ($actorList as $actorItem) {
            $actorObject = new Actor($actorItem['id'], $actorItem['name'], $actorItem['first_surname'], $actorItem['second_surname'], $actorItem['dni'], $actorItem['birth_date'], $actorItem['nationality']);
            array_push($actorObjectArray, $actorObject);
        }
        $mysqli->close();

        return $actorObjectArray;
    }

    function storeActor($actorName, $actorFirstSurname, $actorSecondSurname, $actorDNI, $actorBirthDate, $actorNationality) {
        $mysqli = initConnectionDb();

        $actorCreated = false;
        //TODO: comprobar que no exista un actor con el mismo DNI.
        if ($resultadoInsert = $mysqli->query(query: "INSERT INTO actors (name, first_surname, second_surname, dni, birth_date, nationality) values ('$actorName', '$actorFirstSurname', '$actorSecondSurname', '$actorDNI', '$actorBirthDate', '$actorNationality')")) {
            $actorCreated = true;
        }   
        $mysqli->close();

        return $actorCreated;
    }

    function updateActor($actorId, $actorName, $actorFirstSurname, $actorSecondSurname, $actorDNI, $actorBirthDate, $actorNationality) {
        $mysqli = initConnectionDb();

        $actorEdited = false;

        if ($resultadoUpdate = $mysqli->query(query: "UPDATE actors set name = '$actorName', first_surname = '$actorFirstSurname', second_surname = '$actorSecondSurname', dni = '$actorDNI', birth_date = '$actorBirthDate', nationality = '$actorNationality' where id = $actorId")) {
            $actorEdited = true;
        }

        $mysqli->close();

        return $actorEdited;
    }

    function getActorData($idActor) {
        $mysqli = initConnectionDb();
        $actorData = $mysqli->query(query: "SELECT * FROM actors WHERE id=$idActor");

        $actorObject = null;
        foreach ($actorData as $actorItem) {
            $actorObject = new Actor($actorItem['id'], $actorItem['name'], $actorItem['first_surname'], $actorItem['second_surname'], $actorItem['dni'], $actorItem['birth_date'], $actorItem['nationality']);
            break;
        }
        $mysqli->close();

        return $actorObject;
    }

    function deleteActor($actorId) {
        $mysqli = initConnectionDb();

        $actorDeleted = false;

        if ($resultado = $mysqli->query(query: "DELETE FROM actors where id = $actorId")) {
            $actorDeleted = true;
        }

        $mysqli->close();

        return $actorDeleted;
    }
?>