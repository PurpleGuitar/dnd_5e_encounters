<html>
<head>
    <title>D&D 5e Encounter Tools</title>
</head>
<body>

<?php

require_once("utils.php");

/* process quantity parameters */
$quantity = array(1,0,0,0,0);
if (isset($_GET['quantity']) && !empty($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
}

/* process level parameters */
$level = array(1,2,3,4,5);
if (isset($_GET['level']) && !empty($_GET['level'])) {
    $level = $_GET['level'];
}

/* process filter */
$dont_filter_difficulty = false;
if (isset($_GET['dont_filter_difficulty']) && !empty($_GET['dont_filter_difficulty'])) {
    $dont_filter_difficulty = true;
}

?>

<h1>Your Party</h1>

<p>Please choose how many characters are in your party, and what level they are:</p>

<form method="GET" action="">
    <table>
        <tr>
            <th>Quantity</th>
            <th>Level</th>
        </tr>
        <?php
        for ($i = 0; $i < 5; $i++) {
            echo "\n<tr>";
            echo "\n<td>";
            createIntegerDropDown("quantity[]",0,10,$quantity[$i]);
            echo "</td>";
            echo "\n<td>";
            createIntegerDropDown("level[]",1,20,$level[$i]);
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <input type="checkbox" name="dont_filter_difficulty"
        <?php if ($dont_filter_difficulty) {?>checked="checked"<?php } ?> 
        >Show encounters that are too easy or too hard</input><br/>
    <input type="submit" value="Calculate!"></input>
</form>

<?php
/* Don't print reports if user didn't click submit yet */
if (!isset($_GET['quantity']) || empty($_GET['quantity'])) {
    echo "</body>";
    echo "</html>";
    return;
}
?>

<?php include("xp_budget.php"); ?>
<?php include("encounter_list.php"); ?>

</body>
</html>
