<?php
session_start();
ini_set('memory_limit', '-1');
set_time_limit(5000);
require 'vendor/autoload.php';
//require 'db.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=axis_bank", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
  
// Check if a file is uploaded
if (isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file'];

    
    // Check for errors in file upload
    if ($file['error'] === UPLOAD_ERR_OK) {
      // Specify the path to store the uploaded file
      $uploadPath = __DIR__ . '/uploads/';
      $uploadedFile = $uploadPath . basename($file['name']);
      if(!file_exists($uploadPath)){
        mkdir('uploads', 777, true);
      }

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($file['tmp_name'], $uploadedFile)) {

            // Load the Excel file
            $spreadsheet = IOFactory::load($uploadedFile);

            // var_dump($spreadsheet); exit;
            // Iterate through each worksheet in the Excel file
            $msg = '';
            foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
              $tableName = $worksheet->getTitle();
              // $dropTableQuery ="DROP TABLE IF EXISTS $tableName";
              // $conn->query($dropTableQuery);
              
              // Create table query
              // $select = "SELECT * FROM $tableName LIMIT 1";
              // var_dump($select); exit;
              // $existornot = $conn->query($select);

              // if(!$existornot){
                $createTableQuery = "CREATE TABLE IF NOT EXISTS $tableName (";

                // Iterate through each row in the worksheet
                foreach ($worksheet->getRowIterator() as $row) {
                    // Assume the first row contains column names
                    $columns = $row->getCellIterator();
                    foreach ($columns as $column) {
                        $createTableQuery .= str_replace(['/', ' ','-'],'_', $column->getValue()) . " VARCHAR(255), ";
                    }
                    break; // Only need column names from the first row
                }

                $createTableQuery = rtrim($createTableQuery, ", ") . ")";
                
                // Execute create table query
                $conn->query($createTableQuery);
              // }
              

              // Iterate through each row again to insert data
              $firstRow = 0;
              foreach ($worksheet->getRowIterator() as $key => $row) {
                  $insertQuery = "INSERT INTO $tableName VALUES (";

                  $cells = $row->getCellIterator();
                  foreach ($cells as $cell) {
                      $insertQuery .= "'" . str_replace('\'','', $cell->getValue()) . "', ";
                  }

                  $insertQuery = rtrim($insertQuery, ", ") . ")";
                  
                  // Execute insert query
                  if($firstRow > 0){
                    $conn->query($insertQuery);
                  }
                  $firstRow ++;
              }
              $msg = 'Data imported successfully!';
            }


            if($msg){
            	// Close and delete the uploaded file
            	unlink($uploadedFile);
            	$_SESSION['success'] = $msg;
            }else{
				      $_SESSION['error'] = "Opps! Something went wrong.";            	
            }

            header('Location: index.php');
            
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "File upload error: " . $file['error'];
    }
}