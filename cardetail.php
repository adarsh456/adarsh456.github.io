<?php
require('config/db.php');
require('config/config.php');
session_start();
$mid = $_SESSION['mid'];

$cid =$_GET['cid'];

// Car details
$query = "SELECT * from cars where cid = $cid";
$result = mysqli_query($conn, $query);
$car = mysqli_fetch_assoc($result);

$query1 = "SELECT * from models where mid = $mid limit 1";
$result1 = mysqli_query($conn, $query1);
$model = mysqli_fetch_assoc($result1);

// Images
$query2 = "SELECT * from images where cid = $cid";
$result2 = mysqli_query($conn, $query2);
$images = mysqli_fetch_all($result2,MYSQLI_ASSOC);

$act = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Cars on Sale</title>
    <style>
    .jumbotron{
        width:50%;
        margin-top:7%;
    }

    .brand {
    font-weight: bold;
    font-size: 30px !important;
    letter-spacing: 2px;
    color: white !important;
    font-family: "Sriracha", cursive;
    }

    nav {
    background-color: #3c40c6;
    }
    </style>
</head>
<body>
<!-- NAvBAr Starts -->
<nav class="navbar navbar-light fixed-top">
<a href="index.php" class="navbar-brand brand">CARLO</a>
</nav>
<!-- Navbar Ends -->
<div class="jumbotron mx-auto">
<h2 style="font-weight:200"><?php echo $model['brand'] . " " . $model['model'] . " " . $car['variant'] ; ?></h2>
<h5><?php echo $model['fuel']; ?></h5>
<hr>
<!-- image slider -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
  <?php foreach($images as $image) : ?>
    <div class="carousel-item <?php if($act == 1){ ?>active<?php $act = 0;}?>">
      <img class="d-block w-100 rounded" src="Dashboard/uploads/<?php echo $image['imagename']; ?>" alt="First slide">
    </div>
  <?php endforeach; ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<hr>
<!-- image slide finished -->
<p><?php echo $car['year'];?> Model</p>
<p><?php echo $car['kms'];?> Kms</p>
<p>Condition : <?php if($car['con'] == 1){echo "EXCELLENT";}else if($car['con'] == 2){echo "VERY GOOD";}else{echo "GOOD";}?></p>
<h4>Rs <?php echo $car['price']; ?></h4><br>
<a class="btn btn-success" href="discars.php">Back</a>
</div>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>