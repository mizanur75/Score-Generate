<?php 
session_start();
ini_set('max_execution_time',-1);
ini_set('memory_limit',-1);

require 'db.php';


$query = "INSERT INTO `data_analysis`(`ref_id`,`b2b_iv`, `b2c_liv`,`b2c_siv`,`export_iv`,`sci_gst`,`tax_zero_outware`,`tax_nill_outware`,`tax_paid_in_credit`,`latest_fy_iv`, `pre_fy_iv`,`total_iv_flag`,`compare_tiv`,`compare_ttv`,`payment_null_0`,`late_fee_null_0`,`credit_transaction_amount`,`cheque_bounce_outward`,`cheque_bounce_inward`,`tech_cheque_bounce_inward`,`non_tech_cheque_bounce_inward`,`cash_withdrawal`)

    SELECT ref.`ref_id`,`b2b_iv`, `b2c_liv`,`b2c_siv`,`export_iv`,`sci_gst`,`tax_zero_outware`,`tax_nill_outware`,`tax_paid_in_credit`,`latest_fy_iv`, `pre_fy_iv`,`total_iv_flag`,`compare_tiv`,`compare_ttv`,`payment_null_0`,`late_fee_null_0`,`credit_transaction_amount`,`cheque_bounce_outward`,`cheque_bounce_inward`,`tech_cheque_bounce_inward`,`non_tech_cheque_bounce_inward`,`cash_withdrawal` FROM (
        (SELECT DISTINCT ref_id FROM 
            derived_gstr1_periodical_summary
        )AS ref

        LEFT JOIN
        
        -- B2B invoice value
        (SELECT ref_id, COUNT(b2b_iv) AS b2b_iv FROM (
            SELECT ref_id,
                (b2b_iv_by_total_value - lag(b2b_iv_by_total_value, 2) over (ORDER BY id)) / (lag(b2b_iv_by_total_value, 2) over (ORDER BY id)) AS b2b_iv
            FROM derived_gstr1_periodical_summary
        ) AS subquery_b2b_iv
        WHERE b2b_iv > .15) AS b2b_iv ON ref.ref_id = b2b_iv.ref_id

        LEFT JOIN 

        -- B2C large invoice value
        (SELECT ref_id, COUNT(b2c_liv) as b2c_liv FROM (
            SELECT ref_id, 
                (b2c_liv_by_total_value - lag(b2c_liv_by_total_value, 2) over (ORDER BY id)) / (lag(b2c_liv_by_total_value, 2) over (ORDER BY id)) AS b2c_liv
            FROM derived_gstr1_periodical_summary
        ) AS subquery
        WHERE b2c_liv > .15) AS b2c_liv ON ref.ref_id = b2c_liv.ref_id
        
        LEFT JOIN 
        
        -- B2C small invoice value
        (SELECT ref_id, COUNT(b2c_siv) AS b2c_siv FROM (
            SELECT ref_id, 
                (b2c_siv_by_total_value - lag(b2c_siv_by_total_value, 2) over (ORDER BY id)) / (lag(b2c_siv_by_total_value, 2) over (ORDER BY id)) AS b2c_siv
            FROM derived_gstr1_periodical_summary
        ) AS subquery
        WHERE b2c_siv > .15) AS b2c_siv ON ref.ref_id = b2c_siv.ref_id
        
        LEFT JOIN 
        
        -- Export total invoice value
        (SELECT ref_id, COUNT(export_iv) AS export_iv FROM (
            SELECT ref_id, (`Export_Iv` - lag(`Export_Iv`, 1) over (ORDER BY id)) / (lag(`Export_Iv`, 1) over (ORDER BY id)) AS export_iv
            FROM derived_gstr1_periodical_summary
        ) AS subquery
        WHERE Export_Iv IS NOT NULL AND Export_Iv != 0 AND export_iv > .15) AS export_iv ON ref.ref_id = export_iv.ref_id
        
        LEFT JOIN 
        

        -- SGST total taxable value
        (SELECT ref_id, COUNT(sci_gst) AS sci_gst FROM (
             SELECT ref_id, ((`SGST`+`CGST`-`IGST`) - lag((`SGST`+`CGST`-`IGST`), 2) over (ORDER BY id)) / lag((`SGST`+`CGST`-`IGST`),2) over (ORDER BY id) AS sci_gst FROM gstr3b_periodical_summary
        ) AS subquery
        WHERE sci_gst > .15) AS sci_gst ON ref.ref_id = sci_gst.ref_id
        
        LEFT JOIN 

        -- Outward taxable supplies (zero rated)
        (SELECT ref_id, COUNT(tax_zero_outware) AS tax_zero_outware FROM (
            SELECT ref_id, (`Total_Tax_Zero_rated_Outward_taxable_supplies` - lag(Total_Tax_Zero_rated_Outward_taxable_supplies, 2) over (ORDER BY id)) / (lag(Total_Tax_Zero_rated_Outward_taxable_supplies,2) over (ORDER BY id)) AS tax_zero_outware FROM gstr3b_periodical_summary
        ) AS subquery
        WHERE tax_zero_outware > .15) AS tax_zero_outware ON ref.ref_id = tax_zero_outware.ref_id
        
        LEFT JOIN 
        
        -- Outward taxable supplies (Nil rated, exempted)
        (SELECT ref_id, COUNT(tax_nill_outware) AS tax_nill_outware FROM (
            SELECT ref_id, (`Total_Tax_nill_rated_Outward_taxable_supplies` - lag(Total_Tax_nill_rated_Outward_taxable_supplies, 2) over (ORDER BY id)) / (lag(Total_Tax_nill_rated_Outward_taxable_supplies,2) over (ORDER BY id)) AS tax_nill_outware FROM gstr3b_periodical_summary
        ) AS subquery
        WHERE tax_nill_outware > .15) AS tax_nill_outware ON ref.ref_id = tax_nill_outware.ref_id
        
        LEFT JOIN 
        
        -- Tax paid In Credit
        (SELECT ref_id, COUNT(tax_paid_in_cred) AS tax_paid_in_credit FROM (
            SELECT *, (`paid_by_total` - lag(paid_by_total, 2) over (ORDER BY id)) /  lag(paid_by_total,2) over (ORDER BY id) AS tax_paid_in_cred FROM(
                    SELECT id, ref_id, Tax_Paid_In_Credit, Total_Tax_Paid, Tax_Paid_In_Credit / Total_Tax_Paid AS paid_by_total FROM  gstr3b_periodical_summary) AS gstr3
        ) AS P
        WHERE p.tax_paid_in_cred > .15) AS tax_paid_in_credit ON ref.ref_id = tax_paid_in_credit.ref_id
        
        LEFT JOIN 

        -- Latest financial year invoice value
        (SELECT ref_id, SUM(Total_Iv) AS latest_fy_iv FROM (
            SELECT ref_id, Total_Iv,
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
                SELECT MAX(financial_year) FROM (
                    SELECT 
                        CASE 
                            WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`) + 1) 
                            ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                        END AS financial_year
                    FROM derived_gstr1_periodical_summary
                ) AS subquery
            )
        ) AS latest_fy_iv ON ref.ref_id = latest_fy_iv.ref_id
        
        LEFT JOIN 
        
        -- Previous Financial year invoice value
        (SELECT * FROM (
            SELECT ref_id, SUM(Total_Iv) AS pre_fy_iv FROM (
                SELECT ref_id, Total_Iv,
                    CASE 
                        WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                        ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                    END AS financial_year,
                    `month` AS months
                FROM derived_gstr1_periodical_summary
            ) AS subquery

            WHERE MONTH(months) BETWEEN 
                (
                    SELECT MONTH(MIN(`month`)) AS first_month FROM (
                        SELECT 
                            CASE 
                                WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                                ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                            END AS financial_year,
                            `month`
                        FROM derived_gstr1_periodical_summary
                    ) AS subquery
                    WHERE financial_year = (
                        SELECT MAX(financial_year) FROM (
                            SELECT 
                                CASE 
                                    WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                                    ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                                END AS financial_year
                            FROM derived_gstr1_periodical_summary
                        ) AS subquery
                    )
                )
                AND 
                (SELECT MONTH(MAX(`month`)) AS first_month FROM (
                    SELECT 
                        CASE 
                            WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                            ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                        END AS financial_year,
                        `month`
                    FROM derived_gstr1_periodical_summary
                ) AS subquery
                WHERE financial_year = (
                    SELECT MAX(financial_year) FROM (
                        SELECT 
                            CASE 
                                WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                                ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                            END AS financial_year
                        FROM derived_gstr1_periodical_summary
                    ) AS subquery
                )
                )
            AND financial_year < (
                SELECT MAX(financial_year) FROM (
                    SELECT 
                        CASE 
                            WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`) + 1) 
                            ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                        END AS financial_year
                    FROM derived_gstr1_periodical_summary
                ) AS subquery
            )
        ) AS result) AS pre_fy_iv ON ref.ref_id = pre_fy_iv.ref_id
        
        LEFT JOIN 
        
        -- Total Invoice Flag
        (SELECT pre.ref_id, 
            CASE
                WHEN (total_value - previous_total_value) / previous_total_value > .20 
            THEN 1
                ELSE 0
            END AS total_iv_flag FROM (
                (SELECT ref_id, SUM(Total_Iv) AS previous_total_value, previous_financial_year FROM (
                    SELECT ref_id, Total_Iv,
                            CASE 
                              WHEN MONTH(`month`) >= 4 
                            THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                                ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                            END AS previous_financial_year, `month` AS months FROM derived_gstr1_periodical_summary
                    ) AS subquery

                    WHERE MONTH(months) BETWEEN 
                        (SELECT MONTH(MIN(`month`)) AS first_month FROM (
                           SELECT 
                                CASE 
                                    WHEN MONTH(`month`) >= 4 
                                THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                                    ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                                END AS previous_financial_year, `month` FROM derived_gstr1_periodical_summary
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
                        (SELECT MONTH(MAX(`month`)) AS first_month FROM (
                            SELECT 
                                CASE 
                                    WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                                ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                                END AS previous_financial_year, `month` FROM derived_gstr1_periodical_summary
                            ) AS subquery
                            WHERE previous_financial_year = (
                                SELECT MAX(previous_financial_year) FROM (
                                   SELECT 
                                        CASE 
                                            WHEN MONTH(`month`) >= 4 
                                        THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                                            ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                                        END AS financial_year FROM derived_gstr1_periodical_summary
                            ) AS subquery)
                        )
                        AND previous_financial_year < (
                        SELECT MAX(previous_financial_year)FROM (
                            SELECT 
                            CASE 
                                WHEN MONTH(`month`) >= 4 THEN CONCAT(YEAR(`month`), '-', YEAR(`month`) + 1) 
                            ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                                END AS previous_financial_year FROM derived_gstr1_periodical_summary
                        ) AS subquery
                    )
                ) AS pre,

                (SELECT ref_id, SUM(Total_Iv) AS total_value, financial_year FROM (
                        SELECT ref_id, Total_Iv,
                            CASE 
                                WHEN MONTH(`month`) >= 4 
                            THEN CONCAT(YEAR(`month`), '-', YEAR(`month`)+1) 
                                ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                            END AS financial_year, `month` AS months FROM derived_gstr1_periodical_summary
                    ) AS subquery
                    WHERE financial_year = (
                        SELECT MAX(financial_year) FROM (
                            SELECT 
                                CASE 
                                    WHEN MONTH(`month`) >= 4 
                                THEN CONCAT(YEAR(`month`), '-', YEAR(`month`) + 1) 
                                    ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                                END AS financial_year FROM derived_gstr1_periodical_summary
                        ) AS subquery
                    )
                    AND EXISTS (
                      SELECT 1 FROM derived_gstr1_periodical_summary AS latest
                        WHERE financial_year = (
                            SELECT MAX(financial_year) FROM (
                                SELECT 
                                    CASE 
                                        WHEN MONTH(`month`) >= 4 
                                    THEN CONCAT(YEAR(`month`), '-', YEAR(`month`) + 1) 
                                        ELSE CONCAT(YEAR(`month`)-1, '-', YEAR(`month`)) 
                                    END AS financial_year FROM derived_gstr1_periodical_summary
                            ) AS subquery_latest
                        ) 
                        AND MONTH(latest.`month`) = MONTH(subquery.months)
                    )
                ) AS latest_value
            )
        )AS total_iv_flag ON ref.ref_id = total_iv_flag.ref_id
        
        LEFT JOIN 
        
        -- Compare Total invoice value by month (January 2023 - January 2024)
        (SELECT ref_id, COUNT(*) as compare_tiv FROM(
            SELECT ref_id, current_iv, previous_iv, current_month, CASE WHEN previous_iv IS NULL or previous_iv = 0 THEN 0 ELSE ((current_iv - previous_iv)/previous_iv) END AS compare_tiv FROM
            (SELECT * FROM (SELECT ref_id, Total_Iv as current_iv, lag(`Total_Iv`, 12) over (ORDER BY month) AS previous_iv, lag(`month`, 12) over (ORDER BY month) AS previous_month, MONTH(`month`) as current_month, `month` AS months FROM derived_gstr1_periodical_summary
                            ) AS current_period) a
                            
                            WHERE previous_iv IS NOT NULL  
            ) b 
            WHERE compare_tiv > .15
        ) AS compare_tiv ON ref.ref_id = compare_tiv.ref_id
        
        LEFT JOIN 
        
        (SELECT ref_id, COUNT(*) AS compare_ttv FROM(
            SELECT *, CASE 
                        WHEN compare_tv = 1 
                             AND (LAG(compare_tv, 1) OVER (ORDER BY months)) = 1 
                             AND (LAG(compare_tv, 2) OVER (ORDER BY months)) = 1 
                        THEN 1 
                        ELSE 0 
                    END AS is_consecutive FROM(
                    SELECT *, CASE WHEN (current_tv < previous_tv) THEN 1 ELSE 0 END AS compare_tv FROM (SELECT ref_id, Total_TV as current_tv, lag(`Total_TV`, 12) over (ORDER BY month) AS previous_tv, lag(`month`, 12) over (ORDER BY               month) AS previous_month, MONTH(`month`) as current_month, `month` AS months FROM derived_gstr1_periodical_summary
               ) AS current_period
             ) a
         WHERE previous_tv IS NOT NULL
        ) b
        WHERE is_consecutive = 1) AS compare_ttv ON ref.ref_id = compare_ttv.ref_id
        
        LEFT JOIN 
        
        (SELECT ref_id, COUNT(*) AS payment_null_0
            FROM gstr3b_periodical_summary
            WHERE Interest_Payment IS NULL OR Interest_Payment = 0
        ) AS payment_null_0 ON ref.ref_id = payment_null_0.ref_id
        
        LEFT JOIN 

        (SELECT ref_id, COUNT(*) AS late_fee_null_0 FROM gstr3b_periodical_summary
            WHERE Late_Fee IS NULL OR Late_Fee = 1
        ) AS late_fee_null_0 ON ref.ref_id = late_fee_null_0.ref_id
        
        LEFT JOIN 


        (SELECT ref_id, COUNT(*) AS credit_transaction_amount FROM (
            SELECT ref_id, total_of_credit_transactions_amount AS transactions_amount,
                lag(total_of_credit_transactions_amount, 2) over (ORDER BY id) AS pre_2,
                (total_of_credit_transactions_amount - lag(total_of_credit_transactions_amount, 2) over (ORDER BY id)) / (lag(total_of_credit_transactions_amount, 2) over (ORDER BY id)) AS credit_transaction_amount FROM analysis
            ) AS subquery
            WHERE credit_transaction_amount < .15
        ) AS credit_transaction_amount ON ref.ref_id = credit_transaction_amount.ref_id
        
        LEFT JOIN 
        
        
        (SELECT ref_id, COUNT(*) as cheque_bounce_outward FROM (
            SELECT ref_id, YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS year,
                IF(MONTH(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) <= 6, 1, 2) AS half_year, COUNT(*) AS outward_bounce_count
                FROM 
                    analysis
                WHERE 
                    total_no_cheque_bounce_outward > 0 AND YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) IS NOT NULL
                GROUP BY 
                    year, IF(MONTH(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) <= 6, 1, 2)
            ) A
        ) AS cheque_bounce_outward ON ref.ref_id = cheque_bounce_outward.ref_id
        
        LEFT JOIN 
        
        
        (SELECT ref_id, COUNT(*) as cheque_bounce_inward FROM (
            SELECT ref_id, YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS year,
                QUARTER(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS quarter,
                COUNT(*) AS inward_bounce_count
                FROM 
                    analysis
                WHERE 
                    total_no_of_cheque_bounce_inward > 0 
                AND YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) IS NOT NULL
                GROUP BY year, quarter
            ) A
        ) AS cheque_bounce_inward ON ref.ref_id = cheque_bounce_inward.ref_id
        
        LEFT JOIN 
        
        (SELECT ref_id, COUNT(*) as tech_cheque_bounce_inward FROM (
            SELECT ref_id, 
                YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS year,
                QUARTER(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS quarter,
                COUNT(*) AS bounce_count
                FROM 
                    analysis
                WHERE 
                    total_no_technical_cheque_bounce > 0 
                    AND YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) IS NOT NULL
                GROUP BY year, quarter
            ) A

        ) AS tech_cheque_bounce_inward ON ref.ref_id = tech_cheque_bounce_inward.ref_id
        
        LEFT JOIN 
        
        
        (SELECT ref_id, COUNT(*) as non_tech_cheque_bounce_inward FROM (
            SELECT ref_id, 
                YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS year,
                QUARTER(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) AS quarter,
                COUNT(*) AS bounce_count
                FROM 
                    analysis
                WHERE 
                    total_no_non_technical_cheque_bounce > 0 
                    AND YEAR(LAST_DAY(STR_TO_DATE(CONCAT('01-', `Month_Name`), '%d-%M-%Y'))) IS NOT NULL
                GROUP BY year, quarter
            ) A
        ) AS non_tech_cheque_bounce_inward ON ref.ref_id = non_tech_cheque_bounce_inward.ref_id
        
        LEFT JOIN 
        
        
        (SELECT ref_id, COUNT(cash_withdrawal) AS cash_withdrawal FROM (
                SELECT ref_id, `total_of_cash_withdrawals_amount`,
                    (`total_of_cash_withdrawals_amount` - lag(`total_of_cash_withdrawals_amount`, 1) over (ORDER BY id)) / (lag(`total_of_cash_withdrawals_amount`, 1) over (ORDER BY id)) AS cash_withdrawal
                FROM analysis
            ) AS subquery
            WHERE `total_of_cash_withdrawals_amount` IS NOT NULL AND `total_of_cash_withdrawals_amount` != 0 AND cash_withdrawal > .10
        ) AS cash_withdrawal ON ref.ref_id = cash_withdrawal.ref_id
    );
";


$res = $conn->prepare($query);
$res->execute();

if($res){
    $_SESSION['success'] = "Analysis Data Insert success";
}else{
    $_SESSION['error'] = "Opps! Something went wrong.";             
}

header('Location: index.php');