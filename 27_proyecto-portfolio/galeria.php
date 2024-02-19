<?php include("header.php"); ?> <!-- Incluyengo header -->
<br/>
<?php include("conexion.php"); ?> <!-- Incluyendo conexión -->
<br/>

<?php
// Procesa el formulario cuando se envía (método POST)
if ($_POST) {
    // Imprime los datos del formulario (puedes eliminar esta línea en producción)
    //print_r($_POST);

    // Obtiene la fecha actual
    $fecha = new DateTime();

    // Obtiene los valores del formulario
    $nombre = $_POST['nombre'];
    $imagen = $fecha->getTimestamp() . "_" . $_FILES['archivo']['name'];//Sumamos tiempo para saber cuando fue subido el archivo que suba
    $descripcion = $_POST['descripcion'];

    // Ruta temporal del archivo subido
    $imagen_temporal = $_FILES['archivo']['tmp_name']; //Recepciona el archivo File con el nombre que esta en formulario 

    // Mueve el archivo a la carpeta de imágenes
    move_uploaded_file($imagen_temporal, "imagenes/" . $imagen);

    // Crea una instancia de la clase 'conexion'
    $objConexion = new conexion();

    // Crea la consulta SQL para insertar un nuevo proyecto en la base de datos
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";

    // Ejecuta la consulta SQL
    $objConexion->ejecutar($sql);

    // Redirecciona a la página de la galería después de la inserción
    header("location:galeria.php");
}

// Procesa la eliminación de un proyecto cuando se recibe un parámetro GET
if ($_GET) {
    // Obtiene el ID del proyecto a borrar
    $id = $_GET['borrar'];

    // Crea una instancia de la clase 'conexion'
    $objConexion = new conexion();

    // Obtiene el nombre de la imagen asociada al proyecto
    $imagen = $objConexion->consultar("SELECT imagen FROM `proyectos` WHERE id=" . $id);

    // Elimina físicamente la imagen del servidor
    unlink("imagenes/" . $imagen[0]['imagen']);

    // Crea la consulta SQL para eliminar el proyecto de la base de datos
    $sql = "DELETE FROM `proyectos` WHERE `proyectos`.`id` =" . $id;

    // Ejecuta la consulta SQL
    $objConexion->ejecutar($sql);

    // Redirecciona a la página de la galería después de la eliminación
    header("location:galeria.php");
}

// Obtiene todos los proyectos de la base de datos
$objConexion = new conexion();
$resultado = $objConexion->consultar("SELECT * FROM `proyectos`");
?>

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Datos del proyecto
                </div>
                <div class="card-body">
                    <!-- Formulario para agregar un nuevo proyecto -->
                    <form action="galeria.php" method="post" enctype="multipart/form-data">
                        <!-- Campos del formulario -->
                        <label for="nombre">Nombre del Proyecto:</label>
                        <input type="text" class="form-control" name="nombre" required><br/>
                        <label for="archivo">Imagen del proyecto:</label>
                        <input type="file" class="form-control" name="archivo" required><br/>
                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion" class="form-control" rows="3" required></textarea><br/><br/>

                        <!-- Botón para enviar el formulario -->
                        <input type="submit" class="btn btn-success" value="Enviar proyecto">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <!-- Tabla que muestra los proyectos existentes -->
            <div class="table-responsive">
                <table class="table table-secondary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Itera sobre los resultados y muestra cada proyecto en una fila de la tabla -->
                        <?php foreach ($resultado as $proyecto) { ?>
                            <tr>
                                <td scope="row"><?php echo $proyecto['id']; ?></td>
                                <td><?php echo $proyecto['nombre']; ?></td>
                                <td>
                                    <?php echo $proyecto['imagen']; ?>
                                    <br/>
                                    <!-- Muestra la imagen asociada al proyecto -->
                                    <img src="imagenes/<?php echo $proyecto['imagen']; ?>" 
                                        alt="<?php echo $proyecto['imagen'];?>"
                                        width="150">
                                </td>
                                <td><?php echo $proyecto['descripcion'] ?></td>
                                <!-- Enlace para eliminar el proyecto -->
                                <td> <a href="?borrar=<?php echo $proyecto['id']; ?>" class="btn btn-danger" 
                                        role="button">Eliminar</a> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>