<?php

session_start();

require 'db.php';


$query = "INSERT INTO scaled_inputs (`cat_Business_Constitution`,`cat_gender`,`cat_no_of_Coapp`,`No_of_Dependents`,`CAT_loan_tenure`,`CAT_YearExp`,`cat_eligibility`,`cat_qualification`,`cat_cibil`,`cat_relation`,`cat_channel`,`cat_exist_customer`,`cat_company`,`cat_loan_type`,`cat_industry_type`,`cat_city_state`,`cat_lpsp`,`CAT_foir`,`cat_bank_emi`,`cat_age`)

SELECT 
    
    CASE 
        WHEN acm_business_constitution.Assigned_Category IS NOT NULL THEN acm_business_constitution.Assigned_Category
        ELSE 1
    END AS cat_Business_Constitution,
    
    CASE 
        WHEN acm_gender.Assigned_Category IS NOT NULL THEN acm_gender.Assigned_Category
        ELSE 1
    END AS cat_gender,
    case when No_of_Co_applicants is null or No_of_Co_applicants = 0 then 1
     when No_of_Co_applicants in (1,2) then 5
      when No_of_Co_applicants in (3,4,5) then 4
      when No_of_Co_applicants in (6,7,8,9) then 3
      when No_of_Co_applicants > 9 then 2
    else 1 end as cat_no_of_Coapp,
    
    case when No_of_Dependents is null then 1
     when No_of_Dependents = 0 then 4
     when No_of_Dependents in (1,2,3) then 3
     when No_of_Dependents>3 then 2
       else 1 end as No_of_Dependents,
   
   case when Loan_Tenure between 100 and 124 then 5
      when Loan_Tenure between 50 and 99 then 4
      when Loan_Tenure between 150 and 199 then 4
      when Loan_Tenure  between 225 and 249 then 4
      when Loan_Tenure  between 0 and 24 then 3
      when Loan_Tenure  between 125 and 149 then 3
      when Loan_Tenure  between 200 and 224 then 3
      when Loan_Tenure  between 25 and 49 then 2
      when Loan_Tenure >= 250 then 1
      else 1
    end as CAT_loan_tenure,
    
    case when Total_Work_Experience between 0 and 4 then 3 
      when Total_Work_Experience between 5 and 9 then 2
      when Total_Work_Experience between 10 and 14 then 4
      when Total_Work_Experience between 15 and 39 then 5
      when Total_Work_Experience >=40 then 2
      when Total_Work_Experience is null then 1 
      else 1 
    end as CAT_YearExp,
    
    CASE 
        WHEN acm_eligibility.Assigned_Category IS NOT NULL THEN acm_eligibility.Assigned_Category
        ELSE 1
    END AS cat_eligibility,
    
    CASE 
        WHEN acm_edu.Assigned_Category IS NOT NULL THEN acm_edu.Assigned_Category
        ELSE 1
    END AS cat_qualification,
    
    CASE WHEN CIBIL BETWEEN 1 AND 710 THEN 1
         WHEN CIBIL BETWEEN 711 AND 735 THEN 2
         WHEN CIBIL > 736 THEN 3
         WHEN CIBIL = -1 or CIBIL = 0 or CIBIL = -999 THEN 3
         else 1
     END AS cat_cibil,
    
    CASE 
        WHEN acm_relation.Assigned_Category IS NOT NULL THEN acm_relation.Assigned_Category
        ELSE 1
    END AS cat_relation,
    
    CASE 
        WHEN acm_channel.Assigned_Category IS NOT NULL THEN acm_channel.Assigned_Category
        ELSE 1
    END AS cat_channel,
    
    CASE 
        WHEN acm_exist_customer.Assigned_Category IS NOT NULL THEN acm_exist_customer.Assigned_Category
        ELSE 1
    END AS cat_exist_customer,
    
    CASE 
        WHEN acm_company_category.Assigned_Category IS NOT NULL THEN acm_company_category.Assigned_Category
        ELSE 1
    END AS cat_company,
    
    CASE 
        WHEN acm_loan_type.Assigned_Category IS NOT NULL THEN acm_loan_type.Assigned_Category
        ELSE 1
    END AS cat_loan_type,
    
    CASE 
        WHEN acm_industry_type.Assigned_Category IS NOT NULL THEN acm_industry_type.Assigned_Category
        ELSE 1
    END AS cat_industry_type,
    
    CASE 
        WHEN acm_city_state.Assigned_Category IS NOT NULL THEN acm_city_state.Assigned_Category
        ELSE 1
    END AS cat_city_state,
    
    CASE 
        WHEN acm_lpsp.Assigned_Category IS NOT NULL THEN acm_lpsp.Assigned_Category
        ELSE 1
    END AS cat_lpsp,
    
    CASE WHEN Fixed_Obligations_to_Income_Ratio > 260 THEN 5
     WHEN Fixed_Obligations_to_Income_Ratio > 30 AND Fixed_Obligations_to_Income_Ratio <= 50 THEN 5
     WHEN Fixed_Obligations_to_Income_Ratio > 160 AND Fixed_Obligations_to_Income_Ratio <= 190 
       OR Fixed_Obligations_to_Income_Ratio > 90 AND Fixed_Obligations_to_Income_Ratio <=130
       OR Fixed_Obligations_to_Income_Ratio > 60 AND Fixed_Obligations_to_Income_Ratio <=80
      THEN 4
      WHEN Fixed_Obligations_to_Income_Ratio > 80 and Fixed_Obligations_to_Income_Ratio <=90 
           or Fixed_Obligations_to_Income_Ratio > 50 and Fixed_Obligations_to_Income_Ratio <= 60
      THEN 3
       WHEN Fixed_Obligations_to_Income_Ratio > 130 AND Fixed_Obligations_to_Income_Ratio <=160 
           OR Fixed_Obligations_to_Income_Ratio BETWEEN 0 AND 30
        OR Fixed_Obligations_to_Income_Ratio is null
      THEN 2
       ELSE 1 END AS CAT_foir,
       
       
       CASE WHEN EMI_to_other_banks <= 0.75 THEN 2
          WHEN EMI_to_other_banks > 0.75 AND EMI_to_other_banks <= 1 THEN 3
          WHEN EMI_to_other_banks > 1 AND EMI_to_other_banks <= 1.5 THEN 1
          WHEN EMI_to_other_banks > 1.5 AND EMI_to_other_banks <= 2 THEN 3
          WHEN EMI_to_other_banks > 2 AND EMI_to_other_banks <= 2.5 THEN 1
          WHEN EMI_to_other_banks > 2.5 AND EMI_to_other_banks <= 3.5 THEN 4
          WHEN EMI_to_other_banks > 3.5 AND EMI_to_other_banks <= 4 THEN 1
             WHEN EMI_to_other_banks > 4 THEN 5 
             ELSE 1
       END AS cat_bank_emi,
      
      CASE WHEN age BETWEEN 0 AND 14 
       OR age BETWEEN 20 AND 24 
            OR age>=65 THEN 5 
        WHEN age BETWEEN 30 AND 34 or age BETWEEN 40 AND 44 THEN 4 
        WHEN age BETWEEN 45 AND 49 or age BETWEEN 55 AND 59 THEN 3
        WHEN age BETWEEN 15 AND 19 or age BETWEEN 50 AND 54 THEN 2 else 1 
        END AS cat_age
    
FROM 
    ( 
       SELECT *,
		TIMESTAMPDIFF(YEAR, DATE_FORMAT(STR_TO_DATE(Date_of_Birth, '%d-%m-%Y'), '%Y-%m-%d'), CURDATE()) AS age
        FROM 
        custdata
    )
    AS cd

LEFT OUTER JOIN attribute_category_master AS acm_business_constitution ON TRIM(cd.Business_Constitution) = TRIM(acm_business_constitution.Value_of_Attribute)
AND acm_business_constitution.Attribute = 'Business_Constitution'
AND acm_business_constitution.Model_Name = '1'

LEFT OUTER JOIN attribute_category_master AS acm_gender ON TRIM(cd.Gender) = TRIM(acm_gender.Value_of_Attribute)
AND acm_gender.Attribute = 'Gender'
AND acm_gender.Model_Name = '1'

LEFT OUTER JOIN attribute_category_master AS acm_eligibility ON TRIM(cd.Eligibility_program) = TRIM(acm_eligibility.Value_of_Attribute)
AND acm_eligibility.Attribute = 'ELIGIBILITY_PROGRAM'
AND acm_eligibility.Model_Name = '1'


LEFT OUTER JOIN attribute_category_master AS acm_edu ON TRIM(cd.Qualification) = TRIM(acm_edu.Value_of_Attribute)
AND acm_edu.Attribute = 'EDU_DETAIL'
AND acm_edu.Model_Name = '1'

LEFT OUTER JOIN attribute_category_master AS acm_relation ON TRIM(cd.Relationship_between_applicant_and_coapplicant) = TRIM(acm_relation.Value_of_Attribute)
AND acm_relation.Attribute = 'RELATIONSHIP'
AND acm_relation.Model_Name = '1'


LEFT OUTER JOIN attribute_category_master AS acm_channel ON TRIM(cd.Channel) = TRIM(acm_channel.Value_of_Attribute)
AND acm_channel.Attribute = 'channel'
AND acm_channel.Model_Name = '1'


LEFT OUTER JOIN attribute_category_master AS acm_exist_customer ON TRIM(cd.Esixting_New_Customer_Flag) = TRIM(acm_exist_customer.Value_of_Attribute)
AND acm_exist_customer.Attribute = 'DEAL_EXISTING_CUSTOMER'
AND acm_exist_customer.Model_Name = '1'


LEFT OUTER JOIN attribute_category_master AS acm_company_category ON TRIM(cd.Category_of_the_company) = TRIM(acm_company_category.Value_of_Attribute)
AND acm_company_category.Attribute = 'company_category'
AND acm_company_category.Model_Name = '1'


LEFT OUTER JOIN attribute_category_master AS acm_loan_type ON TRIM(cd.Loan_Type) = TRIM(acm_loan_type.Value_of_Attribute)
AND acm_loan_type.Attribute = 'loan_sector_type'
AND acm_loan_type.Model_Name = '1'


LEFT OUTER JOIN attribute_category_master AS acm_industry_type ON TRIM(cd.Industry_Type) = TRIM(acm_industry_type.Value_of_Attribute)
AND acm_industry_type.Attribute = 'industry_type'
AND acm_industry_type.Model_Name = '1'


LEFT OUTER JOIN attribute_category_master AS acm_city_state ON TRIM(cd.PIN_City_State) = TRIM(acm_city_state.Value_of_Attribute)
AND acm_city_state.Attribute = 'city_state'
AND acm_city_state.Model_Name = '1'


LEFT OUTER JOIN attribute_category_master AS acm_lpsp ON TRIM(cd.Loan_Product_Sub_Proct_Type) = TRIM(acm_lpsp.Value_of_Attribute)
AND acm_lpsp.Attribute = 'Loan_Product_Sub_Proct_Type'
AND acm_lpsp.Model_Name = '1'
ORDER BY cd.id ASC;
";


$res = $conn->query($query);

if($res){
	$_SESSION['success'] = "Data Insert Scaled Input success";
}else{
	$_SESSION['error'] = "Opps! Something went wrong.";            	
}

header('Location: index.php');