<?php
require('../config/db.php');
require('../config/config.php');
session_start();
$mid = $_SESSION['mid'];

// create query
$query = "SELECT * from cars where mid = $mid ORDER BY year desc";
$result = mysqli_query($conn, $query);
$cars = mysqli_fetch_all($result,MYSQLI_ASSOC);

$query1 = "SELECT * from models where mid = $mid limit 1";
$result1 = mysqli_query($conn, $query1);
$model = mysqli_fetch_assoc($result1);

if(isset($_POST['delete'])){
    $cid = mysqli_real_escape_string($conn,$_POST['cid']);
    $query2 = "DELETE from cars where cid = $cid";
    if(mysqli_query($conn, $query2)){
        header("Location:mycars.php");
    }else{
        echo "Something went wrong" .  mysqli_error($conn);
    }
}

?>
<?php include('inc/header.php')?>
<div class="container rounded" style="margin-top: 2em">
    <a class="btn btn-success mb-4" href="sesdes.php">Back</a>
    <div class="row">
    <?php foreach($cars as $car) : ?>    
    <div class="col-md-4">
    <div class="card" style="width: 18rem;">    
    <!-- <img class="card-img-top" src=".../100px180/" alt="Card image cap"> -->
    <!-- <div class="card-img-top"></div> -->
    <div class="card-body">
    <h5 class="card-title"><?php echo $model['brand'] . " " .  $model['model'] . " " . $car['variant'] ;?></h5>
    <small style="color:gray;"><?php echo $model['fuel'];?></small>
    <p class="card-text"><?php echo $car['year'] . " - Rs " . $car['price'];?></p>
    <a style="float:right;" href="updatecar.php?cid=<?php echo $car['cid'];?>" class="btn btn-warning btn-sm">UPDATE</a>
    <a href="cimg.php?cid=<?php echo $car['cid'];?>" class="btn btn-info btn-sm mb-2">ADD IMAGES</a>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <input type="hidden" name="cid" value="<?php echo $car['cid'];?>">
    <input class="btn btn-danger btn-sm" name="delete" type="submit" value="DELETE"></form>
    </div>
    </div>
</div>
<?php endforeach; ?>
</div>
</div>

<?php include('inc/footer.php');?>