<?php

function getXpThresholds() {
    $xp_thresholds = array();
    if (($handle = fopen("data/xp_thresholds.csv", "r")) !== FALSE) {
        $row = 0;
        $col_names_to_numbers = array();
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $row++;
            $num_cols = count($data);
            // Handle header row
            if ($row == 1) {
                for ($col = 0; $col < $num_cols; $col++) {
                    $name = $data[$col];
                    $col_names_to_numbers[$name] = $col;
                }
                continue;
            } 
            // Handle data row
            for ($col = 0; $col < $num_cols; $col++) {
                $table_row = array();
                $table_row["Easy"] = $data[$col_names_to_numbers["Easy"]];
                $table_row["Medium"] = $data[$col_names_to_numbers["Medium"]];
                $table_row["Hard"] = $data[$col_names_to_numbers["Hard"]];
                $table_row["Deadly"] = $data[$col_names_to_numbers["Deadly"]];
                $xp_thresholds[$data[$col_names_to_numbers["Level"]]] = $table_row;
            }
        }
        fclose($handle);
    }
    return $xp_thresholds;
}

// Global variable
$XP_THRESHOLDS = getXpThresholds(); 

?>
