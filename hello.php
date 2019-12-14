<?php
@ob_start();
session_start();
if(isset($_SESSION['user'])){
  header("Location: index.php");
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
    <link href="https://fonts.googleapis.com/css?family=Exo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Exo:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>        
    <script src="src/js/parallax.js"></script>

    <style>

body{
    font-family: 'Exo', sans-serif;
}

.btn-outline-success{
    border:1px solid #e84545 !important;
    color:#e84545 !important;
    border-radius: 0% !important;
}

.btn-outline-success:hover{
    border:1px solid #e84545 !important;
    color:#fff !important;
    background: #e84545;
}
        
form {border: 3px solid #f1f1f1;}

.carousel-content{
    position: fixed;
    top: 4%;
    left: 36%;
    z-index: 20;
    color: white;
}

.container {
  padding: 32px;
}

span.psw {
  float: right;
  padding-top: 2px;
}

form{
  display: inline-block;
  text-align:left;
}

.renktxt{
  color: #2d334a;
}
.logintxt{
  color:#2d334a;
  text-align: right;
}

.kutu{
  border-radius: 4px;
  width: 320px !important;
  height: 24px !important;
  border: 1px solid #ccc;
  font-size:16px;
  padding:4px;
  
}

.nav-link:hover{
    color:#fff;
    border:0;
}

.nav-link{
    color:#000;
    font-size:20px !important;
}

input{
    border-radius:0 !important;
}

body{
  background: url('src/img/nevsehir.jpg');
}


/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
          
  }
  .cancelbtn {
     width: 100%;
  }
 
  
}

@font-face {
    font-family: 'Conv_Cookies';
    src: url('src/font/Cookies.ttf');
    src: local('☺'), url('src/font/Cookies.woff') format('woff'), url('src/font/Cookies.ttf') format('truetype'), url('src/font/Cookies.svg') format('svg');
    font-weight: normal;
    font-style: normal;
}


.rabbit_txt{
    font-family: 'Conv_Cookies';
    font-size:34px;
    margin-left:8px;
    margin-top:20px;
    color:white;
    text-shadow: 2px 2px #000;
}

.section-title{
    color:#000 !important;
}
    </style>
</head>
<body>

<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-content">
        <section id="tabs">
            <div class="container">
            <h6 class="section-title h3" style="margin-left:-20px;">Welcome to the <span class="rabbit_txt">WhiteRabbit</span> </h6><br />
            
            <?php
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

                $login = "SELECT * FROM user WHERE username = '".$logname."'AND pass = '".$logpass."'"; 
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
            
            <div class="row">
                <div class="col-xs-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Login</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Register</a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <form action="" method="post" style=" background-color: #efefef;  border-radius: 6px;">
                                <div class="container form-group">
                                    <h3><b class="renktxt">Login</b></h3><br />
                                    <label for="uname"><b class="renktxt">username</b></label><br />
                                    <input type="text" name="logname" class="kutu" required /> <br/><br/>
                                    <label for="psw"><b class="renktxt">password</b></label><br />
                                    <input type="password" name="logpass" class="kutu" required /> <br/><br/><br />
                                    <input type="submit" name="login" class="btn btn-outline-success" value="Login" />
                                    <span class="psw"> <a href="#" style="color: #e84545; text-decoration: none;">Forgot password</a> <a href="#"></a></span>
                                </div>
                            </form>               
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form action="" method="post" style=" background-color: #efefef; border-radius: 6px;">
                                <div class="container form-group">
                                    <h3> <b class="renktxt"> New Registration</b> </h3><br />
                                    <label for="psw"> <b class="renktxt">username</b> </label> <br />
                                    <input type="text" id="confirm_password" name="regname" class="kutu" minlength="5" maxlength="30" required/> <br /> <br /> 
                                    <label for="umail"><b class="renktxt">e-mail</b></label><br />
                                    <input type="mail"  id="mail" class="kutu" name="regmail" /> <br /> <br />
                                    <label for="sifre"> <b class="renktxt"> password </b></label> <br />
                                    <input type="password"  id="password" class="kutu" minlength="8" maxlength="20" name="regpass" required /> <br /> <br />
                                    <i style="font-size:12px; color:#000;">
                                    By clicking "Sign Up" you indicate that
                                    you have read and <br /> agree to  WhiteRabbit's <a href="#" style="color: #e84545; text-decoration: none;">Privacy & Policy</a></i>
                                    <br /><br /><input type="submit" name="register" class="btn btn-outline-success" value="Register" /><br /><br />
                                </div>
                            </form>
                        </div>
                    </div>       
                </div>
            </div>
        </section>
    </div>




    <div class="carousel-inner" style="height:100vh;">
        <div class="carousel-item active">
            <img src="src/img/nevsehir.jpg" class="d-block w-100" alt="...">
        </div>

        <div class="carousel-item">
            <img src="src/img/artvin.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="src/img/rize.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="src/img/istanbul.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="src/img/apollo.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
</div>
<?php mysqli_close($conn); ?>
<script>
  $('.carousel').carousel({
    interval: 1000
  })
</script>
</body>
</html>