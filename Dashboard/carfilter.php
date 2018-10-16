<?php
require('../config/db.php');
require('../config/config.php');
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
        header('Location:mycars.php');
    }
    else{
        echo "Something went wrong" .  mysqli_error($conn);
    }
    }
}

?>

<?php include('inc/header.php')?>
<style>
.jumbotron{
    width:30%;
    margin-top:5%;
}
</style>
    <div class="jumbotron mx-auto">
        <h1 class="display-5" style="font-weight:150;">My Cars</h1><hr>
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

<?php include('inc/footer.php');?>
