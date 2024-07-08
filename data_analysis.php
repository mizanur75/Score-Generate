<?php 
session_start();

require  'db.php';


$query = "INSERT INTO `data_analysis`(`ref_id`,`b2b_iv`, `b2c_liv`,`b2c_siv`,`export_iv`,`sci_gst`,`tax_zero_outware`,`tax_nill_outware`,`tax_paid_in_credit`,`latest_fy_iv`, `pre_fy_iv`,`total_iv_flag`,`compare_tiv`,`compare_ttv`,`payment_null_0`,`late_fee_null_0`,`credit_transaction_amount`,`cheque_bounce_outward`,`cheque_bounce_inward`,`tech_cheque_bounce_inward`,`non_tech_cheque_bounce_inward`,`cash_withdrawal`)

SELECT * FROM (
	(SELECT DISTINCT ref_id
    FROM 
        derived_gstr1_periodical_summary
    )AS ref_id,
    
    
    (SELECT COUNT(b2b_iv) AS b2b_iv
    FROM (
        SELECT
            (b2b_iv_by_total_value - lag(b2b_iv_by_total_value, 2) over (ORDER BY id)) / (lag(b2b_iv_by_total_value, 2) over (ORDER BY id)) AS b2b_iv
        FROM derived_gstr1_periodical_summary
    ) AS subquery_b2b_iv
    WHERE b2b_iv > .15) AS b2b_iv,


    (SELECT COUNT(b2c_liv) as b2c_liv
    FROM (
        SELECT 
            (b2c_liv_by_total_value - lag(b2c_liv_by_total_value, 2) over (ORDER BY id)) / (lag(b2c_liv_by_total_value, 2) over (ORDER BY id)) AS b2c_liv
        FROM derived_gstr1_periodical_summary
    ) AS subquery
    WHERE b2c_liv > .15) AS b2c_liv,
    
    

    	(SELECT COUNT(b2c_siv) AS b2c_siv
        FROM (
            SELECT 
                (b2c_siv_by_total_value - lag(b2c_siv_by_total_value, 2) over (ORDER BY id)) / (lag(b2c_siv_by_total_value, 2) over (ORDER BY id)) AS b2c_siv
            FROM derived_gstr1_periodical_summary
        ) AS subquery
        WHERE b2c_siv > .15) AS b2c_siv,
    
    (SELECT COUNT(export_iv) AS export_iv
     FROM (
         SELECT 
         (`Export_Iv` - lag(`Export_Iv`, 1) over (ORDER BY id)) / (lag(`Export_Iv`, 1) over (ORDER BY id)) AS export_iv
         FROM derived_gstr1_periodical_summary
     ) AS subquery
     WHERE Export_Iv IS NOT NULL AND Export_Iv != 0 AND export_iv > .15) AS export_iv,
    
	(SELECT COUNT(sci_gst) AS sci_gst
     FROM (
         SELECT ((`SGST`+`CGST`-`IGST`) - lag((`SGST`+`CGST`-`IGST`), 2) over (ORDER BY id)) / lag((`SGST`+`CGST`-`IGST`),2) over (ORDER BY id) AS sci_gst FROM gstr3b_periodical_summary
     ) AS subquery
     WHERE sci_gst > .15) AS sci_gst,


	(SELECT COUNT(tax_zero_outware) AS tax_zero_outware
    FROM (
        SELECT (`Total_Tax_Zero_rated_Outward_taxable_supplies` - lag(Total_Tax_Zero_rated_Outward_taxable_supplies, 2) over (ORDER BY id)) / (lag(Total_Tax_Zero_rated_Outward_taxable_supplies,2) over (ORDER BY id)) AS tax_zero_outware FROM gstr3b_periodical_summary
    ) AS subquery
    WHERE tax_zero_outware > .15) AS tax_zero_outware,
    
    
    (SELECT COUNT(tax_nill_outware) AS tax_nill_outware
    FROM (
        SELECT (`Total_Tax_nill_rated_Outward_taxable_supplies` - lag(Total_Tax_nill_rated_Outward_taxable_supplies, 2) over (ORDER BY id)) / (lag(Total_Tax_nill_rated_Outward_taxable_supplies,2) over (ORDER BY id)) AS tax_nill_outware FROM gstr3b_periodical_summary
    ) AS subquery
    WHERE tax_nill_outware > .15) AS tax_nill_outware,
    

	(SELECT COUNT(tax_paid_in_cred) AS tax_paid_in_credit 
    FROM (SELECT *,
            (`paid_by_total` - lag(paid_by_total, 2) over (ORDER BY id)) / 	lag(paid_by_total,2) over (ORDER BY id) AS tax_paid_in_cred    
        FROM
            (SELECT 
                id,
                Tax_Paid_In_Credit,
                Total_Tax_Paid,
                Tax_Paid_In_Credit / Total_Tax_Paid AS paid_by_total
            FROM 
                gstr3b_periodical_summary) 
            AS gstr3)
    AS P
    WHERE p.tax_paid_in_cred > .15) AS tax_paid_in_credit,


    (SELECT 
        SUM(Total_Iv) AS latest_fy_iv
    FROM (
        SELECT
            Total_Iv,
            CASE 
                WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
            END AS financial_year,
            CASE 
                WHEN MONTH(`month`) >= 4 THEN `month`
                ELSE `month`
            END AS months
        FROM derived_gstr1_periodical_summary
    ) AS subquery

    WHERE financial_year = (
        SELECT MAX(financial_year)
        FROM (
            SELECT 
                CASE 
                    WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`) + 1) 
                    ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                END AS financial_year
            FROM derived_gstr1_periodical_summary
        ) AS subquery
    )) AS latest_fy_iv,
    
    
     (SELECT * FROM (
        SELECT 
            SUM(Total_Iv) AS pre_fy_iv
        FROM (
            SELECT
                Total_Iv,
                CASE 
                    WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                    ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                END AS financial_year,
                `month` AS months
            FROM derived_gstr1_periodical_summary
        ) AS subquery
        WHERE MONTH(months) BETWEEN 
            (SELECT 
            MONTH(MIN(`month`)) AS first_month
            FROM (
                SELECT 
                    CASE 
                        WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                        ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                    END AS financial_year,
                    `month`
                FROM derived_gstr1_periodical_summary
            ) AS subquery
            WHERE financial_year = (
                SELECT MAX(financial_year)
                FROM (
                    SELECT 
                        CASE 
                            WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                            ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                        END AS financial_year
                    FROM derived_gstr1_periodical_summary
                ) AS subquery
            ))
        AND 
            (SELECT 
            MONTH(MAX(`month`)) AS first_month
            FROM (
                SELECT 
                    CASE 
                        WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                        ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                    END AS financial_year,
                    `month`
                FROM derived_gstr1_periodical_summary
            ) AS subquery
            WHERE financial_year = (
                SELECT MAX(financial_year)
                FROM (
                    SELECT 
                        CASE 
                            WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                            ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                        END AS financial_year
                    FROM derived_gstr1_periodical_summary
                ) AS subquery
            ))
        AND financial_year < (
            SELECT MAX(financial_year)
            FROM (
                SELECT 
                    CASE 
                        WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`) + 1) 
                        ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                    END AS financial_year
                FROM derived_gstr1_periodical_summary
            ) AS subquery
        )
    ) AS result) AS pre_fy_iv,
    
    
    (SELECT 
     CASE
     WHEN (total_value - previous_total_value) / previous_total_value > .20 
     THEN 1
     ELSE 0
     END AS total_iv_flag
     FROM (
         (SELECT 
          SUM(Total_Iv) AS previous_total_value,
          previous_financial_year
          FROM (
              SELECT
              Total_Iv,
              CASE 
              WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
              ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
              END AS previous_financial_year,
              `month` AS months
              FROM derived_gstr1_periodical_summary
          ) AS subquery
          WHERE MONTH(months) BETWEEN 
          (SELECT 
           MONTH(MIN(`month`)) AS first_month
           FROM (
               SELECT 
               CASE 
               WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
               ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
               END AS previous_financial_year,
               `month`
               FROM derived_gstr1_periodical_summary
           ) AS subquery
           WHERE previous_financial_year = (
               SELECT MAX(previous_financial_year)
               FROM (
                   SELECT 
                   CASE 
                   WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                   ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                   END AS previous_financial_year
                   FROM derived_gstr1_periodical_summary
               ) AS subquery
           ))
          AND 
          (SELECT 
           MONTH(MAX(`month`)) AS first_month
           FROM (
               SELECT 
               CASE 
               WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
               ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
               END AS previous_financial_year,
               `month`
               FROM derived_gstr1_periodical_summary
           ) AS subquery
           WHERE previous_financial_year = (
               SELECT MAX(previous_financial_year)
               FROM (
                   SELECT 
                   CASE 
                   WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                   ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                   END AS financial_year
                   FROM derived_gstr1_periodical_summary
               ) AS subquery
           ))
          AND previous_financial_year < (
              SELECT MAX(previous_financial_year)
              FROM (
                  SELECT 
                  CASE 
                  WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`) + 1) 
                  ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                  END AS previous_financial_year
                  FROM derived_gstr1_periodical_summary
              ) AS subquery
          )) AS pre,

         (SELECT 
          SUM(Total_Iv) AS total_value,
          financial_year
          FROM (
              SELECT
              Total_Iv,
              CASE 
              WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
              ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
              END AS financial_year,
              `month` AS months
              FROM derived_gstr1_periodical_summary
          ) AS subquery
          WHERE financial_year = (
              SELECT MAX(financial_year)
              FROM (
                  SELECT 
                  CASE 
                  WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`) + 1) 
                  ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                  END AS financial_year
                  FROM derived_gstr1_periodical_summary
              ) AS subquery
          )
          AND EXISTS (
              SELECT 1
              FROM derived_gstr1_periodical_summary AS latest
              WHERE 
              financial_year = (
                  SELECT MAX(financial_year)
                  FROM (
                      SELECT 
                      CASE 
                      WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`) + 1) 
                      ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                      END AS financial_year
                      FROM derived_gstr1_periodical_summary
                  ) AS subquery_latest
              ) 
              AND MONTH(latest.`month`) = MONTH(subquery.months)
          )) AS latest_value
     )) AS total_iv_flag,
    
    
    (SELECT (A.current_iv - B.previous_iv) / B.previous_iv > .15 as compare_tiv
    FROM 
        (SELECT * FROM 
        (SELECT
                    Total_Iv as current_iv,
                    MONTH(`month`) as current_month,
                    YEAR(`month`) as current_year,
                    YEAR(`month`) - 1 as previous_year,
                    CASE 
                        WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                        ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                    END AS financial_year,
                    `month` AS months
                FROM derived_gstr1_periodical_summary)
                current_period
        WHERE financial_year = (SELECT MAX(CASE 
                        WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                        ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                    END) FROM derived_gstr1_periodical_summary)) A

    LEFT JOIN 

        (SELECT * FROM 
        (SELECT
                    Total_Iv as previous_iv,
                    MONTH(`month`) as previous_month,
                    YEAR(`month`) as previous_year,
                    CASE 
                        WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                        ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                    END AS financial_year,
                    `month` AS months
                FROM derived_gstr1_periodical_summary)
                current_period
    WHERE financial_year = (SELECT MAX(
                                CASE 
                                WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`) - 1, '-', YEAR(`month`)) 
                                  ELSE CONCAT(YEAR(`month`)-2, '-', YEAR(`month`)-1) 
                                END) 
                            FROM derived_gstr1_periodical_summary)
                            ) B

    ON A.previous_year = B.previous_year 
    AND A.current_month = B.previous_month
    WHERE ((A.current_iv - B.previous_iv) / B.previous_iv > .15) > 0) AS compare_tiv,
    
    
    (SELECT COUNT(value) AS compare_ttv

        FROM

        (SELECT 
            CASE
                WHEN  (`current_tv` - lag(`current_tv`, 2) over (ORDER BY CID)) < 0 
                THEN 1
                ELSE 0
            END AS value
        FROM 
            (SELECT * FROM 
            (SELECT
                        `id` AS CID,
                        `Total_TV` as current_tv,
                        MONTH(`month`) as current_month,
                        YEAR(`month`) as current_year,
                        YEAR(`month`) - 1 as previous_year,
                        CASE 
                            WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                            ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                        END AS financial_year,
                        `month` AS months
                    FROM derived_gstr1_periodical_summary)
                    current_period
            WHERE financial_year = (SELECT MAX(CASE 
                            WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                            ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                        END) FROM derived_gstr1_periodical_summary)) A

        LEFT JOIN 

            (SELECT * FROM 
            (SELECT
                        `id`AS PID,
                        `Total_TV` as previous_tv,
                        MONTH(`month`) as previous_month,
                        YEAR(`month`) as previous_year,
                        CASE 
                            WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                            ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                        END AS financial_year,
                        `month` AS months
                    FROM derived_gstr1_periodical_summary)
                    current_period
                WHERE financial_year = (SELECT MAX(
                                    CASE 
                                    WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`) - 1, '-', YEAR(`month`)) 
                                      ELSE CONCAT(YEAR(`month`)-2, '-', YEAR(`month`)-1) 
                                    END) 
                                FROM derived_gstr1_periodical_summary)
                                ) B

        ON A.previous_year = B.previous_year 
        AND A.current_month = B.previous_month) AS C
        WHERE value > 0
     ) AS compare_ttv,
    
    (SELECT COUNT(*) AS payment_null_0
        FROM gstr3b_periodical_summary
        WHERE Interest_Payment IS NULL OR Interest_Payment = 0
     ) AS payment_null_0,

    (SELECT COUNT(*) AS late_fee_null_0
     FROM gstr3b_periodical_summary
     WHERE Late_Fee IS NULL OR Late_Fee = 1
    ) AS late_fee_null_0,


    (SELECT COUNT(*) AS credit_transaction_amount
     FROM (
         SELECT 
         total_of_credit_transactions_amount AS transactions_amount,
         lag(total_of_credit_transactions_amount, 2) over (ORDER BY id) AS pre_2,
         (total_of_credit_transactions_amount - lag(total_of_credit_transactions_amount, 2) over (ORDER BY id)) / (lag(total_of_credit_transactions_amount, 2) over (ORDER BY id)) AS credit_transaction_amount
         FROM analysis
     ) AS subquery
     WHERE credit_transaction_amount < .15
    ) AS credit_transaction_amount,
    
    
    (
	SELECT COUNT(*)
	FROM
	(SELECT 
    		YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS year,
    		IF(MONTH(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) <= 6, 1, 2) AS half_year,
    		COUNT(*) AS outward_bounce_count
	FROM 
    		analysis
	WHERE 
    		total_no_cheque_bounce_outward > 0 AND YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) IS NOT NULL
	GROUP BY 
    		year, IF(MONTH(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) <= 6, 1, 2)) A
     ) AS cheque_bounce_outward,
    
    
    (
	SELECT COUNT(*)

	FROM

	(SELECT 
    		YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS year,
    		QUARTER(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS quarter,
    		COUNT(*) AS inward_bounce_count
	FROM 
    		analysis
	WHERE 
    		total_no_of_cheque_bounce_inward > 0 
    	AND YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) IS NOT NULL
	GROUP BY 
    		year, quarter) A
     ) AS cheque_bounce_inward,
    
    (
	SELECT COUNT(*)
	FROM
	(SELECT 
        	YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS year,
        	QUARTER(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS quarter,
        	COUNT(*) AS bounce_count
    	FROM 
        	analysis
   	WHERE 
        	total_no_technical_cheque_bounce > 0 
        	AND YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) IS NOT NULL
    	GROUP BY 
        	year, quarter
	) A

    ) AS tech_cheque_bounce_inward,
    
    
    (SELECT COUNT(*)
	FROM
	(
    	SELECT 
    		YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS year,
    		QUARTER(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS quarter,
    		COUNT(*) AS bounce_count
    	FROM 
        	analysis
    	WHERE 
        	total_no_non_technical_cheque_bounce > 0 
        	AND YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) IS NOT NULL
    	GROUP BY 
        	year, quarter
	) A
     ) AS non_tech_cheque_bounce_inward,
    
    
    (SELECT COUNT(cash_withdrawal) AS cash_withdrawal
        FROM (
            SELECT 
                `total_of_cash_withdrawals_amount`,
                (`total_of_cash_withdrawals_amount` - lag(`total_of_cash_withdrawals_amount`, 1) over (ORDER BY id)) / (lag(`total_of_cash_withdrawals_amount`, 1) over (ORDER BY id)) AS cash_withdrawal
            FROM analysis
        ) AS subquery
        WHERE `total_of_cash_withdrawals_amount` IS NOT NULL AND `total_of_cash_withdrawals_amount` != 0 AND cash_withdrawal > .10
    ) AS cash_withdrawal
);
";


$res = $conn->query($query);

if($res){
	$_SESSION['success'] = "Analysis Data Insert success";
}else{
	$_SESSION['error'] = "Opps! Something went wrong.";            	
}

header('Location: index.php');