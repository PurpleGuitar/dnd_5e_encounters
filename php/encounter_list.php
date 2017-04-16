<?php 
require_once("xp_budget.php");
require_once("encounter_multipliers.php");
require_once("cr_to_xp.php"); 
?>

<h1>Encounter List</h1>

<?php

print_r($CR_TO_XP);
print_r($CR_KEYS);

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
            echo "before: ";
            print_r($creatures);

            array_push($creatures, 0);
            echo " After: ";
            print_r($creatures);
            echo "<br/>";
        }
        if ($creatures[$current_cr_index] < $max_quantity) {
            $creatures[$current_cr_index]++;
            $still_incrementing = false;
        } else {
            $current_cr_index++;
            if ($current_cr_index >= count($CR_KEYS)) {
                $still_incrementing = false;
            }
        }

    }
    print_r($creatures);
    echo "<br/>";




    // handbrake
    if ($iterations >= 25) {
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
</table>
