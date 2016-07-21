<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Login to jury of peers</title>
        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic&subset=latin-ext' rel='stylesheet' type='text/css'>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/logs.css" rel="stylesheet">
    </head>
    <body>
        <!-- ------------------------------------------------- -->
        <!-- ------------------- Background ------------------ -->
        <!-- ------------------------------------------------- -->
        <div id="slide-container" class="body-bg">
            <div class="parent-bg img-background" style="background-image: url(img_sliders/1.jpg); "> </div>
            <div class="mask-layer"></div>
        </div>
        <!-- ------------------------------------------------- -->
        <!-- --------------------- Contents ------------------ -->
        <!-- ------------------------------------------------- -->
        <div class="container contetns header-con">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <h1 class="logo">
                        JURY <span style="background: #e52826; color: #fff; padding: 0px 5px; font-size: 33px; display: inline-block;">OF</span> PEERS
                    </h1>
                    <h1 class="slogan">
                        Where the people decide 
                    </h1>
                   
                </div>
                <div class="col-xs-12 col-md-6">
                     <div class="sign-box">
                       <div id="error-logs" class="error-logs"></div>
                        <div class="box-logs">
                            <input class="inputs" id="usernameoremail" placeholder="Username Or Email" type="text" />
                        </div>
                        <div class="box-logs">
                            <input class="inputs" id="passworduser" placeholder="Password" type="password" />
                        </div>
                        <a onclick="loginuser(this);" class="box-logs-btn text-center">
                            Login
                        </a>
                        <div class="cont-another">
                            <a class="checkbox">
                                <label><input type="checkbox" value="">remember me</label>
                            </a>
                            <a>Forget password</a>
                        </div>
                        <div class="is-member text-center">
                            <a>Not a member? <span>Create an account</span></a> 
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- ------------------------------------------------- -->
        <!-- ---------------------- Footer ------------------- -->
        <!-- ------------------------------------------------- -->
        <div class="container-fluid footer  navbar-fixed-bottom">
             <ul class="nav navbar-nav navbar-left">
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Help</a></li>
             </ul>
            <ul class="nav navbar-nav navbar-right">
                 <li><a href="#">2016 copyrights</a></li>
                 <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
            </ul>
        </div>
        <script src="js/jquery-1.12.4_1.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/background-slider.js"></script>
        <script src="js/log-apps.js"></script>
    </body>
</html>

