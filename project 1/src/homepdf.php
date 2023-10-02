<?php
require '../vendor/autoload.php';

// $dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv =Dotenv\Dotenv::createImmutable( __DIR__ . '/');
$dotenv->load();


$host     = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname   = $_ENV['DB_NAME'];

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}

$query = "SELECT voornaam, achternaam, email, telefoon FROM studenten";
$result = $conn->query($query);


use Dompdf\Dompdf;
use Dompdf\Options;


$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isRemoteEnabled', true);


$dompdf = new Dompdf($options);




  
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Studentenlijst PDF</title>
    <style>

      
        
       ul {
            border-collapse: collapse;

        }
        li{
            border: 1px solid black;
        }
        h1{
            text-align: center;
            color: balck;  // uihkjkj

        }
        ol{
            text-align: center;
            padding: 8px;
        }
                
          

    </style>
</head>
<body>
    <h1>Studentenlijst</h1>



    <ul>            
';
       

$query = "SELECT * FROM studenten";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<li>';
        $html .= '<ol>' . 'Naam: '. $row['voornaam'] . ' ' . $row['achternaam'] . '</ol>';
        $html .= '<ol>' . 'Email: '. $row['email'] . '</ol>';
        $html .= '<ol>' . 'telefoon: '. $row['telefoon'] . '</ol>';
        $html .= '</li>';
    }
}

$html .= '
    </ul>
</body>
</html>';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream("studentenlijst.pdf");

$conn->close();
?>