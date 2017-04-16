<?php 
require_once("xp_thresholds.php");
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
$QUANTITY_TOTAL = 0;
$XP_BUDGET_TOTAL = array();
$XP_BUDGET_TOTAL["Easy"] = 0;
$XP_BUDGET_TOTAL["Medium"] = 0;
$XP_BUDGET_TOTAL["Hard"] = 0;
$XP_BUDGET_TOTAL["Deadly"] = 0;
for ($i = 0; $i < count($quantity); $i++) {
    if ($quantity[$i] > 0) {
        $QUANTITY_TOTAL += $quantity[$i];
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
        $XP_BUDGET_TOTAL["Easy"] += $xp_budget;
        echo "</td>";
        echo "<td>";
        $xp_budget = $XP_THRESHOLDS[$level[$i]]["Medium"] * $quantity[$i];
        echo $xp_budget;
        $XP_BUDGET_TOTAL["Medium"] += $xp_budget;
        echo "</td>";
        echo "<td>";
        $xp_budget = $XP_THRESHOLDS[$level[$i]]["Hard"] * $quantity[$i];
        echo $xp_budget;
        $XP_BUDGET_TOTAL["Hard"] += $xp_budget;
        echo "</td>";
        echo "<td>";
        $xp_budget = $XP_THRESHOLDS[$level[$i]]["Deadly"] * $quantity[$i];
        echo $xp_budget;
        $XP_BUDGET_TOTAL["Deadly"] += $xp_budget;
        echo "</td>";
        echo "</tr>";
    }
}
echo "<tr>";
echo "<td>TOTAL:</td>";
echo "<td>". $QUANTITY_TOTAL . "</td>";
echo "<td></td>";
echo "<td>" . $XP_BUDGET_TOTAL["Easy"] . "</td>";
echo "<td>" . $XP_BUDGET_TOTAL["Medium"] . "</td>";
echo "<td>" . $XP_BUDGET_TOTAL["Hard"] . "</td>";
echo "<td>" . $XP_BUDGET_TOTAL["Deadly"] . "</td>";
?>
</table>
