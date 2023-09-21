<?php
// Include config file
require_once "config.php"; 


//Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["nombre"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["segundo_nombre"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_salary = trim($_POST["apellido_paterno"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tbl_usuario (nombre, segundo_nombre, apellido_paterno, apellido_materno, numero_casa, calle, ciudad, provincia, cp, tipo_residencia, nss, telefono, edad, puesto, salario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Agregar registro</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <label>Datos de usuario:</label> 
                        <div class="form-group" style="visibility: visible; position:absolute; width: 24%; height: 30%; top: 100%; left: 0%;">
                            <label>Nombre: </label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group" style="visibility: visible; position:absolute; width: 24%; height: 30%; top: 100%; left: 25%;">
                            <label>Segundo nombre: </label>
                            <input type="text" name="segundo_nombre" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group" style="visibility: visible; position:absolute; width: 24%; height: 30%; top: 100%; left: 50%;">
                            <label>Apellido paterno: </label>
                            <input type="text" name="apellido_paterno" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group" style="visibility: visible; position:absolute; width: 24%; height: 30%; top: 100%; left: 75%;">
                            <label>Apellido materno: </label>
                            <input type="text" name="apellido_materno" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>     
                        
                        <div class="form-group" style="visibility: visible; position:absolute; width: 74%; height: 30%; top: 160%; left: 0%;">
                            <label>Calle: </label>
                            <input type="text" name="calle" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>     
                        <div class="form-group" style="visibility: visible; position:absolute; width: 24%; height: 30%; top: 160%; left: 75%;">
                            <label>Número: </label>
                            <input type="text" name="numero_casa" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>   
                        <div class="form-group" style="visibility: visible; position:absolute; width: 33%; height: 30%; top: 220%; left: 0%;">
                            <label>Ciudad: </label>
                            <input type="text" name="ciudad" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>                     
                        <div class="form-group" style="visibility: visible; position:absolute; width: 32%; height: 30%; top: 220%; left: 34%;">
                            <label>Provincia: </label>
                            <input type="text" name="provincia" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div> 
                        <div class="form-group" style="visibility: visible; position:absolute; width: 32%; height: 30%; top: 220%; left: 67%;">
                            <label>Codigo postal: </label>
                            <input type="text" name="cp" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div> 
                        <div class="form-group" style="visibility: visible; position:absolute; width: 33%; height: 30%; top: 280%; left: 0%;">
                            <label>Tipo residecia: </label>
                            <input type="text" name="tipo_residencia" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>                     
                        <div class="form-group" style="visibility: visible; position:absolute; width: 32%; height: 30%; top: 280%; left: 34%;">
                            <label>Numero de seguro social: </label>
                            <input type="text" name="nss" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div> 
                        <div class="form-group" style="visibility: visible; position:absolute; width: 32%; height: 30%; top: 280%; left: 67%;">
                            <label>Telefono: </label>
                            <input type="text" name="telefono" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group" style="visibility: visible; position:absolute; width: 33%; height: 30%; top: 340%; left: 0%;">
                            <label>Edad: </label>
                            <input type="text" name="edad" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>                     
                        <div class="form-group" style="visibility: visible; position:absolute; width: 32%; height: 30%; top: 340%; left: 34%;">
                            <label>Puesto solicitado: </label>
                            <input type="text" name="puesto" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div> 
                        <div class="form-group" style="visibility: visible; position:absolute; width: 32%; height: 30%; top: 340%; left: 67%;">
                            <label>Salario deseado: </label>
                            <input type="text" name="salario" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group" style="visibility: visible; position:absolute; width: 32%; height: 30%; top: 410%; left: 72%;">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>