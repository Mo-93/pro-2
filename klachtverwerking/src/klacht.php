<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>


<?php 

require '../vendor/autoload.php';

?> 


<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $firstname = htmlspecialchars($_POST["firstname"]);
    $Email = htmlspecialchars($_POST["Email"]);
    $klacht = htmlspecialchars($_POST["klacht"]);

   
    echo "<h1>Uw klacht is in behandeling</h1>";
    echo "<br>";
    echo "<h2>$firstname</h2>";
    echo "<br>";
    echo "<h2>$Email</h2>";


}


?>