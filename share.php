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
    <script src="src/js/parallax.js"></script>
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
                
    <div class="parallax-window" data-parallax="scroll" style="padding-left:15%; padding-right:15%; padding-top:10%;" data-image-src="src/img/parallax.jpg">
        <form method="POST" action="sharelink.php" style="background-color: #efefef; padding: 20px; border:1px solid #ccc;">
            <h5><b>Share</b></h5><hr><br />
            <div class="form-group row">
                <label for="inputUrl3" class="col-sm-2 col-form-label">Link</label>
                <div class="col-sm-10">
                    <input name="link" type="url" class="form-control" id="inputUrl3" minlength="20" maxlength="600" placeholder="Enter the page url here" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputDesc3" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">  
                    <textarea name="desc" class="form-control" id="exampleFormControlTextarea3" rows="3" minlength="16" maxlength="200"></textarea>               
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Category</legend>
                    <div class="col-sm-10">
                        <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                        <select name="cat" class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="border-radius: 0% !important;" required>
                            <option selected>Choose...</option>
                            <option value="1">News</option>
                            <option value="2">Games</option>
                            <option value="3">Science</option>
                            <option value="4">Politics</option>
                            <option value="5">Education</option>
                            <option value="6">Technology</option>
                            <option value="7">Sports</option>
                            <option value="8">Music</option>
                            <option value="9">Culture</option>
                            <option value="10">Art & Phylosophy</option>
                        </select>
                    </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <div class="col-sm-2">Checkbox</div>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" required>
                        <label class="form-check-label" for="gridCheck1">
                            &nbsp; I accept WhiteRabbit 's Privacy & Policy of link share module.
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <input type="submit" value="Share" style="float: left;" class="btn btn-outline-success"/>
                </div>
            </div>
        </form>
    </div>
    <div style="height:100px; background-color: #000;"></div>
        <div class="footer">
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
    </div>
</body>
</html>