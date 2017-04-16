<?php 
require("xp_thresholds.php");
?>

<h1>XP Budget</h1>

<table>
    <tr>
        <th></th>
        <th>Quantity</th>
        <th>Level</th>
        <th>Easy</th>
        <th>Medium</th>
        <th>Hard</th>
        <th>Deadly</th>
    </tr>
<?php
$quantity_total = 0;
$xp_budget_total = array();
for ($i = 0; $i < count($quantity); $i++) {
    if ($quantity[$i] > 0) {
        $quantity_total += $quantity[$i];
        echo "<tr>";
        echo "<td></td>";
        echo "<td>";
        echo $quantity[$i];
        echo "</td>";
        echo "<td>";
        echo $level[$i];
        echo "</td>";
        echo "<td>";
        $xp_budget = $XP_THRESHOLDS[$level[$i]]["Easy"] * $quantity[$i];
        echo $xp_budget;
        $xp_budget_total["Easy"] += $xp_budget;
        echo "</td>";
        echo "<td>";
        $xp_budget = $XP_THRESHOLDS[$level[$i]]["Medium"] * $quantity[$i];
        echo $xp_budget;
        $xp_budget_total["Medium"] += $xp_budget;
        echo "</td>";
        echo "<td>";
        $xp_budget = $XP_THRESHOLDS[$level[$i]]["Hard"] * $quantity[$i];
        echo $xp_budget;
        $xp_budget_total["Hard"] += $xp_budget;
        echo "</td>";
        echo "<td>";
        $xp_budget = $XP_THRESHOLDS[$level[$i]]["Deadly"] * $quantity[$i];
        echo $xp_budget;
        $xp_budget_total["Deadly"] += $xp_budget;
        echo "</td>";
        echo "</tr>";
    }
}
echo "<tr>";
echo "<td>TOTAL:</td>";
echo "<td>". $quantity_total . "</td>";
echo "<td></td>";
echo "<td>" . $xp_budget_total["Easy"] . "</td>";
echo "<td>" . $xp_budget_total["Medium"] . "</td>";
echo "<td>" . $xp_budget_total["Hard"] . "</td>";
echo "<td>" . $xp_budget_total["Deadly"] . "</td>";
?>
</table>
