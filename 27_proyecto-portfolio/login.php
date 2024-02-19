<?php
session_start();

// Verifica si se ha enviado un formulario (POST) Nota:Codigo PHP no se ve para el usuario solo en desarrollo
if ($_POST) {
    // Verifica si las credenciales son correctas (usuario: "developer", contraseña: "123456")
    if ($_POST['usuario'] == "developer" && $_POST['password'] == "123456") {
        // Inicia sesión y establece el usuario como "developer"
        $_SESSION['usuario'] = "developer";

        // Mensaje de éxito
        echo "Logueado, ok!";

        // Redirecciona al usuario a la página principal
        header("location:index.php");
    } else {
        // Muestra una alerta de JavaScript en caso de credenciales incorrectas
        echo "<script> alert('Login incorrecto'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Incluye el CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <br/>
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Iniciar Sesión
                    </div>
                    <div class="card-body">
                        <!-- Formulario de inicio de sesión -->
                        <form action="login.php" method="post">
                            Usuario: <input type="text" class="form-control" name="usuario" id=""><br/>
                            Contraseña: <input type="password" class="form-control" name="password" id=""><br/><br/>

                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-success">Entrar al portfolio</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted"></div>
                </div>
            </div>

            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>