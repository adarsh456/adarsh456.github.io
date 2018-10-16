<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Date Picker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <title>Dashboard</title>
    <style>
    .navbar {
    background-color: #3c40c6!important;
    color:white!important;
    }
    .navbar-brand{
      font-weight: bold;
      font-size: 30px !important;
      letter-spacing: 2px;
      color: white !important;
      font-family: "Sriracha", cursive;
    }
    .nav-link{
      color: white !important;
    }
    html, body {
    max-width: 100%;
    overflow-x: hidden;
    }
    h5,h4,h3{
      font-weight:400;
    }
    </style>
</head>
<body style="background: white"> <!--#d2d5db">-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php">CARLO</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="addmodel.php">Add Model</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addcar.php">Add Car</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="carfilter.php">My cars</a>
      </li>
    </ul>
    <!-- <form class="form-inline ml-auto">
    <a href="logout.php" class="btn btn-outline-warning border rounded" style="color:white">Logout</a>
    </form> -->
  </div>
</nav>    
