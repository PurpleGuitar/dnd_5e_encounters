<?php

function getCRToXP() {
    $table = array();
    if (($handle = fopen("data/cr_to_xp.csv", "r")) !== FALSE) {
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
                $table[$data[$col_names_to_numbers["CR"]]] = $data[$col_names_to_numbers["XP"]];
            }
        }
        fclose($handle);
    }
    return $table;
}

// Global variable
$CR_TO_XP = getCRToXP();

?>
