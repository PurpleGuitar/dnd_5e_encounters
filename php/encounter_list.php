<?php 
require_once("xp_budget.php");
require_once("encounter_multipliers.php");
require_once("cr_to_xp.php"); 
?>

<h1>Encounter List</h1>

<?php

$max_quantity = 10;
$encounter_list = array();

// Search combinations
$creatures = array();
$iterations = 0;
$still_searching = true;
while ($still_searching) {

    // Emergency brake
    $iterations++;
    if ($iterations >= 100) {
        $still_searching = false;
    }

    // Increment creature array
    $still_incrementing = true;
    $current_cr_index = 0;
    while ($still_incrementing) {
        if (count($creatures) <= $current_cr_index) {
            array_push($creatures, 0);
        }
        if ($creatures[$current_cr_index] < $max_quantity) {
            $creatures[$current_cr_index]++;
            $still_incrementing = false;
        } else {
            $creatures[$current_cr_index] = 0;
            $current_cr_index++;
            if ($current_cr_index >= count($CR_KEYS)) {
                $still_incrementing = false;
            }
        }
    }


    // Create encounter
    $encounter = array();

    // Description
    $encounter["Encounter"] = "";
    $encounter["Reward XP"] = 0;
    $encounter_quantity = 0;
    for ($i = count($creatures) - 1; $i >= 0; $i--) {
        $quantity = $creatures[$i];
        $encounter_quantity += $quantity;
        if ($quantity > 0) {
            $cr_name = $CR_KEYS[$i];
            $xp_value = $CR_TO_XP[$cr_name];
            if (strlen($encounter["Encounter"]) > 0) {
                $encounter["Encounter"] .= "; ";
            }
            $encounter["Encounter"] .= $quantity . " CR " . $cr_name;
            $encounter["Reward XP"] += $xp_value * $quantity;
        }
    }

    // Party size adjustment
    $party_size_adjustment = 0;
    if ($QUANTITY_TOTAL < 3) {
        $party_size_adjustment += 1;
    } elseif ($QUANTITY_TOTAL >= 6) {
        $party_size_adjustment -= 1;
    }

    // Encounter size multiplier
    $encounter_size_multiplier = lookupEncounterMultiplier($encounter_quantity + $party_size_adjustment);
    $encounter["Difficulty Multiplier"] = "x" . $encounter_size_multiplier;
    if ($party_size_adjustment != 0) {
        $encounter["Difficulty Multiplier"] .= " (";
        if ($party_size_adjustment > 0) {
            $encounter["Difficulty Multiplier"] .= "+";
        }
        $encounter["Difficulty Multiplier"] .= $party_size_adjustment . " for party size)";
    }

    // Difficulty XP
    $encounter["Difficulty XP"] = $encounter["Reward XP"] * $encounter_size_multiplier;

    // Filter out inappropriate encounters
    if ($dont_filter_difficulty == false) {
        if ($encounter["Difficulty XP"] < $XP_BUDGET_TOTAL["Easy"]) {
            continue;
        }
        if ($encounter["Difficulty XP"] > $XP_BUDGET_TOTAL["Deadly"]) {
            continue;
        }
    }

    // Done
    array_push($encounter_list, $encounter);

}

?>

<table>
    <tr>
        <th>Difficulty</th>
        <th>Encounter</th>
        <th>Reward XP</th>
        <th>Difficulty Multiplier</th>
        <th>Difficulty XP</th>
    </tr>
<?php
foreach ($encounter_list as $encounter) {
    echo "<tr>";
    echo "<td></td>";
    echo "<td>".$encounter["Encounter"]."</td>";
    echo "<td>".$encounter["Reward XP"]."</td>";
    echo "<td>".$encounter["Difficulty Multiplier"]."</td>";
    echo "<td>".$encounter["Difficulty XP"]."</td>";
    echo "</tr>";
}
?>
</table>
