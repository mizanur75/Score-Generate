<?php

$servername = "localhost";
  $username = "root";
  $password = "";

  try {
    $conn = new PDO("mysql:host=$servername; dbname=axis_bank", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully <br>";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }


// Fetch data from variable_coefficient table
$variable_coefficient_query = $conn->query("SELECT * FROM variable_coefficient");
$variable_coefficient_result = $variable_coefficient_query->fetchAll();

// Fetch data from scaled_inputs table
$scaled_inputs_query = $conn->query("SELECT * FROM scaled_outputs");
$scaled_inputs_result = $scaled_inputs_query->fetchAll();

// var_dump($scaled_inputs_query->columnCount()); exit;


// Check if both queries were successful
if ($variable_coefficient_result && $scaled_inputs_result) {
    // Initialize arrays to store fetched data
    $variable_coefficients = array();
    $scaled_inputs = array();
    

    foreach ($variable_coefficient_result as $key => $value) {
        $variable_coefficients[] = $value['coefficient'];
    }

    // var_dump($variable_coefficients); exit;


    foreach ($scaled_inputs_result as $key => $value) {
        $scaled_inputs_row = array();
        
        for ($i = 0; $i < $scaled_inputs_query->columnCount(); $i++) { // Assuming columns
            $scaled_inputs_row[] = $value[$i]; // Assuming column names value
        }
        $scaled_inputs[] = $scaled_inputs_row;
        // var_dump($scaled_inputs_row); exit;
    }

    // Perform dot product
    $result = 0;
    for ($i = 0; $i < count($scaled_inputs[0]); $i++) {
        $result += number_format((float)$variable_coefficients[$i], 2) * number_format((float)$scaled_inputs[0][$i], 2);
    }

    $score = ($result - (-.086));
    // var_dump($score); exit;

} else {
   echo "Error fetching data: " . $conn->errorInfo();
}

  session_start(); 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generated Score</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <h1 class="text-center m-5">Generated Score</h1>
      <?php
        if(isset($_SESSION['success'])){
        ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
       
       <?php 
       }
        unset($_SESSION['success']);
        
      ?>
      <?php
        if(isset($_SESSION['error'])){
        ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
       
       <?php 
       }
         unset($_SESSION['error']);
      ?>

      <!-- Buttons to show form -->
      <div class="row">
        <h1 class="text-center">Generated Score is: <span class="badge bg-success"><?php echo $result; ?></span> </h1>
      </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
