<?php
    require_once('../../header.php');
    require_once('../../controllers/DirectorController.php');
?>
    <body>
        <div class="container">
            <?php
                $sendData = false;
                $directorCreated = false;

                if(isset($_POST['createBtn'])) {
                    $sendData = true;
                }

                if($sendData) {
                    $condition = isset($_POST['directorName']) && isset($_POST['directorFirstSurname']) && isset($_POST['directorSecondSurname']) && 
                                 isset($_POST['directorDNI']) && isset($_POST['directorBirthDate']) && isset($_POST['directorNationality']);
                    if($condition) {
                        $directorCreated = storeDirector(
                            $_POST['directorName'], $_POST['directorFirstSurname'], $_POST['directorSecondSurname'], $_POST['directorDNI'], 
                            $_POST['directorBirthDate'], $_POST['directorNationality']
                        );
                    }
                }

                if(!$sendData) {
            ?>
                    <div class="row">
                        <div>
                            <h1>Crear director</h1>
                        </div>
                        <div class="col-12">
                            <form name="create_director" action="" method="POST">
                                <div class="nb-3">
                                    <label for="directorName" class="form-label">Nombre director</label>
                                    <input id="directorName" name="directorName" type="text" placeholder="Introduce el nombre del director" class="form-control" required />
                                    <label for="directorFirstSurname" class="form-label">Primero apellido</label>
                                    <input id="directorFirstSurname" name="directorFirstSurname" type="text" placeholder="Introduce el primer apellido del director" class="form-control" required />
                                    <label for="directorSecondSurname" class="form-label">Segundo apellido</label>
                                    <input id="directorSecondSurname" name="directorSecondSurname" type="text" placeholder="Introduce el segundo apellido del director" class="form-control" required />
                                    <label for="directorDNI" class="form-label">DNI</label>
                                    <input id="directorDNI" name="directorDNI" type="text" placeholder="Introduce el DNI del director" class="form-control" required />
                                    <label for="directorBirthDate" class="form-label">Fecha de nacimiento</label>
                                    <input id="directorBirthDate" name="directorBirthDate" type="text" placeholder="dd/mm/yyyy" class="form-control" required />
                                    <label for="directorNationality" class="form-label">Nacionalidad</label>
                                    <input id="directorNationality" name="directorNationality" type="text" placeholder="Introduce la nacionalidad del director" class="form-control" required />
                                </div>
                                <input type="submit" value="Crear" class="btn btn-primary" name="createBtn"/>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    if($directorCreated) {
            ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Director creado correctamente.<br><a href="list.php">Volver al listado de directores.</a>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                El director no se ha creado correctamente.<br><a href="create.php">Volver a intentarlo.</a>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </body>
<?php 
    require_once('../../footer.php');
?>