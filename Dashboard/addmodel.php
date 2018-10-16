<?php
require("../config/config.php");
require("../config/db.php");
//error_reporting(E_ERROR|E_PARSE);
session_start();
//$hid = $_SESSION["id"];

$query1 = "SELECT * from models order by brand";
$result = mysqli_query($conn,$query1);
$details = mysqli_fetch_all($result,MYSQLI_ASSOC);

if(isset($_POST['add'])){
    $brand = mysqli_real_escape_string($conn,$_POST['brand']);
    $model = mysqli_real_escape_string($conn,$_POST['model']);
    $fueltype = mysqli_real_escape_string($conn,$_POST['fueltype']);

    $query = "INSERT INTO models(brand,model,fuel) values('$brand','$model','$fueltype');";
    if(mysqli_query($conn,$query)){
        header("Location:addmodel.php");
    }
    else{
        echo "Something went wrong" .  mysqli_error($conn);
    }
}

if(isset($_POST['delete'])){
    $mid = mysqli_real_escape_string($conn,$_POST['mid']);

    $query2 = "DELETE from models where mid = '$mid'";
    if(mysqli_query($conn,$query2)){
        header("Location:addmodel.php");
    }
    else{
        echo "Something went wrong" .  mysqli_error($conn);
    }
}

?>

<?php include('inc/header.php')?>
<style>
.scroll {
  height:400px;
  overflow-y: scroll;
  background: #EAF0F1;
  margin-top: 3%;
  width: 95%;
  border: 1px solid black;
}

tr,th,td{
    margin-bottom:2px!important;
}
</style>
<div class="row">
<div class="col-md-4">
<div class="jumbotron mx-auto" style="width:80%; margin-top:3%;">
<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
<label>Brand</label>
<select class="form-control" name="brand">
<option value="Hyundai">Hyundai</option>
<option value="Maruti">Maruti</option>
<option value="Honda">Honda</option>
<option value="Ford">Ford</option>
<option value="Tata">Tata</option>
<option value="Toyota">Toyota</option>
</select>
<br>
<label>Model</label>
<input class="form-control" type="text" name="model" placeholder="Enter Model Name">
<br>
<label>Fuel type</label>
<select class="form-control" name="fueltype">
<option value="PETROL">PETROL</option>
<option value="DIESEL">DIESEL</option>
<option value="ELECTRIC">ELECTRIC</option>
</select>
<br>
<input class="btn btn-success my-2 my-sm-0" name="add" type="submit" value="ADD">
</form>
</div>
</div>
<div class="col-md-8">
<div class="scroll">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Brand</th>
      <th scope="col">Model</th>
      <th scope="col">Fuel Type</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($details as $detail) : ?>
    <tr>
      <td><?php echo $detail['brand'] ?></td>
      <td><?php echo $detail['model'] ?></td>
      <td><?php echo $detail['fuel'] ?></td>
      <td><form action="<?php $_SERVER['PHP_SELF']?>" method="post">
      <input type="hidden" name="mid" value="<?php echo $detail['mid'] ?>">
      <input class="btn btn-danger my-2 my-sm-0" name="delete" type="submit" value="DELETE">
      </form></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>
</div>
</div>

<?php include('inc/footer.php');?>