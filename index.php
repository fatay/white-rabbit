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
        if($giris == false){
            echo'<div class="alert alert-dark" role="alert">You must be <a href="reglog.php">login or register</a> for viewing links.</div>';
            echo '<img src="src/img/welcome.jpg" width="100%" style="margin-top:-16px;" />';
            echo'<div class="footer">
            <img src="src/img/whiterabbit.jpg" style="width: 200px; float:right; margin-top:-40px; margin-right:-60px;" />
            <h1 class="display-5">Follow the White Rabbits!</h1>            
            <p class="lead" style="color: #ccc">Here is the world smartest and smallest social media! Some useful footer links given below.</p>
            <hr class="my-4">
            <p>&nbsp;</p>
            <div style="display:inline-block;">
                <button class="btn btn-outline-primary btn-lg stn" style="border-radius:0%;" href="#">About</button> &nbsp; &nbsp;
                <button class="btn btn-outline-primary btn-lg stn" style="border-radius:0%;" href="#">Privacy & Policy</button> &nbsp; &nbsp; 
                <button class="btn btn-outline-primary btn-lg stn" style="border-radius:0%;" href="#">Contact</button> &nbsp; &nbsp;
                <button class="btn btn-outline-primary btn-lg stn" style="border-radius:0%;" href="#">Applications</button> &nbsp; &nbsp;
            </div>
            <br /><br /><br />
            </div>';
        die();
        }    
    ?>

    <br />
    
    <div class="container" align="center">
        <br />
        <h3 id="followme" style="transform: rotate(-10deg); text-align: center; margin-left:-60px; margin-bottom:-4px; color:#e84545;">follow</h3>

        <h1><div style="display: inline; cursor: pointer;" id="follow" onclick="bigImg(this)" onmouseout="normalImg(this)">Welcome to</div> <span id="the">the</span> <span class="rabbit_txt" style="font-size: 34px; color:#e84545">WhiteRabbit.</span></h1>
        <br /> <br />

        <div class="row">


        <?php       

            include("connect.php");

            $sql = 'SELECT * from card';
            $result = mysqli_query($conn, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {

                    $begeni = "SELECT * FROM favorites WHERE which_card = '".$row['card_id']."'AND which_user = '".$userid."'"; 
                    $ress = mysqli_query($conn, $begeni);
                    if (mysqli_num_rows($ress) > 0) {
                        $src = "src/img/fav_active.svg";
                    }else{
                        $src = "src/img/fav.svg";
                    }


                    echo '<div class="col-sm-12 col-md-6 col-lg-3">';
                    echo '<div class="card" style="width: auto;">';
                    echo '<div class="card-header">';
                    echo '<a href="#" style="font-size:12px;">#'.$row['card_category'].'</a> &nbsp;  &nbsp;';
                    echo '<img id="'.$row['card_id'].'" onclick="showHint(this.id)" src="'.$src.'" class="master" style="cursor:pointer;"> &nbsp;';
                    echo '<img src="src/img/'.$row['card_type'].'.svg" class="master" /> &nbsp;  &nbsp;';
                    echo '<b style="font-size:10px; margin-top:20px;">'.$row['card_date'].'</b>';
                    echo '</div>';
                    echo '<a class="card-title" href='.$row['card_link'].' target="_blank">'.$row['card_title'].'</a>';
                    echo '<p class="card-text">';
                    if (strpos($row['card_desc'], 'youtube') !== false) {
                        if (strpos($row['card_link'], 'embed') !== false) {
                            echo "<iframe width='100%' height='100%' src='".$row['card_desc']."'></iframe>";
                        }
                    }else{
                        echo $row['card_desc'];
                    }
                    echo '</p>';
                    echo '<div style="position: absolute; left:36%; bottom:0;" align="center">';
                    echo '<a href="#" style="color: #e84545; font-size: 12px;">Comments</a></div>';
                    echo '</div>';
                    echo '</div>';
                
                }
            } else {
                echo "0 results";
        }
            

        ?>

            
        </div><br />
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

    <script>
        var flw = document.getElementById("followme");
        var thee = document.getElementById("the");

        function bigImg(x) {
            x.style.textDecoration = "line-through";
            flw.style.visibility="visible";
            thee.style.color="#e84545";
        }
            
        function normalImg(x) {
            x.style.textDecoration = "none";
            flw.style.visibility="hidden";
            thee.style.color="#000";
        }

        function getCarrot(x){
            x.src = "src/img/fav_active.svg";
        }

        function brCarrot(x){
            x.src = "src/img/fav.svg";
        }

        function showHint(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(str).src = this.responseText;
                }
            }

            xmlhttp.open("GET", "like.php?id="+str, true);
            xmlhttp.send();
        }
    </script>

</body>
</html>