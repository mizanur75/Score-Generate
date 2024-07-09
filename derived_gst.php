<?php
session_start();
require 'db.php';

$query = "INSERT INTO derived_gstr1_periodical_summary (`ref_id`,`month`,`b2b_iv_by_total_value`,`b2c_liv_by_total_value`,`b2c_siv_by_total_value`,`Export_Iv`,`Total_TV`,`Total_Iv`)
SELECT 
    g1.ref_id AS ref_id,
    LAST_DAY(STR_TO_DATE(CONCAT('01-', g1.`Month_Name`), '%d-%M-%y')) AS month,
    (g1.B2B_Invoice_Value / g1.`Total_Invoice_Value`) AS b2b_iv_by_total_value,
    (g1.B2C_Large_Invoice_Value / g1.`Total_Invoice_Value`) AS b2c_liv_by_total_value,
    (g1.B2C_Small_Invoice_Value / g1.`Total_Invoice_Value`) AS b2c_siv_by_total_value,
    g1.Export_Invoice_Value AS Export_Iv,
    g1.Total_Taxable_Value AS Total_TV,
    g1.Total_Invoice_Value AS Total_Iv
FROM gstr1_periodical_summary AS g1;
";

$res = $conn->prepare($query);
$res->execute();

if($res){
	$_SESSION['success'] = "Derived Data success";
}else{
	$_SESSION['error'] = "Opps! Something went wrong.";            	
}

header('Location: index.php');

