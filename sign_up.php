<!--
    Web designed by : Montasser Mossallem
    skype Name : moun2030
    up_work : url->  http://www.upwork.com/o/profiles/users/_~01943d20d212eecc03
-->
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
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        
    </style>
    </head>
    <body>
        <div id="slide-container" class="body-bg">
            <div class="parent-bg img-background" style="background-image: url(img_sliders/1.jpg); "> </div>
            <div class="mask-layer"></div>
        </div>
        <!-- ------------------------------------------------- -->
        <!-- --------------------- Header -------------------- -->
        <!-- ------------------------------------------------- -->
        
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
                    <div class="sign-box sign-up">
                        <div class='error-logs'></div>
                        <div class="box-logs" style="border: 0px;">
                            <input style="border-bottom: 2px solid #eee;" class="inputs by-half fname" placeholder="First Name" type="text" />
                            <input style="border-bottom: 2px solid #eee;" class="inputs by-half sname" placeholder="Last Name" type="text" />
                        </div>
                        <div class="box-logs">
                           <input class="inputs by-half usname" placeholder="Username" type="text" /> 
                        </div>
                        
                        <div class="box-logs">
                            <input class="inputs by-half emails" placeholder="Email" type="text" />
                            
                        </div>
                        <div class="box-logs">
                            <input class="inputs by-half Password" placeholder="Password" type="password" />
                            
                        </div>
                        <div class="box-logs">
                            <input class="inputs dateofbirth" placeholder="Date of Birth: 20/02/1988" type="text" />
                        </div>
                         <div class="box-logs gender-box">
                             
                             <ul class="gender">
                                 <li>
                                   <label style="color: #999;">
                                 Gender :-
                             </label>
                                </li>
                                
                                <li>
                                    <input value="0" type="radio" id="f-option" name="gender">
                                  <label for="f-option">Male</label>
                                    <div class="check"></div>
                                </li>

                                <li>
                                    <input type="radio" value="1" id="s-option" name="gender">
                                  <label for="s-option">Female</label>
                                  <div class="check"><div class="inside"></div></div>
                                </li>
                              </ul>
                        </div>
                        <div class="cont-another">
                            <a class="checkbox">
                                <label class="checklines"><input type="checkbox">I have read the agreement</label>
                            </a>
                            <a></a>
                        </div>
                        <a style="margin-bottom: 15px;" onclick="sign_up_new_user(this);" class="box-logs-btn text-center">
                            Create my account now
                        </a>
                        
                        <div class="is-member text-center">
                            <a>Already have an account? <span>Login</span></a> 
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

        <!-- 
    jQuery (necessary for Bootstrap's JavaScript plugins)
    https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js
    -->
    <script src="js/jquery-1.12.4_1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/log-slides.js"></script>
    </body>
</html>