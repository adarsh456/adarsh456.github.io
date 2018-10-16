<?php
require('config/db.php');
require('config/config.php');
session_start();
$car_err = "";
if(isset($_POST['add'])){
    $brand = mysqli_real_escape_string($conn,$_POST['brand']);
    $model = mysqli_real_escape_string($conn,$_POST['model']);
    $fueltype = mysqli_real_escape_string($conn,$_POST['fueltype']);
    
    $q = "SELECT mid from models where brand = '$brand' AND model = '$model' AND fuel = '$fueltype';";
    $res = mysqli_query($conn,$q);
    $mid = mysqli_fetch_assoc($res);
    if($mid["mid"] == NULL){
        $car_err = "Opps ! No car available with these options";
    }
    else{
    $_SESSION['mid'] = $mid["mid"];
    if($res){
        header('Location:discars.php');
    }
    else{
        echo "Something went wrong" .  mysqli_error($conn);
    }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<!-- NAvBAr Starts -->
<nav class="navbar navbar-light fixed-top">
	<a href="../" class="navbar-brand brand">CARLO</a>
	</nav>
	<!-- Navbar Ends -->
<div class="row">
    <div class="col-md-8">

    </div>
    <div class="col-md-4">
    <div class="jumbotron">
        <h1 class="display-5" style="font-weight:150;">Find A Car</h1><hr>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
        <select class="form-control" name="brand">
        <option value="BRAND">BRAND</option>
        <?php $res1 = mysqli_query($conn,"SELECT brand from models group by brand order by brand");
             $brands = mysqli_fetch_all($res1,MYSQLI_ASSOC);
            foreach($brands as $brand) :
        ?>
        <option value="<?php echo $brand['brand'] ?>"><?php echo $brand['brand'] ?></option>
        <?php endforeach; ?>
        </select><br>
        <select class="form-control" name="model">
        <option value="MODEL">MODEL</option>
        <?php $res2 = mysqli_query($conn,"SELECT model from models group by model order by model");
             $models = mysqli_fetch_all($res2,MYSQLI_ASSOC);
            foreach($models as $model) :
        ?>
        <option value="<?php echo $model['model'] ?>"><?php echo $model['model'] ?></option>
        <?php endforeach; ?>
        </select><br>
        <select class="form-control" name="fueltype">
        <option value="PETROL">PETROL</option>
        <option value="DIESEL">DIESEL</option>
        <option value="ELECTRIC">ELECTRIC</option>
        </select><br>
        <small style="color:red;"><?php echo $car_err; ?></small>
        <input class="btn btn-info my-2 my-sm-0" name="add" type="submit" value="SEARCH">
        </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
