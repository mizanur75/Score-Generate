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

    var_dump($result - (-.086)); exit;

} else {
   echo "Error fetching data: " . $conn->errorInfo();
}