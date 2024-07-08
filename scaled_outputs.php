<?php

session_start();

require 'db.php';


$query = "INSERT INTO scaled_outputs (cat_Business_Constitution_1,cat_Business_Constitution_2,cat_Business_Constitution_3,cat_Business_Constitution_4,cat_Business_Constitution_5,cat_gender_1,cat_gender_2,cat_gender_3,cat_no_of_Coapp_1,cat_no_of_Coapp_2,cat_no_of_Coapp_3,cat_no_of_Coapp_4,cat_no_of_Coapp_5,No_of_Dependents_1,No_of_Dependents_2,No_of_Dependents_3,No_of_Dependents_4,cat_industry_type_1,cat_industry_type_2,cat_industry_type_3,cat_industry_type_4,cat_industry_type_5,CAT_loan_tenure_1,CAT_loan_tenure_2,CAT_loan_tenure_3,CAT_loan_tenure_4,CAT_loan_tenure_5,CAT_YearExp_1,CAT_YearExp_2,CAT_YearExp_3,CAT_YearExp_4,CAT_YearExp_5,cat_eligibility_1,cat_eligibility_2,cat_eligibility_3,cat_eligibility_4,cat_eligibility_5,cat_qualification_1,cat_qualification_2,cat_qualification_3,cat_qualification_4,cat_qualification_5,cat_relation_1,cat_relation_2,cat_relation_3,cat_relation_4,cat_relation_5,cat_channel_1,cat_channel_2,cat_channel_3,cat_channel_4,cat_channel_5,cat_exist_customer_1,cat_exist_customer_2,cat_lpsp_1,cat_lpsp_2,cat_lpsp_3,cat_lpsp_4,cat_lpsp_5,cat_loan_type_1,cat_loan_type_2,cat_loan_type_3,cat_loan_type_4,cat_loan_type_5,cat_company_1,cat_company_2,cat_company_3,cat_company_4,cat_company_5,cat_city_state_1,cat_city_state_2,cat_city_state_3,cat_city_state_4,cat_city_state_5,cat_cibil_1,cat_cibil_2,cat_cibil_3,cat_age_1,cat_age_2,cat_age_3,cat_age_4,cat_age_5,CAT_foir_1,CAT_foir_2,CAT_foir_3,CAT_foir_4,CAT_foir_5,cat_bank_emi)

SELECT 
CASE WHEN cat_Business_Constitution = 1 THEN 1 ELSE 0 END AS cat_Business_Constitution_1,
CASE WHEN cat_Business_Constitution = 2 THEN 1 ELSE 0 END AS cat_Business_Constitution_2,
CASE WHEN cat_Business_Constitution = 3 THEN 1 ELSE 0 END AS cat_Business_Constitution_3,
CASE WHEN cat_Business_Constitution = 4 THEN 1 ELSE 0 END AS cat_Business_Constitution_4,
CASE WHEN cat_Business_Constitution = 5 THEN 1 ELSE 0 END AS cat_Business_Constitution_5,

CASE WHEN cat_gender = 1 THEN 1 ELSE 0 END AS cat_gender_1,
CASE WHEN cat_gender = 2 THEN 1 ELSE 0 END AS cat_gender_2,
CASE WHEN cat_gender = 3 THEN 1 ELSE 0 END AS cat_gender_3,

CASE WHEN cat_no_of_Coapp = 1 THEN 1 ELSE 0 END AS cat_no_of_Coapp_1,
CASE WHEN cat_no_of_Coapp = 2 THEN 1 ELSE 0 END AS cat_no_of_Coapp_2,
CASE WHEN cat_no_of_Coapp = 3 THEN 1 ELSE 0 END AS cat_no_of_Coapp_3,
CASE WHEN cat_no_of_Coapp = 4 THEN 1 ELSE 0 END AS cat_no_of_Coapp_4,
CASE WHEN cat_no_of_Coapp = 5 THEN 1 ELSE 0 END AS cat_no_of_Coapp_5,

CASE WHEN No_of_Dependents = 1 THEN 1 ELSE 0 END AS No_of_Dependents_1,
CASE WHEN No_of_Dependents = 2 THEN 1 ELSE 0 END AS No_of_Dependents_2,
CASE WHEN No_of_Dependents = 3 THEN 1 ELSE 0 END AS No_of_Dependents_3,
CASE WHEN No_of_Dependents = 4 THEN 1 ELSE 0 END AS No_of_Dependents_4,

CASE WHEN cat_industry_type = 1 THEN 1 ELSE 0 END AS cat_industry_type_1,
CASE WHEN cat_industry_type = 2 THEN 1 ELSE 0 END AS cat_industry_type_2,
CASE WHEN cat_industry_type = 3 THEN 1 ELSE 0 END AS cat_industry_type_3,
CASE WHEN cat_industry_type = 4 THEN 1 ELSE 0 END AS cat_industry_type_4,
CASE WHEN cat_industry_type = 5 THEN 1 ELSE 0 END AS cat_industry_type_5,


CASE WHEN CAT_loan_tenure = 1 THEN 1 ELSE 0 END AS CAT_loan_tenure_1,
CASE WHEN CAT_loan_tenure = 2 THEN 1 ELSE 0 END AS CAT_loan_tenure_2,
CASE WHEN CAT_loan_tenure = 3 THEN 1 ELSE 0 END AS CAT_loan_tenure_3,
CASE WHEN CAT_loan_tenure = 4 THEN 1 ELSE 0 END AS CAT_loan_tenure_4,
CASE WHEN CAT_loan_tenure = 5 THEN 1 ELSE 0 END AS CAT_loan_tenure_5,


CASE WHEN CAT_YearExp = 1 THEN 1 ELSE 0 END AS CAT_YearExp_1,
CASE WHEN CAT_YearExp = 2 THEN 1 ELSE 0 END AS CAT_YearExp_2,
CASE WHEN CAT_YearExp = 3 THEN 1 ELSE 0 END AS CAT_YearExp_3,
CASE WHEN CAT_YearExp = 4 THEN 1 ELSE 0 END AS CAT_YearExp_4,
CASE WHEN CAT_YearExp = 5 THEN 1 ELSE 0 END AS CAT_YearExp_5,

CASE WHEN cat_eligibility = 1 THEN 1 ELSE 0 END AS cat_eligibility_1,
CASE WHEN cat_eligibility = 2 THEN 1 ELSE 0 END AS cat_eligibility_2,
CASE WHEN CAT_YearExp = 3 THEN 1 ELSE 0 END AS cat_eligibility_3,
CASE WHEN cat_eligibility = 4 THEN 1 ELSE 0 END AS cat_eligibility_4,
CASE WHEN cat_eligibility = 5 THEN 1 ELSE 0 END AS cat_eligibility_5,

CASE WHEN cat_qualification = 1 THEN 1 ELSE 0 END AS cat_qualification_1,
CASE WHEN cat_qualification = 2 THEN 1 ELSE 0 END AS cat_qualification_2,
CASE WHEN cat_qualification = 3 THEN 1 ELSE 0 END AS cat_qualification_3,
CASE WHEN cat_qualification = 4 THEN 1 ELSE 0 END AS cat_qualification_4,
CASE WHEN cat_qualification = 5 THEN 1 ELSE 0 END AS cat_qualification_5,

CASE WHEN cat_relation = 1 THEN 1 ELSE 0 END AS cat_relation_1,
CASE WHEN cat_relation = 2 THEN 1 ELSE 0 END AS cat_relation_2,
CASE WHEN cat_relation = 3 THEN 1 ELSE 0 END AS cat_relation_3,
CASE WHEN cat_relation = 4 THEN 1 ELSE 0 END AS cat_relation_4,
CASE WHEN cat_relation = 5 THEN 1 ELSE 0 END AS cat_relation_5,

CASE WHEN cat_channel = 1 THEN 1 ELSE 0 END AS cat_channel_1,
CASE WHEN cat_channel = 2 THEN 1 ELSE 0 END AS cat_channel_2,
CASE WHEN cat_channel = 3 THEN 1 ELSE 0 END AS cat_channel_3,
CASE WHEN cat_channel = 4 THEN 1 ELSE 0 END AS cat_channel_4,
CASE WHEN cat_channel = 5 THEN 1 ELSE 0 END AS cat_channel_5,

CASE WHEN cat_exist_customer = 1 THEN 1 ELSE 0 END AS cat_exist_customer_1,
CASE WHEN cat_exist_customer = 2 THEN 1 ELSE 0 END AS cat_exist_customer_2,

CASE WHEN cat_lpsp = 1 THEN 1 ELSE 0 END AS cat_lpsp_1,
CASE WHEN cat_lpsp = 2 THEN 1 ELSE 0 END AS cat_lpsp_2,
CASE WHEN cat_lpsp = 3 THEN 1 ELSE 0 END AS cat_lpsp_3,
CASE WHEN cat_lpsp = 4 THEN 1 ELSE 0 END AS cat_lpsp_4,
CASE WHEN cat_lpsp = 5 THEN 1 ELSE 0 END AS cat_lpsp_5,

CASE WHEN cat_loan_type = 1 THEN 1 ELSE 0 END AS cat_loan_type_1,
CASE WHEN cat_loan_type = 2 THEN 1 ELSE 0 END AS cat_loan_type_2,
CASE WHEN cat_loan_type = 3 THEN 1 ELSE 0 END AS cat_loan_type_3,
CASE WHEN cat_loan_type = 4 THEN 1 ELSE 0 END AS cat_loan_type_4,
CASE WHEN cat_loan_type = 5 THEN 1 ELSE 0 END AS cat_loan_type_5,

CASE WHEN cat_company = 1 THEN 1 ELSE 0 END AS cat_company_1,
CASE WHEN cat_company = 2 THEN 1 ELSE 0 END AS cat_company_2,
CASE WHEN cat_company = 3 THEN 1 ELSE 0 END AS cat_company_3,
CASE WHEN cat_company = 4 THEN 1 ELSE 0 END AS cat_company_4,
CASE WHEN cat_company = 5 THEN 1 ELSE 0 END AS cat_company_5,

CASE WHEN cat_city_state = 1 THEN 1 ELSE 0 END AS cat_city_state_1,
CASE WHEN cat_city_state = 2 THEN 1 ELSE 0 END AS cat_city_state_2,
CASE WHEN cat_city_state = 3 THEN 1 ELSE 0 END AS cat_city_state_3,
CASE WHEN cat_city_state = 4 THEN 1 ELSE 0 END AS cat_city_state_4,
CASE WHEN cat_city_state = 5 THEN 1 ELSE 0 END AS cat_city_state_5,

CASE WHEN cat_cibil = 1 THEN 1 ELSE 0 END AS cat_cibil_1,
CASE WHEN cat_cibil = 2 THEN 1 ELSE 0 END AS cat_cibil_2,
CASE WHEN cat_cibil = 3 THEN 1 ELSE 0 END AS cat_cibil_3,

CASE WHEN cat_age = 1 THEN 1 ELSE 0 END AS cat_age_1,
CASE WHEN cat_age = 2 THEN 1 ELSE 0 END AS cat_age_2,
CASE WHEN cat_age = 3 THEN 1 ELSE 0 END AS cat_age_3,
CASE WHEN cat_age = 4 THEN 1 ELSE 0 END AS cat_age_4,
CASE WHEN cat_age = 5 THEN 1 ELSE 0 END AS cat_age_5,

CASE WHEN CAT_foir = 1 THEN 1 ELSE 0 END AS CAT_foir_1,
CASE WHEN CAT_foir = 2 THEN 1 ELSE 0 END AS CAT_foir_2,
CASE WHEN CAT_foir = 3 THEN 1 ELSE 0 END AS CAT_foir_3,
CASE WHEN CAT_foir = 4 THEN 1 ELSE 0 END AS CAT_foir_4,
CASE WHEN CAT_foir = 5 THEN 1 ELSE 0 END AS CAT_foir_5,

cat_bank_emi

FROM `scaled_inputs`;
";


$res = $conn->query($query);

if($res){
	$_SESSION['success'] = "Data Insert Scaled Output success";
}else{
	$_SESSION['error'] = "Opps! Something went wrong.";            	
}

header('Location: index.php');