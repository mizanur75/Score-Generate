<?php
session_start(); 
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
require 'db.php';

if (isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadPath = __DIR__ . '/uploads/';
        $uploadedFile = $uploadPath . basename($file['name']);
        if(!file_exists($uploadPath)){
            mkdir('uploads', 0777, true);
        }

        if (move_uploaded_file($file['tmp_name'], $uploadedFile)) {

            $spreadsheet = IOFactory::load($uploadedFile);

            // Process the first sheet (GSTR1 Periodical Summary)
            $sheet1 = $spreadsheet->getSheetByName('GSTR1 Periodical Summary');
            // Get the highest row number and column name
            $highestRow1 = $sheet1->getHighestRow();
            $highestColumn1 = $sheet1->getHighestColumn();
            $highestColumnIndex1 = PHPExcel_Cell::columnIndexFromString($highestColumn1);

            $columns = [];
            $total_values = [];
            // Loop through each row of the Excel file
            for ($row = 2; $row <= $highestRow1; $row++) {  // Assuming the first row contains column names

                $rowData = $sheet1->rangeToArray('A' . $row . ':' . $highestColumn1 . $row, NULL, TRUE, FALSE);
                
                $values = [];

                foreach ($rowData[0] as $column => $value) {
                    $values[] = $value;
                }
                
                $total_values[] = $values;
            }

            $indices = [0, 3, 4, 10, 31, 52, 112];

            $filteredValue = [];
            foreach ($indices as $index) {
                if (isset($total_values[$index])) {
                    $filteredValue[] = $total_values[$index];
                }
            }
            
            $i = 1;
            $result = false;
            $count = count($filteredValue[0]) - 1;
            for($i; $i <= $count; $i ++){
              $sql = "INSERT INTO gstr1_periodical_summary (`Month_Name`,`Total_Invoice_Value`,`Total_Taxable_Value`,`B2B_Invoice_Value`,`B2C_Large_Invoice_Value`,`B2C_Small_Invoice_Value`,`Export_Invoice_Value`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
              // Prepare SQL query
              $res = $conn->prepare($sql);
              
              // Execute SQL query
              $res->execute([$filteredValue[0][$i], $filteredValue[1][$i], $filteredValue[2][$i], $filteredValue[3][$i], $filteredValue[4][$i], $filteredValue[5][$i], $filteredValue[6][$i]]);

              $result = true;
            }

            // Process the second sheet (GSTR3B Periodical Summary)
            $sheet2 = $spreadsheet->getSheetByName('GSTR3B Periodical Summary');
            // Get the highest row number and column name
            $highestRow2 = $sheet2->getHighestRow();
            $highestColumn2 = $sheet2->getHighestColumn();
            $highestColumnIndex2 = PHPExcel_Cell::columnIndexFromString($highestColumn2);

            $columns = [];
            $total_values = [];
            // Loop through each row of the Excel file
            for ($row = 2; $row <= $highestRow2; $row++) {  // Assuming the first row contains column names

                $rowData = $sheet2->rangeToArray('A' . $row . ':' . $highestColumn2 . $row, NULL, TRUE, FALSE);
                
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
                unlink($uploadedFile);
                $_SESSION['success'] = "Data inserted successfully!";
            }else{
                $_SESSION['error'] = "Oops! Something went wrong.";            	
            }

            header('Location: index.php');
            
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "File upload error: " . $file['error'];
    }
}
?>
