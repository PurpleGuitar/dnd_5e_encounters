<?php

function getEncounterMultipliers() {
    $table = array();
    if (($handle = fopen("data/encounter_multipliers.csv", "r")) !== FALSE) {
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
                $table_row["Index"] = $data[$col_names_to_numbers["Index"]];
                $table_row["Min"] = $data[$col_names_to_numbers["Min"]];
                $table_row["Max"] = $data[$col_names_to_numbers["Max"]];
                $table_row["Multiplier"] = $data[$col_names_to_numbers["Multiplier"]];
                $table[$data[$col_names_to_numbers["Index"]]] = $table_row;
            }
        }
        fclose($handle);
    }
    return $table;
}

function lookupEncounterMultiplier($quantity) {
    global $ENCOUNTER_MULTIPLIERS;
    foreach ($ENCOUNTER_MULTIPLIERS as $encounter_multiplier) {
        if ($quantity >= $encounter_multiplier["Min"] && $quantity <= $encounter_multiplier["Max"]) {
            return $encounter_multiplier["Multiplier"];
        }
    }
    return 1;
}

// Global variable
$ENCOUNTER_MULTIPLIERS = getEncounterMultipliers();

?>
