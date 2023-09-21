<?php require("signup_xpg.php")?>
<?php 
    session_start();
    if(isset($_POST['submit'])){
        $user = new RegisterUser($_POST['FirstName'], $_POST['LastName'], $_POST['Bday'], $_POST['Age'], $_POST['Country'], $_POST['Gender'], $_POST['Email'], $Username = $_POST['Username'], $_POST['Password']);

        echo "<script>alert('Hey $Username, welcome to XPG!');</script>";
        
        $conn = new mysqli("localhost", "root", "", "profileuploader");

        //Check connection
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $json_file = file_get_contents("XPG-Userstorage.json");
        $userinvite = json_decode($json_file, JSON_OBJECT_AS_ARRAY);
        //Prepare and bind the statment
        $stmt = $conn->prepare("INSERT INTO xpgusers (`Firstname`, `Lastname`, `Birthday`, `Age`, `Birth Country`, `Gender`, `Email`, `Username`, `Password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $row_insert = 0;
        //Iterate through JSON data and insert into database
        foreach ($userinvite as $invite){
            //Check if username already exists to prevent duplication
            $existQuery = "SELECT COUNT(*) FROM xpgusers WHERE Username = ?";
            $existStmnt = $conn->prepare($existQuery);
            $existStmnt->bind_param("s", $invite['Username']);
            $existStmnt->execute();
            $existStmnt->bind_result($count);
            $existStmnt->fetch();
            $existStmnt->close();
            
            if($count == 0){
                //User does not exisit insert data
                $firstname = $invite['Firstname'];
                $lastname = $invite['Lastname'];
                $birth = $invite['Birthday'];
                $aging = $invite['Age'];
                $country = $invite['Birth Country'];
                $gender = $invite['Gender'];
                $email = $invite['Email'];
                $username = $invite['Username'];
                $password = $invite['Password'];
                //Bind parameterd
                $stmt->bind_param("ssdisssss", $firstname, $lastname, $birth, $aging, $country, $gender, $email, $username, $password);  //"ss" indicates 2 string parameters
                //Execute the statement
                if($stmt->execute() === true){
                    $row_insert++;
                }else{
                    echo "JSON decode/parse failed: " . $stmt->error;
                }
                //Reset parameter bindings for the next iteration
                $stmt->reset();
            }
        }
        //Close the MySQL connection
        $stmt->close();
        $conn->close();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>www.xpgplayhub.com</title>
<link type="image/x-icoN" rel="icon" href="/website_icons/xpg-image3 copy.png">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--BS5 File!-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!--Custom Style--> 

<link rel="stylesheet" href="css/game_style.css">
</head>
<div class="sticky">
    <header class="header0"><section class="display"><img src="/website_icons/xpg-image3.png" class="header-Logo"><h2 style="margin: 0; font-weight: 600; font-size:19px; text-align: left;">PLAY<br>HUB</h2></section>
        <section class="displayer"><a href="/login.php" class="head-btn">Log In</a><span class="navbar-toggler" id="toggle-btn"><img src="website_icons/navbar2.png" class="Navbar-icon"alt="" title="Menu"></span></section>
    </header>
</div>
<body>
    <aside>
        <nav class="navbar navbar-expand d-flex flex-column align-item-start" id="sidebar">
            <section class="container-fluid">
                <ul class="navbar-nav d-flex flex-column mt-3 w-100">
                    <li class="nav-item w-100"><img src="website_icons/home-user_25.png" class="nav-picture" alt="">
                        <a class="nav-link text-light pl-4" href="/index.php">Home</a>
                    </li>
                    <li class="nav-item w-100"><a onclick= "document.getElementById('RegForm').style.display ='block' "class="nav-link text-light pl-4">Get Started</a></li>
                    <li class="nav-item w-100"><img src="./website_icons/User-profile.png" class="nav-picture" alt=""><a class="nav-link text-light pl-4" href="/Myprofile-xpg_source-code.php">My Profile</a></li>
                    <li class="nav-item w-100"><img src="./website_icons/multi_user.png" class="nav-picture" alt=""><a class="nav-link text-light pl-4" href="/xpgfriends_source-code.php">My Friends</a></li>
                    <li class="nav-item w-100"><img src="./website_icons/play-game.png" class="nav-picture" alt=""><a class="nav-link text-light pl-4" href="/XPG_playgames_source-code.html">GameNation</a></li>
                    <li class="nav-item w-100"><img src="website_icons/calendar-organizer-icon.png" class="nav-picture" alt=""><a class="nav-link text-light pl-4" href="/xpgevents_source-code.html">Events</a></li>
                    <li class="nav-item w-100"><a class="nav-link text-light pl-4" href="/contact_xpg-source-code.php">Contact Us</a></li>
                    <li class="nav-item w-100"><a class="nav-link text-light pl-4" href="/about-xpg_source-file.html">About XPG</a></li>
                </ul>
            </section> 
        </nav>
    </aside>
    <main class="main-content">
        <!--ACCESS VIDEO ARRAY USING JAVA FUNCTION-->
        <section class="slideshow">
            <section class="video-slides wrapper">
                <section class="numberText">1/4</section>
                <video autoplay muted controls loop class="video-bar" id="video-delay" type="mp4" poster="/Images/raven-from-tekken8.jpg"><source src="entertainment/TEKKEN 8 — Raven Reveal & Gameplay Trailer_Full-HD_60fps.mp4"></video>
            </section>
            <section class="video-slides">
                <section class="numberText">2/4</section>
                <video autoplay muted controls loop class="video-bar" id="video-delay1" type="mp4" poster="/Images/naruto-connections.jpg"><source src="entertainment/Naruto x Boruto Ultimate Ninja Storm Connections - Jigen, Kawaki & Karma Bor_HD_60fps.mp4"></video>
            </section>
            <section class="video-slides">
                <section class="numberText">3/4</section>
                <video autoplay muted controls loop class="video-bar" id="video-delay2" type="mp4" poster="/Images/Assassin's-mirage.jpg" title="ASSASSIN'S CREED MIRAGE Official Cinematic Trailer (2023) 4K"><source src="entertainment/ASSASSIN'S CREED MIRAGE Official Cinematic Trailer (2023) 4K.mp4"></video>
            </section>
            <section class="video-slides">
                <section class="numberText">4/4</section>
                <img class="video-bar" src="/Images/pokemon-go-six-billion-revenue.webp" alt="">
            </section>
            <section class="video-control"><!--SET FUNCTION TO ITERATE THROUGH VIDEOS WITH MANUAL NAVIGATION-->
                <section class="videoSlider-btn wrapper"></section>
                <section class="videoSlider-btn"></section>
                <section class="videoSlider-btn"></section>
                <section class="videoSlider-btn"></section>
            </section>
        </section>
        <section class="linear"></section>
        <section class="slider-advertising">
            <section class="rotation">
                <h4 class="large-txt">CATCH BIG SUMMER GAME DISCOUNTS!</h4>
                <p id="p11">Play all your favourite games online at <strong>AWESOMELY LOW</strong> renting prices plus, applicable <strong>discounts!</strong></p>
            </section>
        </section>
        <br>
        <br>
        <section class="welcome">
            <header class="header1">
                <h3 style="margin: 0; font-family: BankGothic Md BT; font-size: 40px;"><strong>HEY! Glad you could make it over to XPG Play Hub</strong></h3>
            </header>
            <section class="enter-xpg">
                <p id="tell">Welcome to XPG Play Hub, your premiere location for all the games you can find and enjoy. Search for your favourite 
                Games with new ones you can play by renting from as low as 30mins to an entire day of gaming in the hub. Games are available across all genres and if we don't have it, just leave your comments and we'll get it here!</p>
            </section>
        </section>
        <!--Set card display content to grid!-->
        <section class="content">
            <section class="card2">
                <h3 style="padding: 16px; font-weight:bold;">Your favourite games are here to play!</h3>
                <p style="line-height: 25px;">We have an awesome catalouge of Playstaion, Nintendo, and Xbox series games waiting for you.</p>
                <section class="card-image card-1"></section>
            </section>
            <section class="card2">
                <h3 style="padding: 16px; font-weight:bold;">Register and Join XPG</h3>
                <p style="line-height: 25px;">What are you waiting for? Create your account and begin to explore <strong>MUCH! MUCH!</strong> and awesome <strong>GAMES!</strong></p><br>
                <section class="card-image card-2">
                    <span class="overlay">
                        <a onclick= "document.getElementById('RegForm').style.display ='block' "class="game-link">Register NOW!</a>
                    </span>
                </section>   
            </section>
            <section class="card2">
                <h3 style="padding: 10px; font-weight:bold;">Connect with players</h3>
                <p style="line-height: 25px;">Locate friends close and far and team up to play your favourite muliplayer games!
                    Name your squad to compete against opponets online and rank up to claim rewards!</p>
                <section class="card-image card-3">
                    <span class="overlay">
                        <a class="game-link" href="/xpgfriends_source-code.php">Go Here!</a>
                    </span>
                </section>
            </section>
            <section class="card2">
                <h3 style="padding: 10px; font-weight:bold;">Get amazing discounts to beat expensive game prices</h3>
                <p style="line-height: 25px;">Rent and play your favorite games and discounts will come to <strong>YOU!</strong> Upto 25% discount when you play for 30mins or more daily.</p>
                <section class="card-image card-4">
                    <span class="overlay">
                        <a class="game-link" href="/XPG_playgames_source-code.html">View Prices!</a>
                    </span>
                </section>
            </section>
            <section class="card2">
                <h3 style="padding: 10px; font-weight:bold;">Download games</h3>
                <p style="line-height: 25px;">Our catalog is waiting for you to download all your preferred games by renting or pay a fixed cost to have your game ready to be installed on your device.</p>
                <section class="card-image card-5">
                    <span class="overlay">
                        <a class="game-link" href="/XPG_playgames_source-code.html">View Games</a>
                    </span>
                </section>
            </section>
            <section class="card2">
                <h3 style="padding: 15px; font-weight:bold;">Tune in to our occassioal and seasonal <strong>events!</strong></h3>
                <p style="line-height: 25px;">When you play and have fun, you are builing your profile to participate in our Promotions!</p>
                <section class="card-image card-6">
                    <span class="overlay">
                        <a class="game-link" href="/xpgevents_source-code.html">Get Updates</a>
                    </span>
                </section>
            </section>
        </section>
        <!-------------------Regsitration and Login Form---------------------------->
        <section id="RegForm" class="modal">
            <section class="aligned-center">
                <form class ="registerForm" method="post" action="" autocomplete="off" enctype="multipart/form-data">
                    <section class="terminator"><span onclick= "document.getElementById('RegForm').style.display='none'" class="close-btn" title="Close">&times;</span></section>
                    <section class="reg-container">
                        <header class="letterhead">
                            <h3 style="color: aquamarine;"><b>Create Your XPG Account</b></h3>
                            <p>Complete these quick and easy steps to get started!<br><small class="invalid"><?php echo @$user->error ?></small>
                            <small class="confirm"><?php echo @$user->confirmed ?></small></p>
                        </header>
                        <section class="user-registry">
                            <section class="box-input">
                                <label for="FirstName"><b>First Name</b></label>
                                <input type="text" class="enter-label" placeholder="First Name here" name="FirstName" required>
                            </section>
                            <section class="box-input">
                                <label for="LastName"><b>Last Name</b></label>
                                <span class="icon"></span>
                                <input type="text" class="enter-label" placeholder="Last Name here" name="LastName" required><br>
                            </section>
                            <section class="box-input">
                                <label for="Bday"><b>Birthday</b></label>
                                <input type="date" class="enter-label" placeholder="dd/mm/yyyy" name="Bday" required>
                            </section>
                            <section class="box-input">
                                <label for="Age"><b>Age</b></label>
                                <input type="number" name="Age" id="ages"><br>
                                <small class="error">You're too young</small>
                            </section>  
                        </section>
                        <section class="box">
                            <label><b>Country/Nationality</b></label>
                            <select id="Country" name="Country">
                                <option value="United States">United States</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Africa">Africa</option>
                                <option value="Poland">Poland</option>
                                <option value="China">China</option>
                                <option value="Japan">Japan</option>
                                <option value="North Korea">North Korea</option>
                                <option value="South Korea">South Korea</option>
                                <option value="India">India</option>
                                <option value="Brazil">Brazil</option>
                            </select>
                        </section>
                        <section class="My-gender">
                            <span><b>Gender</b></span>
                            <input type="radio" name="Gender" id="spot-1">
                            <input type="radio" name="Gender" id="spot-2">
                            <input type="radio" name="Gender" id="spot-3">
                            <label for="spot-1"><span class="spot one" name="Gender"></span><span name="Gender">Male</span></label>
                            <label for="spot-2"><span class="spot two" name="Gender"></span><span name="Gender">Female</span></label>
                            <label for="spot-3"><span class="spot three" name="Gender"></span><span name="Gender">Rather not say</span></label>
                        </section>
                        <!--Validation section-->
                        <section class="Validate">
                            <section class="Enter">
                                <label for="Email"><b>Email</b></label>
                                <input type="email" class="enter-label" id="email" placeholder="Enter Email here" name="Email" required><br>
                                <small class="error">Invalid Email</small>
                            </section>
                            <section class="Enter">
                                <label for="Usr-name"><b>Username</b></label>
                                <input type="text" class="enter-label" id="username" placeholder="Myprofilexpg21" name="Username" required><br>
                                <small class="invalid"><?php echo @$user->invalid ?></small>
                                <small class="error">We don't like that username, try again</small>
                            </section>
                            <section class="Enter">
                                <label for="P-word"><b>Password</b></label>
                                <input type="password" class="enter-label" id="Password" placeholder="Password required" name="Password" pattern="(?=.*\d)(?=.*[a-z)](?=.*[A-Z]).{8}" title="Should contain atleast: 8 characters (including caps, uppercase), and numbers/symbols" required><br>
                                <small class="error">Password not safe</small>
                            </section>
                            <section class="Enter">
                                <label for="re-affrim"><b>Confirm Password</b></label>
                                <input type="password" class="enter-label" id="Password99" placeholder="Confirm Password" name="Reaffrim" pattern="(?=.*\d)(?=.*[a-z)](?=.*[A-Z]).{8}" required>
                                <small class="invalid"><?php echo @$user->error ?></small>
                                <small class="error">No match</small>
                            </section>
                            <p id="p7">Tick the box so XPG won't forget you on your next login</p>
                        </section>
                        <label for="gender"><input type="checkbox" aria-checked="checked">Never Forget</label>
                        <p id="p7">Once completed and confirmed, you agree to our <a href="/about-xpg_source-file.html">data protection policy</a></p>
                        <button type="button" class="cancel-btn" onclick="document.getElementById('RegForm').style.display='none'">Cancel</button>
                        <button type="submit"class="sub-button" name="submit">Confirm</button>
                    </section>
                    <span class="register-login">Already signed up with XPG?<a href="/login.php" class="login-link"> Then login now</a></span>
                </form>
                <!-------------------End of Form---------------------------->
            </section>
        </section>
        <!--TO GET POPUP MESSAGE-->
        <section class="modal-pop" id="welcome-user">
            <section class="pop-content" >
                <section class="head-popper"><section class="shaders" style="display: flex;"><img src="/website_icons/xpg-white-image3.png" class="flovia" alt="">
                    <h3>PLAY HUB.</h3></section><span class="popper-btn" title="" id="ending">&times;</span>
                </section>
                <section class="poppup-decoration">
                    <img src="/Images/Fortnite ps4.jpg" class="photo-sizing" alt="">
                    <img class="image-screening" alt="" src="/Images/Smash_ultimate1.png">
                </section>
                <a href="/XPG_playgames_source-code.html">CKECKOUT OUR GAMES NOW!!</a>
            </section>
        </section>
        <footer class="feet">
            <section class="trapezoid">
                <section class="footing"><h4 class="contact-heading">Contact US</h4></section>
            </section>
            <section class="footer-links">
                <section class="left-column">
                    <p id="bold"><b>Connect with us</b></p>
                    <section class="flex">
                        <ul class="social-media">
                            <li><a href=""><img src="website_icons/facebook1.png" class="social-icons" alt=""></a></li>
                            <li><a href=""><img src="website_icons/whatsapp2.png" class="apps" alt=""></a></li>
                            <li><a href=""><img src="website_icons/Instagram_icon.png.png" class="social" alt=""></a></li>
                            <li><a href=""><img src="website_icons/ios-email-icon-28.jpg" class="apps" alt=""></a></li>
                        </ul>
                        <ul class="social-media-items">
                            <li><a href="#" class="social-link">@xpggamecenter.21</a></li>
                            <li><a href="#" class="social-link">XPG Live</a></li>
                            <li><a href="#" class="social-link">@xpg_syndicates13</a></li>
                            <li><a href="#" class="social-link">xpghubplaycenter@gmail.com</a></li>
                        </ul>
                    </section>
                </section>
                <section class="middle-column">
                    <p id="support">Support Links</p>
                    <ul class="useful-links">
                        <li><a class="navigation-links" href="/about-xpg_source-file.html">Learn About Us</a></li>
                        <li><a class="navigation-links" href="/XPG_playgames_source-code.html">Games</a></li>
                        <li><a class="navigation-links" href="/xpgevents_source-code.html">See what's in store for you</a></li>
                        <li><a class="navigation-links" href="/xpg_customerservicehub.php">Age Policy Agreement</a></li>
                        <li><a class="navigation-links" href="#">return to top</a></li>
                    </ul>   
                </section>
                <section class="middle-column">
                    <p id="support">Resources you can use</p>
                    <ul class="useful-links">
                        <li><a class="navigation-links" href="/about-xpg_source-file.html">Developers</a></li>
                        <li><a class="navigation-links" href="/about-xpg_source-file.html">Community</a></li>
                        <li><a class="navigation-links" href="https://xpgwallhub.wordpress.com/">XPG Wall Hub</a></li>
                        <li><a class="navigation-links" href="https://www.playstation.com/en-us/">Our Corporate Game Partners</a></li>
                        <li><a class="navigation-links" href="/xpg_customerservicehub.php">Customer Service</a></li>
                    </ul>   
                </section>
                <section class="right-column">
                    <img src="website_icons/xpg-image copy.png" class="xpg-logo" alt="">
                    <p id="logo-maker">Experience Personal Gaming</p>
                </section>
            </section>
            <section class="line" style=" transform: translateY(-70px);">
                <p style="margin: 0;">Copyrights © 2023 All rights reserved. Developed by <a href="#">XPGSYNDICATES</a></p>
            </section>
        </footer>
    </main>
    <script src="Myscript.js"></script>
    <script type="text/javascript">
        //to toggle navbar//
        var toggle_btn = document.querySelector("#toggle-btn");
        var sidebar = document.querySelector("aside");
        var main_content = document.querySelector(".main-content");
        
        toggle_btn.addEventListener("click", ()=>{
            sidebar.classList.toggle("active-nav");
            main_content.classList.toggle("active-cont");

        })
        //remove sidebar when clicked outside
        document.onclick = function(e){
            if(!toggle_btn.contains(e.target) && !sidebar.contains(e.target)){
                sidebar.classList.remove("active-nav");
                main_content.classList.remove("active-cont");
            }
        }
        
        //for slideshow
        var slides = document.querySelectorAll(".video-slides");
        var controller = document.querySelectorAll(".videoSlider-btn");
        let movingSlider = 1;

        //Navigation button slider
        var slidingbuttons = function(manual){
            slides.forEach((slide) => {
                slide.classList.remove("wrapper");

                controller.forEach((tap) => {
                    tap.classList.remove("wrapper");
                    //SET FUNCTION TO ITERATE THROUGH VIDEOS WITH MANUAL NAVIGATION
                })
            });

            slides[manual].classList.add("wrapper");
            controller[manual].classList.add("wrapper");
        }

        controller.forEach((button, i) => {
            button.addEventListener("click", () => {
                slidingbuttons(i);
                movingSlider = i;
            });
        });
        //auto video slide incrementing initiated here:
        var auto_initiate = function(automation){
            let activate = document.getElementsByClassName("wrapper")
            let i = 1;

            var initiater = () =>{
                setTimeout(function(){
                    [...activate].forEach((automation) =>{
                        automation.classList.remove("wrapper")
                    })

                    slides[i].classList.add("wrapper")
                    controller[i].classList.add("wrapper")
                    i++;

                    if(slides.length == i){
                        i = 0;
                    }

                    if(i >= slides.length){
                        return;
                    }
                    initiater()
                },125000)//15 seconds //2mns, 5s
            }
            initiater();
        }
        auto_initiate();
    </script>
    <!--<script src="https://code.jquery.com/jquery-3.6.4.js"integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="crossorigin="anonymous"></script>-->
</body>
</html>