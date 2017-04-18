<?php 
require_once("xp_budget.php");
require_once("encounter_multipliers.php");
require_once("cr_to_xp.php"); 
?>

<h1>Encounter List</h1>

<?php

// Qualitative difficulty
$bp_min_easy = $XP_BUDGET_TOTAL["Easy"];
$bp_min_medium = ($XP_BUDGET_TOTAL["Easy"] + $XP_BUDGET_TOTAL["Medium"]) / 2;
$bp_min_hard = ($XP_BUDGET_TOTAL["Medium"] + $XP_BUDGET_TOTAL["Hard"]) / 2;
$bp_min_deadly = ($XP_BUDGET_TOTAL["Hard"] + $XP_BUDGET_TOTAL["Deadly"]) / 2;

// Max quantity per group (should be settable?)
$max_quantity = 5;

// Search combinations
$encounter_list = array();
$creatures = array();
$iterations = 0;
$still_searching = true;
while ($still_searching) {

    // Emergency brake
    $iterations++;
    if ($iterations >= 100000) {
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
    $encounter["Difficulty XP"] = ceil($encounter["Reward XP"] * $encounter_size_multiplier);

    // Qualitative difficulty
    if ($encounter["Difficulty XP"] < $bp_min_easy) {
        $encounter["Difficulty"] = "Too Easy";
    } elseif ($encounter["Difficulty XP"] < $bp_min_medium) {
        $encounter["Difficulty"] = "Easy";
    } elseif ($encounter["Difficulty XP"] < $bp_min_hard) {
        $encounter["Difficulty"] = "Medium";
    } elseif ($encounter["Difficulty XP"] < $bp_min_deadly) {
        $encounter["Difficulty"] = "Hard";
    } elseif ($encounter["Difficulty XP"] <= $XP_BUDGET_TOTAL["Deadly"]) {
        $encounter["Difficulty"] = "Deadly";
    } else {
        $encounter["Difficulty"] = "Too Deadly";
    }


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

function sort_encounters_by_difficulty_xp($a, $b) {
    return $a["Difficulty XP"] - $b["Difficulty XP"];
}

// Sort encounter list by difficulty XP
usort($encounter_list, sort_encounters_by_difficulty_xp);


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
    echo "<td>".$encounter["Difficulty"]."</td>";
    echo "<td>".$encounter["Encounter"]."</td>";
    echo "<td>".$encounter["Reward XP"]."</td>";
    echo "<td>".$encounter["Difficulty Multiplier"]."</td>";
    echo "<td>".$encounter["Difficulty XP"]."</td>";
    echo "</tr>";
}
?>
</table>
