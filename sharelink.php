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
            echo'<div class="alert alert-danger" role="alert">You must be <a href="reglog.php">login or register</a> for viewing this page</div>';
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
    ?>
                
    <div class="parallax-window" data-parallax="scroll" style="padding-left:25%; padding-right:25%; padding-top:10%;" data-image-src="src/img/parallax.jpg">
    <?php
        include_once("connect.php");

        $link  = mysqli_real_escape_string($conn,$_POST['link']);
        $desc  = mysqli_real_escape_string($conn,$_POST['desc']);

        $count = strlen($desc);
        if($count < 16 && $count > 240){
            die("Error : The Number Of Description Value Must Be Consists <16 - 400> Characters");
        }

        $cat   = mysqli_real_escape_string($conn,$_POST['cat']);
        $title = page_title($link);
        $date  = date('Y/m/d h:i:s a', time());
        $type  = "link";

        switch ($cat) {
            case 0:
                die ("Please Select The Category !");
                break;
            case 1:
                $category = "news";
                break;
            case 2:
                $category = "games";
                break;
            case 3:
                $category = "science";
                break;
            case 4:
                $category = "politics";
                break;
            case 5:
                $category = "edu";
                break;
            case 6:
                $category = "tech";
                break;
            case 7:
                $category = "sports"; 
                break;
            case 8:
                $category = "music";
                break;
            case 9:
                $category = "culture";
                break;
            case 10:
                $category = "arts";
                break;
            default:
                die ("Please Select The Category !");
        }

        if (strpos($link, 'youtube') !== false) {
            $type = "youtube";
            if (strpos($link, 'embed') !== false) {
                $desc = $link;
            }

        }else if(strpos($link, 'github') !== false){
            $type = "github";
        }else if(strpos($link, 'spotify') !== false){
            $type = "spotify";
        }

        function page_title($link) {
            $fp = file_get_contents($link);
            if (!$fp) 
                return null;
    
            $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
            if (!$res) 
                return null; 
    
            // Clean up title: remove EOL's and excessive whitespace.
            $title = preg_replace('/\s+/', ' ', $title_matches[1]);
            $title = trim($title);
            return $title;
        }


        $sorgu = "SELECT * FROM card WHERE card_link = '".$link."'";
        if ($sonuc = mysqli_query($conn,$sorgu)){
            $rowcount = mysqli_num_rows($sonuc);
            if($rowcount == 0){
                $kayit = "INSERT INTO card(card_title,card_desc,card_date,card_link,card_category,card_type)VALUES ('".$title."','".$desc."','".$date."','".$link."','".$category."','".$type."')";
                
                if (mysqli_query($conn, $kayit)) {
                    echo "New record created successfully";
                 } else {
                    echo "Error: " . $kayit . "" . mysqli_error($conn);
                 }
            
            }
        }
    ?>
    </div>
    <div style="height:100px; background-color: #000;"></div>
        <div class="footer">
            <img src="src/img/whiterabbit.jpg" style="width: 200px; float:right; margin-top:-40px; margin-right:-60px;" />
            <h1 class="display-5">Follow the White Rabbits!</h1>            
            <p class="lead" style="color: #ccc">Here is the world smartest and smallest social media!</p>
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
    </div>
    <?php mysqli_close($conn); ?>
</body>
</html>