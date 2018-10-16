<?php
require('config/db.php');
require('config/config.php');
session_start();
$mid = $_SESSION['mid'];

// create query
$query = "SELECT * from cars where mid = $mid ORDER BY year desc";
$result = mysqli_query($conn, $query);
$cars = mysqli_fetch_all($result,MYSQLI_ASSOC);

$query1 = "SELECT * from models where mid = $mid limit 1";
$result1 = mysqli_query($conn, $query1);
$model = mysqli_fetch_assoc($result1);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="dstyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Cars on Sale</title>
</head>
<body>
<div style="color:#8A8A8A;font-size: 4em;margin-left: 50px;margin-top: 6vw;font-weight: bold;margin-bottom:0px">Cars on Sale ...</div>
<div class="container rounded" style="margin-top: 2em">
    <a class="btn btn-success" href="sesdes.php">Back</a>
    <div class="row">
    <?php foreach($cars as $car) : ?>
    <?php 
        $cid = $car['cid'];
        $query2 = "SELECT * from images where cid = $cid limit 1";
        $result2 = mysqli_query($conn, $query2);
        $image = mysqli_fetch_assoc($result2);?>    
    <div class="col-md-4">
    <div class="card" style="width: 18rem;">    
    <!-- <img class="card-img-top" src=".../100px180/" alt="Card image cap"> -->
    <div class="card-img-top"><img style="width:286px; height:150px;" src="Dashboard/uploads/<?php echo $image['imagename']; ?>" alt="No image uploaded Yet"></div>
    <div class="card-body">
    <h5 class="card-title"><?php echo $model['brand'] . " " .  $model['model'] . " " . $car['variant'] ;?></h5>
    <small style="color:gray;"><?php echo $model['fuel'];?></small>
    <p class="card-text"><?php echo $car['year'];?></p>
    <a href="cardetail.php?cid=<?php echo $car['cid'];?>" class="btn btn-danger">Rs. <?php echo $car['price'];?></a>
    </div>
    </div>
</div>
<?php endforeach; ?>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>