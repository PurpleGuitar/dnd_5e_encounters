<?php 
require_once("xp_budget.php");
require_once("encounter_multipliers.php");
require_once("cr_to_xp.php"); 
?>

<h1>Encounter List</h1>

<?php

$max_quantity = 20;
$encounter_list = array();

// Search combinations
$creatures = array();
$iterations = 0;
$still_searching = true;
while ($still_searching) {
    $iterations++;

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
    $encounter["Encounter"] = "";
    $encounter["Reward XP"] = 0;
    for ($i = 0; $i < count($creatures); $i++) {
        $quantity = $creatures[$i];
        if ($quantity > 0) {
            $cr_name = $CR_KEYS[$i];
            $xp_value = $CR_TO_XP[$cr_name];
            if (strlen($encounter["Encounter"]) > 0) {
                $encounter["Encounter"] .= "; ";
            }
            $encounter["Encounter"] .= $quantity . " " . CR . " " . $cr_name;
            $encounter["Reward XP"] += $xp_value * $quantity;
        }
    }
    array_push($encounter_list, $encounter);

    // Emergency brake
    if ($iterations >= 5) {
        $still_searching = false;
    }
}

?>

<table>
    <tr>
        <th>Difficulty</th>
        <th>Encounter</th>
        <th>Reward XP</th>
        <th>Party Size Multiplier</th>
        <th>Encounter Size Multiplier</th>
        <th>Difficulty XP</th>
    </tr>
<?php
foreach ($encounter_list as $encounter) {
    echo "<tr>";
    echo "<td></td>";
    echo "<td>".$encounter["Encounter"]."</td>";
    echo "<td>".$encounter["Reward XP"]."</td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "</tr>";
}
?>
</table>
