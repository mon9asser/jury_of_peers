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
                <div style="margin-top: -44px;" class="col-xs-12 col-md-6">
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
                            <!--
                            <input class="inputs dateofbirth" placeholder="Date of Birth: 20/02/1988" type="text" />
                            -->
                            <select class='inputs   quart-part dateBirthMonth' name="DOBMonth">
                                <option disabled> - Month - </option>
                                    <option value="January">January</option>
                                    <option value="Febuary">Febuary</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                            </select>
                            <select class='inputs   quart-part dateBirthDay' name="DOBDay">
                                <option disabled>- Day - </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                        </select>
                            <select  class='inputs quart-part dateBirthYear' name="DOBYear">
                                <option disabled> - Year - </option>
                                <option value="1993">1993</option>
                                <option value="1992">1992</option>
                                <option value="1991">1991</option>
                                <option value="1990">1990</option>
                                <option value="1989">1989</option>
                                <option value="1988">1988</option>
                                <option value="1987">1987</option>
                                <option value="1986">1986</option>
                                <option value="1985">1985</option>
                                <option value="1984">1984</option>
                                <option value="1983">1983</option>
                                <option value="1982">1982</option>
                                <option value="1981">1981</option>
                                <option value="1980">1980</option>
                                <option value="1979">1979</option>
                                <option value="1978">1978</option>
                                <option value="1977">1977</option>
                                <option value="1976">1976</option>
                                <option value="1975">1975</option>
                                <option value="1974">1974</option>
                                <option value="1973">1973</option>
                                <option value="1972">1972</option>
                                <option value="1971">1971</option>
                                <option value="1970">1970</option>
                                <option value="1969">1969</option>
                                <option value="1968">1968</option>
                                <option value="1967">1967</option>
                                <option value="1966">1966</option>
                                <option value="1965">1965</option>
                                <option value="1964">1964</option>
                                <option value="1963">1963</option>
                                <option value="1962">1962</option>
                                <option value="1961">1961</option>
                                <option value="1960">1960</option>
                                <option value="1959">1959</option>
                                <option value="1958">1958</option>
                                <option value="1957">1957</option>
                                <option value="1956">1956</option>
                                <option value="1955">1955</option>
                                <option value="1954">1954</option>
                                <option value="1953">1953</option>
                                <option value="1952">1952</option>
                                <option value="1951">1951</option>
                                <option value="1950">1950</option>
                                <option value="1949">1949</option>
                                <option value="1948">1948</option>
                                <option value="1947">1947</option>
                         </select>
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
        <script src="js/jquery-1.12.4_1.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/background-slider.js"></script>
        <script src="js/log-apps.js"></script>
    </body>
</html>