<?php
    require_once('../../controllers/ActorController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editar actor</title>
    </head>
    <body>
        <div class="container">
            <?php
                $idActor = $_GET['id'];
                $actorObject = getActorData($idActor);

                $sendData = false;
                $actorEdited = false;

                if (isset($_POST['editBtn'])) {
                    $sendData = true;
                }

                if($sendData) {
                    $condition = isset($_POST['actorName']) && isset($_POST['actorFirstSurname']) && isset($_POST['actorSecondSurname']) && 
                                 isset($_POST['actorDNI']) && isset($_POST['actorBirthDate']) && isset($_POST['actorNationality']);
                    if($condition) {
                        $actorEdited = updateActor(
                            $_POST['actorId'], $_POST['actorName'], $_POST['actorFirstSurname'], $_POST['actorSecondSurname'], 
                            $_POST['actorDNI'], $_POST['actorBirthDate'], $_POST['actorNationality']
                        );
                    }
                }

                if (!$sendData) {
            ?>
                    <div class="row">
                        <div class="col-12">
                            <h1>Editar actor</h1>
                        </div>
                        <div class="col-12">
                            <form name="create_actor" action="" method="POST">
                                <div class="nb-3">
                                    <label for="actorName" class="form-label">Nombre actor</label>
                                    <input id="actorName" name="actorName" type="text" placeholder="Introduce el nombre del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getName(); ?>"/>
                                    <label for="actorFirstSurname" class="form-label">Primer apellido</label>
                                    <input id="actorFirstSurname" name="actorFirstSurname" type="text" placeholder="Introduce el primer apellido del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getFirstSurname(); ?>"/>
                                    <label for="actorSecondSurname" class="form-label">Segundo apellido</label>
                                    <input id="actorSecondSurname" name="actorSecondSurname" type="text" placeholder="Introduce el segundo apellido del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getSecondSurname(); ?>"/>
                                    <label for="actorDNI" class="form-label">DNI</label>
                                    <input id="actorDNI" name="actorDNI" type="text" placeholder="Introduce el DNI del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getDNI(); ?>"/>
                                    <label for="actorBirthDate" class="form-label">Fecha de nacimiento</label>
                                    <input id="actorBirthDate" name="actorBirthDate" type="text" placeholder="YYYY-MM-DD" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getBirthDate(); ?>"/>
                                    <label for="actorNationality" class="form-label">Nacionalidad</label>
                                    <input id="actorNationality" name="actorNationality" type="text" placeholder="Introduce la nacionalidad del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getNationality(); ?>"/>
                                    <input type="hidden" name="actorId" value="<?php echo $idActor; ?>"/>
                                </div>
                                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn"/>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    if ($actorEdited) {
            ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Actor editado correctamente.<br><a href="list.php">Volver al listado de actores.</a>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                El actor no se ha editado correctamente.<br><a href="edit.php?id=<?php echo $idActor; ?>">Volver a intentarlo.</a>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </body>
</html>