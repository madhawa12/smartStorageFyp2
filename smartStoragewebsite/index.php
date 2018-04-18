<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Smart Grocery</title>
    <!-- Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="http://placehold.it/250/ffffff/000000" width="150" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <h1 class="mt-5">Welcome to the smartStorage!</h1>
      <p>Below given is your remaining storage.</p>
    </div>
    <!-- /.container -->
    <div class="container">
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "smartstorage";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT weight FROM persons WHERE w_id IN (SELECT w_id FROM persons WHERE ts = (SELECT MAX(ts) FROM persons)) ORDER BY w_id DESC LIMIT 1";
        $sql2 = "SELECT distance FROM candespenser WHERE c_id IN (SELECT c_id FROM candespenser WHERE ts = (SELECT MAX(ts) FROM candespenser)) ORDER BY c_id DESC LIMIT 1";
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if($row["weight"] == 1){
                    echo " 
                    <div class='alert alert-danger' role='alert'>
                      <h1> Current Weight: ". $row["weight"] . " Kg Left</h1>
                    </div>";
                }else
                {
                  echo " 
                    <div class='alert alert-primary' role='alert'>
                      <h1> Current Weight: ". $row["weight"] . " Kg Left</h1>
                    </div>";
                }
                
                
                
            }
        } else {
            echo "0 results";
        }
        
        if ($result2->num_rows > 0) {
            // output data of each row
            while($row = $result2->fetch_assoc()) {
                if($row["distance"] < 20){
                    echo " 
                    <div class='alert alert-danger' role='alert'>
                      <h1>Despenser has less than 5 cans</h1>
                    </div>";
                }else
                {
                  echo " 
                    <div class='alert alert-primary' role='alert'>
                      <h1>Despenser has more than 5 cans</h1>
                    </div>";
                }
                
                
                
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    ?>  
      </div>
      
      
      
      
      
      
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      
    
  </body>
</html>