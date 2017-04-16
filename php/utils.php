<?php

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
