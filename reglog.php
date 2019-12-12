<?php
@ob_start();
session_start();
if(isset($_SESSION['id'])){
  $giris=true;
  $userid=$_SESSION['id'];
}
else{
  $giris=false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WhiteRabbit</title>

    <link href="https://fonts.googleapis.com/css?family=Exo:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="src/css/style.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>        
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light">
        <a class="navbar-brand" href="#">
            <div class="circle"></div>
            <img src="src/img/loggo.png" class="logo" />
         </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home </a>
                </li>
                <li class="nav-item">
                    <?php
                        if($giris==true){
                           echo'<a class="nav-link" href="newest.php">Newest</a>';
                        }else{
                            echo'<a class="nav-link" href="reglog.php">Login & Register</a>';
                        }
                    ?>
                    
                </li>
                <li class="nav-item">
                    <?php
                        if($giris==true){
                           echo'<a class="nav-link" href="popular.php">Popular</a>';
                        }else{
                            echo'';
                        }
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                        if($giris==true){
                           echo'<a class="nav-link" href="share.php">Share</a>';
                        }else{
                            echo'';
                        }
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                        if($giris==true){
                           echo'<a class="nav-link" href="favorites.php">Favorites</a>';
                        }else{
                            echo'';
                        }
                    ?>
                </li>
            </ul>
                    
            <div class="form-inline" style="margin-right:24px;">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                    <?php
                        if($giris==true){
                           echo'<a class="nav-link" href="logout.php">Logout</a>';
                        }else{
                            echo'';
                        }
                    ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php

        if($giris == true){
            echo'<div class="alert alert-danger" role="alert">You have already logged in.</div>';
            echo'<div style="margin-top:400px;"></div>';
            echo'<div class="footer" style="margin-top:120px;">
            <img src="src/img/whiterabbit.jpg" style="width: 200px; float:right; margin-top:-40px; margin-right:-60px;" />
            <h1 class="display-5">Follow the White Rabbits!</h1>            
            <p class="lead" style="color: #ccc">Here is the world smartest and smallest social media! Some useful footer links given below.</p>
            <hr class="my-4">
            <p>&nbsp;</p>
            <div style="display:inline-block;">
                <button class="btn btn-outline-success btn-lg stn" href="#">About</button> &nbsp; &nbsp;
                <button class="btn btn-outline-success btn-lg stn" href="#">Privacy & Policy</button> &nbsp; &nbsp; 
                <button class="btn btn-outline-success btn-lg stn" href="#">Contact</button> &nbsp; &nbsp;
                <button class="btn btn-outline-success btn-lg stn" href="#">Applications</button> &nbsp; &nbsp;
            </div>
            <br /><br /><br />
            </div>';
        die();
        }

        include_once("connect.php");
        if (isset($_POST['register'])) {
            $reguser = mysqli_real_escape_string($conn,$_POST['regname']);
            $regmail = mysqli_real_escape_string($conn,$_POST['regmail']);
            $regpass = mysqli_real_escape_string($conn,$_POST['regpass']);
            $regpass = md5($regpass);
            $previous = "javascript:history.go(-1)";
            if(isset($_SERVER['HTTP_REFERER'])) {
                $previous = $_SERVER['HTTP_REFERER'];
            }

            $username = "SELECT * FROM user WHERE username = '".$reguser."'OR mail = '".$regmail."'"; 
            $ress = mysqli_query($conn, $username);
            if (mysqli_num_rows($ress) > 0) {
                echo'<a href="'. $previous .'"><h2>Go Back </h2></a>';
                die('<div class="alert alert-danger" role="alert">Error! : Username or Mail already exists.</div>');
            }

            $kayit = "INSERT INTO user(username,mail,pass)VALUES ('".$reguser."','".$regmail."','".$regpass."')";
            if (mysqli_query($conn, $kayit)) {
                echo '<div class="alert alert-success" role="alert">New user registration completed successfully</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error: " . $kayit . "" . mysqli_error($conn)</div>';
            }
        }

        if (isset($_POST['login'])) {
            $logname = mysqli_real_escape_string($conn,$_POST['logname']);
            $logpass = mysqli_real_escape_string($conn,$_POST['logpass']);
            $logpass = md5($logpass);

            $login = "SELECT * FROM user WHERE username = '".$logname."'OR pass = '".$logpass."'"; 
            $reslog = mysqli_query($conn, $login);
            if($reslog){
                if (mysqli_num_rows($reslog) == 1) {
                    while($row = mysqli_fetch_assoc($reslog)) {
                      $_SESSION['id'] = $row['id'];
                      header("Location: index.php");
                    }
                }else{
                    $previous = "javascript:history.go(-1)";
                    if(isset($_SERVER['HTTP_REFERER'])) {
                        $previous = $_SERVER['HTTP_REFERER'];
                    }
                    echo'<a href="'. $previous .'"><h2>Go Back </h2></a>';
                    die('<div class="alert alert-danger" role="alert">Error!: Username or password does not match.');
                }
  
            }
        }
    ?>


            
    <div class="container" align="center">
        <div class="row" style="text-align:left;">
            <div class="col-sm-12 col-md-12 col-lg-6"><br/><br />
                <h3 style="color:#e84545;">New Registration</h3><hr>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="exampleInputUser1">Username</label>
                        <input type="text" name="regname" class="form-control" id="exampleInputUser1" aria-describedby="userHelp" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="regmail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="regpass" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                    </div>
                    <input type="submit" name="register" class="btn btn-outline-success" value="Register" />
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6"><br /> <br />
                <h3 style="color:#e84545;">Login</h3><hr>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="exampleInputUser1">Username</label>
                        <input type="text" name="logname" class="form-control" id="exampleInputUser1" aria-describedby="userHelp" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="logpass" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                    </div>
                    <input type="submit" name="login" class="btn btn-outline-success" value="Login" />
                </form>
            </div>
        </div>
    </div>


    <div class="footer" style="margin-top:120px;">
        <img src="src/img/whiterabbit.jpg" style="width: 200px; float:right; margin-top:-40px; margin-right:-60px;" />
        <h1 class="display-5">Follow the White Rabbits!</h1>            
        <p class="lead" style="color: #ccc">Here is the world smartest and smallest social media! Some useful footer links given below.</p>
        <hr class="my-4">
        <p>&nbsp;</p>
        <div style="display:inline-block;">
            <button class="btn btn-outline-success btn-lg stn" href="#">About</button> &nbsp; &nbsp;
            <button class="btn btn-outline-success btn-lg stn" href="#">Privacy & Policy</button> &nbsp; &nbsp; 
            <button class="btn btn-outline-success btn-lg stn" href="#">Contact</button> &nbsp; &nbsp;
            <button class="btn btn-outline-success btn-lg stn" href="#">Applications</button> &nbsp; &nbsp;
        </div>
        <br /><br /><br />
    </div>


<?php mysqli_close($conn); ?>
</body>
</html>