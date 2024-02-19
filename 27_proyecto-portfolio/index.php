<?php include("header.php"); ?>
<?php include("conexion.php"); ?>

<?php
 
  $objConexion= new conexion();
  $proyectos=$objConexion->consultar("SELECT * FROM `proyectos`");

?>

    
    <br/><hr/><br/>
    <div>
       <h2>Mi Portfolio</h2> 
    </div>

    <div class="p-5 bg-light">
        <div class="container">
            <h2 class="display-3">Bienveni@</h2>
            <p class="lead">Este es un Portafolio privado</p>
            <hr class="my-2">
            <p>En este proyecto pequeño, podrás explorar una variedad de proyectos desarrollados por el creador. Tendrás la capacidad de cargar nombres, imágenes y descripciones de cada proyecto, configurándolo como un portafolio personal para su presentación.</p>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach($proyectos as $proyecto) { ?>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="imagenes/<?php echo $proyecto['imagen']; ?>" class="card-img-top"
                          alt="<?php echo $proyecto['imagen']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $proyecto['nombre']; ?></h5>
                            <p class="cart-text"><?php echo $proyecto['descripcion']; ?></p>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>

<?php include("footer.php"); ?>
