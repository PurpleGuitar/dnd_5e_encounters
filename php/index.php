<html>
<head>
    <title>D&D 5e Encounter Tools</title>
</head>
<body>

<?php

/* Grab quantity if specified */
$quantity = array(4,0,0,0,0);
if (isset($_GET['quantity']) && !empty($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
}

/* Grab level if specified */
$level = array(1,2,3,4,5);
if (isset($_GET['level']) && !empty($_GET['level'])) {
    $level = $_GET['level'];
}

/* Function to create an integer-based drop-down field. */
function createIntegerDropDown($name, $minValue, $maxValue, $selectedValue) {
    echo "<select";
    echo " name='$name'";
    echo ">";
    for ($value = $minValue; $value <= $maxValue; $value++) {
        echo "<option";
        echo " value='$value'";
        if ($value == $selectedValue) {
            echo " selected='selected'";
        }
        echo ">";
        echo $value;
        echo "</option>";
    }
    echo "</select>";
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
    <input type="submit"></input>
</form>

<?php
/* Don't print report if user didn't click submit yet */
if (!isset($_GET['quantity']) || empty($_GET['quantity'])) {
    echo "</body>";
    echo "</html>";
    return;
}
?>

<h1>Encounter Reports</h2>

<h2>Party Size</h2>

<p>Your party consists of:</p>
<ul>
<?php
for ($i = 0; $i < count($quantity); $i++) {
    if ($quantity[$i] > 0) {
        echo "<li>";
        echo $quantity[$i];
        echo " level ";
        echo $level[$i];
        echo " character";
        if ($quantity[$i] > 1) {
            echo "s";
        }
        echo "</li>";
    }
}
?>
</ul>

<h2>XP Budget</h2>

<?php
$xp_thresholds = array();
if (($handle = fopen("data/xp_thresholds.csv", "r")) !== FALSE) {
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
            $table_row["Easy"] = $data[$col_names_to_numbers["Easy"]];
            $table_row["Medium"] = $data[$col_names_to_numbers["Medium"]];
            $table_row["Hard"] = $data[$col_names_to_numbers["Hard"]];
            $table_row["Deadly"] = $data[$col_names_to_numbers["Deadly"]];
            $xp_thresholds[$data[$col_names_to_numbers["Level"]]] = $table_row;
        }
    }
    fclose($handle);
}
?>

</body>
</html>
