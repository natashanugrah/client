<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud_customer";

//Create Connection
$connection = new mysqli($servername, $username, $password, $database);

$employeeId = "";
$name = "";
$address = "";
$birthdate = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $employeeId = $_POST["employeeId"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $birthdate = $_POST["birthdate"];

    do{
        if(empty($employeeId) || empty($name) || empty($address) || empty($birthdate)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // add new client to database
        $sql = "INSERT INTO client(employeeId, name, address, birthdate)".
            "VALUES ('$employeeId', '$name', '$address', '$birthdate')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid Query: " . $connection->error;
            break;
        }

        $employeeId = "";
        $name = "";
        $address = "";
        $birthdate = "";    

        $successMessage = "Client added correctly";

        header("location: /client/index.php");
        exit;

    }while(false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2> New Client </h2>

        <?php
        if(!empty($errorMessage)){
            echo"
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Employee Id</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="employeeId" value="<?php echo $employeeId; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Birthdate</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="birthdate" value="<?php echo $birthdate; ?>">
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo"
            <div class='row mb-3'>
                <div class = 'offset-sm-3 col-sm-6'>
                    <div class ='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>
            ";     
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-cm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/client/index.php" role="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>    
</body>
</html>