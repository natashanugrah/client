<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2> List of Client </h2>
        <a class="btn btn-primary" href="/client/create.php" role="button"> New Client </a>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>Client Id</th>
                    <th>Employee Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Birthdate</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

         <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "crud_customer";

            //Create Connection
            $connection = new mysqli($servername, $username, $password, $database);

            // Check Connection
            if($connection->connect_error){
                die("Connection failed: ". $connection->connect_error);
            }

            // Read all row from database table
            $sql = "SELECT * FROM client";
            $result = $connection->query($sql);

            if(!$result){
                die("Invalid query: " . $connection->error);
            }

            // Read data of each row
            while($row = $result->fetch_assoc()){
                echo "
                <tr>
                        <th>$row[clientId]</th>
                        <th>$row[employeeId]</th>
                        <th>$row[name]</th>
                        <th>$row[address]</th>
                        <th>$row[birthdate]</th>
                        <th>$row[created_at]</th>
                        <td>
                            <a class='btn btn-primary' href='../crash_course/edit.php?id=$row[clientId]' role='button'>Edit</a>
                            <a href='btn btn-primary-btn-sm' href='/client/delete.php?id=$row[clientId]'>Delete</a>
                        </td>
            </tr>
                ";
            }

            ?>

            
         </tbody>
            
        </table>

    </div>
</body>
</html>