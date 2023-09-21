<?php
// Check existence of id parameter before processing further
if(isset($_GET["id_usuario"]) && !empty(trim($_GET["id_usuario"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM tbl_usuarios WHERE id_usuario = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id_usuario"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $nombre = $row["nombre_user"];
                $segundo_nombre = $row["segundo_nombre_user"];
                $apellido_paterno = $row["apellido_paterno_user"];
                $apellido_materno = $row["apellido_materno_user"];
                $numero_casa = $row["numero_casa_user"];
                $calle = $row["calle_user"];
                $ciudad = $row["ciudad_user"];
                $provincia = $row["provincia_user"];
                $cp = $row["cp_user"];
                $tipo_residencia = $row["tipo_residencia_user"];
                $nss = $row["nss_user"];
                $telefono = $row["telefono_user"];
                $edad = $row["edad_user"];
                $puesto = $row["puesto_user"];
                $salario = $row["salario_user"]; 
                $fecha_registro = $row["fecha_registro_user"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Ver registro</h1>
                    <div class="form-group">
                        <label>Nombre: </label>
                        <p><b><?php echo $row["nombre_user"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Segundo nombre: </label>
                        <p><b><?php echo $row["segundo_nombre_user"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Apellido paterno: </label>
                        <p><b><?php echo $row["apellido_paterno_user"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Apellido materno:</label>
                        <p><b><?php echo $row["apellido_materno_user"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Dirección: </label>
                        <p><b><?php echo $row["calle_user"]; ?></b></p>
                        <p><b><?php echo $row["numero_casa_user"]; ?></b></p>
                        <p><b><?php echo $row["ciudad_user"]; ?></b></p>
                        <p><b><?php echo $row["provincia_user"]; ?></b></p>
                        <p><b><?php echo $row["cp_user"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Tipo de residencia: </label>
                        <p><b><?php echo $row["tipo_residencia_user"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>NSS: </label>
                        <p><b><?php echo $row["nss_user"]; ?></b></p>
                    </div>  
                    <div class="form-group">
                        <label>Telefono: </label>
                        <p><b><?php echo $row["telefono_user"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Edad: </label>
                        <p><b><?php echo $row["edad_user"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Puesto deseado: </label>
                        <p><b><?php echo $row["puesto_user"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Salario deseado: </label>
                        <p><b><?php echo $row["salario_user"]; ?></b></p>
                    </div>  
                    <div class="form-group">
                        <label>Fecha registro: </label>
                        <p><b><?php echo $row["fecha_registro_user"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
