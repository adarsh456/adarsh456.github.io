<?php
require("../config/config.php");
require("../config/db.php");
//error_reporting(E_ERROR|E_PARSE);
session_start();
//$hid = $_SESSION["id"];
$cid = $_GET['cid'];

$query1 = "SELECT * from models order by brand";
$result = mysqli_query($conn,$query1);
$models = mysqli_fetch_all($result,MYSQLI_ASSOC);

$query2 = "SELECT * from cars where cid = $cid;";
$result1 = mysqli_query($conn,$query2);
$car = mysqli_fetch_assoc($result1);

if(isset($_POST['add'])){
    $carid = mysqli_real_escape_string($conn,$_POST['carid']);
    $variant = mysqli_real_escape_string($conn,$_POST['variant']);
    $year = mysqli_real_escape_string($conn,$_POST['year']);
    $km = mysqli_real_escape_string($conn,$_POST['km']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    $condition = mysqli_real_escape_string($conn,$_POST['condition']);

    $query = "UPDATE cars SET 
                mid = '$carid',
                year = '$year',
                kms = '$km',
                con = '$condition',
                variant = '$variant',
                price = '$price'
                where cid ='$cid';";
    
    if(mysqli_query($conn,$query)){
        header("Location:addcar.php");
    }
    else{
        echo "Something went wrong" .  mysqli_error($conn);
    }
}


?>
<?php include('inc/header.php')?>
<style>
.jumbotron{
    margin-top: 3%;
    width: 30%;
    padding: 1%;
}
</style>
<div class="jumbotron mx-auto">
<h1 style="font-weight:200">Update Car Details</h1>
<hr>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
<div class="form-group">
<label>Variant (if Applicable)</label>
<input class="form-control" type="text" name="variant" value="<?php echo $car['variant']; ?>">
</div>
<div class="form-group">
<label>Running (Kms)</label>
<input class="form-control" type="text" name="km" value="<?php echo $car['kms'] ?>">
</div>
<div class="form-group">
<label>Price</label>
<input class="form-control" type="text" name="price" value="<?php echo $car['price'] ?>">
</div>
<a class="btn btn-info my-2 my-sm-0"  href="mycars.php">BACK</a>
<input style="float:right" class="btn btn-warning my-2 my-sm-0" name="add" type="submit" value="UPDATE">
</form>
</div>
<?php include('inc/footer.php');?>