<html>
<head>
    <title>D&D 5e Encounter Tools</title>
</head>
<body>

<?php

/* Grab quantity if specified */
$quantity = 1;
if (isset($_GET['quantity']) && !empty($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
}

/* Grab level if specified */
$level = 1;
if (isset($_GET['level']) && !empty($_GET['level'])) {
    $level = $_GET['level'];
}

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
        <tr>
            <td> <?php createIntegerDropDown("quantity",1,10,$quantity); ?> </td>
            <td> <?php createIntegerDropDown("level",1,20,$quantity); ?> </td>
        </tr>
    </table>
    <input type="submit"></input>
</form>
    
<?php

/* If quantity isn't specified, don't load the rest of the page. */
if (!isset($_GET['quantity']) || empty($_GET['quantity'])) {
    return;
}

/* If level isn't specified, don't load the rest of the page. */
if (!isset($_GET['level']) || empty($_GET['level'])) {
    return;
}

?>

<p>OK, you have 
    <?php echo $_GET['quantity'] ?> 
    level <?php echo $_GET['level']?> 
    character(s) in your party.</p>

</body>
