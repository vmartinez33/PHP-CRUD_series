<?php
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
?>