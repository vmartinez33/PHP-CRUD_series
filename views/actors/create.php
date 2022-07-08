<?php
    require_once('../../controllers/ActorController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crear actor</title>
    </head>
    <body>
        <div class="container">
            <?php
                $sendData = false;
                $actorCreated = false;

                if(isset($_POST['createBtn'])) {
                    $sendData = true;
                }

                if($sendData) {
                    $condition = isset($_POST['actorName']) && isset($_POST['actorFirstSurname']) && isset($_POST['actorSecondSurname']) && 
                                 isset($_POST['actorDNI']) && isset($_POST['actorBirthDate']) && isset($_POST['actorNationality']);
                    if($condition) {
                        $actorCreated = storeActor(
                            $_POST['actorName'], $_POST['actorFirstSurname'], $_POST['actorSecondSurname'], $_POST['actorDNI'], 
                            $_POST['actorBirthDate'], $_POST['actorNationality']
                        );
                    }
                }

                if(!$sendData) {
            ?>
                    <div class="row">
                        <div>
                            <h1>Crear actor</h1>
                        </div>
                        <div class="col-12">
                            <form name="create_actor" action="" method="POST">
                                <div class="nb-3">
                                    <label for="actorName" class="form-label">Nombre actor</label>
                                    <input id="actorName" name="actorName" type="text" placeholder="Introduce el nombre del actor" class="form-control" required />
                                    <label for="actorFirstSurname" class="form-label">Primero apellido</label>
                                    <input id="actorFirstSurname" name="actorFirstSurname" type="text" placeholder="Introduce el primer apellido del actor" class="form-control" required />
                                    <label for="actorSecondSurname" class="form-label">Segundo apellido</label>
                                    <input id="actorSecondSurname" name="actorSecondSurname" type="text" placeholder="Introduce el segundo apellido del actor" class="form-control" required />
                                    <label for="actorDNI" class="form-label">DNI</label>
                                    <input id="actorDNI" name="actorDNI" type="text" placeholder="Introduce el DNI del actor" class="form-control" required />
                                    <label for="actorBirthDate" class="form-label">Fecha de nacimiento</label>
                                    <input id="actorBirthDate" name="actorBirthDate" type="text" placeholder="YYYY-MM-DD" class="form-control" required />
                                    <label for="actorNationality" class="form-label">Nacionalidad</label>
                                    <input id="actorNationality" name="actorNationality" type="text" placeholder="Introduce la nacionalidad del actor" class="form-control" required />
                                </div>
                                <input type="submit" value="Crear" class="btn btn-primary" name="createBtn"/>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    if($actorCreated) {
            ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Actor creado correctamente.<br><a href="list.php">Volver al listado de actores.</a>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                El actor no se ha creado correctamente.<br><a href="create.php">Volver a intentarlo.</a>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </body>
</html>