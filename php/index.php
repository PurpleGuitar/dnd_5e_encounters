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
    


</body>
</html>
