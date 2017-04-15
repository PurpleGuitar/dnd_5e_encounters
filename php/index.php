<html>
<head>
    <title>D&D 5e Encounter Tools</title>
</head>
<body>

<h1>Your Party</h1>

<p>Please choose how many characters are in your party, and what level they are:</p>

<form method="GET" action="">
    <table>
        <tr>
            <th>Quantity</th>
            <th>Level</th>
        </tr>
        <tr>
            <td>
                <select name="quantity" value="1">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                </select>
            </td>
            <td>
                <select name="level" value="1">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                </select>
            </td>
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

    <p>OK, you have <?php echo $_GET['quantity'] ?> level <?php echo $_GET['level']?> characters in your party.</p>

</body>
