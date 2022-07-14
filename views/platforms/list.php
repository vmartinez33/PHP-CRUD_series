<?php
    require_once('../../header.php');
    require_once('../../controllers/PlatformController.php');
?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Listado de plataformas</h1>
                </div>
                <div class="col-6">
                    <a class="btn btn-primary" href="create.php">+ Crear plataforma</a>
                </div>
                <div class="col-12">
                    <?php
                        $platformList = listPlatforms();

                        if (count($platformList) > 0) {
                    ?>
                            <table class="table">
                                <thead>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                    <?php
                                    foreach ($platformList as $platform) {
                    ?>
                                        <tr>
                                            <td><?php echo $platform->getId(); ?></td>
                                            <td><?php echo $platform->getName(); ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a class="btn btn-success" href="edit.php?id=<?php echo $platform->getId(); ?>">Editar</a>

                                                    <form name="delete_platform" action="delete.php" method="POST">
                                                        <input type="hidden" name="platformId" value="<?php echo $platform->getId(); ?>" />
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
                                Aún no existen plataformas.
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




