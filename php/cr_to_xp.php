<?php

$CR_TO_XP = array();
$CR_KEYS = array();

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
        $cr = $data[$col_names_to_numbers["CR"]];
        $CR_TO_XP[$cr] = $data[$col_names_to_numbers["XP"]];
        array_push($CR_KEYS, $cr);
    }
    fclose($handle);
}


?>
