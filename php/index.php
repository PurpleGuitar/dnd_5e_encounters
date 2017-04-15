<html>
<head>
    <title>D&D 5e Encounter Tools</title>
</head>
<body>

<h1>Your Party</h1>

<form method="POST" action="">
    <input type="text" name="name" value="Your name"></input>
    <input type="submit"></input>
</form>
    
<?php
if (isset($_POST['name']) && !empty($_POST['name'])) {
    echo 'Welcome, ' . $_POST['name'];
}

?>

</body>
