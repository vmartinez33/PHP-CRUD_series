<?php
    require_once('../../header.php');
    require_once('../../controllers/DirectorController.php');
?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Listado de directores</h1>
                </div>
                <div class="col-6">
                    <a class="btn btn-primary" href="create.php">+ Crear director</a>
                </div>
                <div class="col-12">
                    <?php
                        $directorList = listDirectors();

                        if (count($directorList) > 0) {
                    ?>
                            <table class="table">
                                <thead>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Primer apellido</th>
                                    <th>Segundo apellido</th>
                                    <th>DNI</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Nacionalidad</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                    <?php
                                    foreach ($directorList as $director) {
                    ?>
                                        <tr>
                                            <td><?php echo $director->getId(); ?></td>
                                            <td><?php echo $director->getName(); ?></td>
                                            <td><?php echo $director->getFirstSurname(); ?></td>
                                            <td><?php echo $director->getSecondSurname(); ?></td>
                                            <td><?php echo $director->getDNI(); ?></td>
                                            <td><?php echo $director->getBirthDate(); ?></td>
                                            <td><?php echo $director->getNationality(); ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a class="btn btn-success" href="edit.php?id=<?php echo $director->getId(); ?>">Editar</a>

                                                    <form name="delete_director" action="delete.php" method="POST">
                                                        <input type="hidden" name="directorId" value="<?php echo $director->getId(); ?>" />
                                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                    <?php
                                    }
                    ?>
                                </tbody>
                            </table>
                    <?php
                        } else {
                    ?>
                            <div class="alert alert-warning" role="alert">
                                Aún no existen directores.
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
<?php 
    require_once('../../footer.php');
?>