<?php



 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

 require '../vendor/autoload.php';

 // $dotenv = Dotenv\Dotenv::createImmutable('./');
 $dotenv = Dotenv\Dotenv::createImmutable( __DIR__ . '/');
 $dotenv->load();

 session_start();


$host= $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];


// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


      $voornaam= $row["voornaam"];
      $achternaam=  $row["achternaam"];
      $telefoon =  $row["telefoon"];
      $email =  $row["email"];
      $foto =  $row["foto"];

      }


}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="index.js"></script>
  <link rel="stylesheet" href="st.css">
  <link rel="stylesheet" href="homepdf.php">
  <link rel="stylesheet" href="homecsv.php">
  


  <title> ouer teams</title>
</head>
<body>

<!--start navbar-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#"><h5>Home</h5> <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="homepdf.php">exporteer naar PDF</a>
          <a class="dropdown-item" href="homecsv.php">exporteer naar csv</a>
          <div class="dropdown-divider">contact</div>
          <a class="dropdown-item" href="klachtverwerking/src/index.php">klacht</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>
    </ul>


<form class="form-inline my-2 my-lg-0" method="POST">

    <input class="form-control mr-sm-2"  type="text" placeholder="zoek student" name="zoeken" id="zoekbalk">
    <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="zoek" value="zoeken" id="zoek">
    <button onclick='toggleinfo(this)' type="submit" name="sortAZ"  class="az btn btn-outline-danger my-2 my-sm-0">A-Z</button>
    <button onclick='toggleinfo(this)'  type="submit" name="sortZA"  class="az btn btn-outline-danger my-2 my-sm-0">Z-A</button>

</form>

  </div>

</nav>

<!--End navbar-->

<!--start our team-->

<div class = "container mt-5 text-center">
<div class = "row">
         <?php

         global $conn;

  $query = "SELECT * FROM studenten ORDER BY telefoon"   ;

      if (isset($_POST['sortAZ'])) {
          $query = "SELECT voornaam, achternaam,telefoon, email, foto FROM studenten ORDER BY achternaam ASC";
          } elseif (isset($_POST['sortZA'])) {
           $query = "SELECT voornaam, achternaam,telefoon, email, foto FROM studenten ORDER BY achternaam DESC";
          } else {
          $query = "SELECT voornaam, achternaam,telefoon, email, foto FROM studenten ";
          }

                    $result = $conn->query($query);

                    if($result->num_rows > 0){


                        while ($row= $result ->fetch_assoc()) {

                             $voornaam= $row["voornaam"];
                             $achternaam=  $row["achternaam"];
                             $telefoon =  $row["telefoon"];
                             $email =  $row["email"];
                             $foto =  $row["foto"];


?>


    <div class="col-lg-4 p-1 mt-5 col-md-6 col-12">
               <div class="card" style="width: 18rem;" >
                   <img src="imag/<?php echo $foto;?>" style= "width:18rem; height: 18rem;"class="card-img-top" alt="...">
                   <div class="card-body">
                       <h3 class="card-title"><?php echo $voornaam,$achternaam ; ?></h3>



        <div class="list-group" >
         <button class=" btn btn-outline-info" href="#x" data-toggle="collapse" data-target="#x" >Info</button>

        <div class="collapse" id="x">
        <a href="mailer.php" class="list-group-item mb-0 list-group-item-action"><p> <?php echo 'email : ' .$email;?></p></a>
        <a href= "" class="list-group-item mb-0 list-group-item-action"><p> <?php echo 'telefoon : ' . $telefoon;?></p></a>


        </div>
        </div>

             </div>
                 </div>
    </div>


<?php    }
             }?>

</div>
</div>

<?php
if (isset($_POST['zoek'])) {
    if (!empty($_POST['zoeken'])) {
        $search = $_POST['zoeken'];
        //POST zoek functie

$query = "SELECT voornaam,achternaam,telefoon,email,foto FROM studenten WHERE voornaam LIKE '%$search%' OR achternaam LIKE '%$search%'";
$result = $conn->query($query);


    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

    $voornaam= $row["voornaam"];
    $achternaam=  $row["achternaam"];
    $telefoon =  $row["telefoon"];
    $email =  $row["email"];
    $foto =  $row["foto"];

       echo

            '<div class="card" id="resultaat" style="width: 18rem;" >
                       <img src="imag/<?php echo'. $foto.' ?>" style= "width:18rem; height: 18rem;"class="card-img-top" alt="..." >
                          <div class="card-body">

                           <p>'. $voornaam.$achternaam.'</p>
                           <p>'.$telefoon.'</p>
                           <p>'.$email.'</p>

            </div>';
            }
        } else {
            echo "geen student gevonden";
        }
     }

    }

    ?>

<!-- End our team-->


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>


</body>
</html>


