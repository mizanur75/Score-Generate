<?php
session_start(); 
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

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

          // Read the Excel file
          $spreadsheet = IOFactory::load($uploadedFile);
          $sheet = $spreadsheet->getSheetByName('GSTR3B Periodical Summary');

          // Get the highest row number and column name
          $highestRow = $sheet->getHighestRow();
          $highestColumn = $sheet->getHighestColumn();
          $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

          $columns = [];
          $total_values = [];
          // Loop through each row of the Excel file
          for ($row = 2; $row <= $highestRow; $row++) {  // Assuming the first row contains column names

              $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
              
              $values = [];

              foreach ($rowData[0] as $column => $value) {
                  $values[] = $value;
              }
              
              $total_values[] = $values;
            }
            $indices = [0, 3, 4, 5, 17, 25, 79, 81, 82, 83];

            $filteredValue = [];
            foreach ($indices as $index) {
                if (isset($total_values[$index])) {
                    $filteredValue[] = $total_values[$index];
                }
            }
            // var_dump(count($filteredValue[0])); exit;
            
            $i = 1;
            $result = false;
            $count = count($filteredValue[0]) - 1;
            for($i; $i <= $count; $i ++){
              $sql = "INSERT INTO gstr3b_periodical_summary (`Month_Name`,`SGST`,`CGST`,`IGST`,`Total_Tax_Zero_rated_Outward_taxable_supplies`,`Total_Tax_nill_rated_Outward_taxable_supplies`,`Total_Tax_Paid`,`Tax_paid_In_Credit`,`Interest_Payment`,`Late_Fee`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
              // Prepare SQL query
              $res = $conn->prepare($sql);
              
              // Execute SQL query
              $res->execute([$filteredValue[0][$i], $filteredValue[1][$i], $filteredValue[2][$i], $filteredValue[3][$i], $filteredValue[4][$i], $filteredValue[5][$i], $filteredValue[6][$i], $filteredValue[7][$i], $filteredValue[8][$i], $filteredValue[9][$i]]);

              $result = true;
            }

            if($result){
            	// Close and delete the uploaded file
            	unlink($uploadedFile);
            	$_SESSION['success'] = "Data inserted successfully!";
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