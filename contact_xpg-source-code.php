<!DOCTYPE html>
<html lang="en">
<head>
<title>www.xpgplayhub.com</title>
<link type="image/x-icon" rel="icon" href="/website_icons/xpg-image3 copy.png">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--BS5 File!-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!--CSS File!-->
<link rel="stylesheet" href="css/game_style.css">
<link rel="stylesheet" href="css/mynewCSS.css">
</head>
<?php 
    if(isset($_POST['submit']) && !empty($_POST['Comments'])){
        $userName = $_POST["Username"];
        $emailAdrrs = $_POST["email"];
        $messages = $_POST["Comments"];
        $sendToXPG_Admin = "ashirakanbara2005@gmail.com";

        $mailHeader = "XPG user: " . $userName .
        "\r\n Email: " . $emailAdrrs .
        "\r\n User comment: " . $messages . "\r\n";

        if(mail($sendToXPG_Admin, $userName, $mailHeader)){
            $success = "Your message have been sent directly! Developer will review within 24hrs";
        }else if(!mail($sendToXPG_Admin, $userName, $mailHeader)){
            $failure = "Something went wrong, please try again";
        }
    }
?>
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
                    <li class="nav-item w-100"><img src="/website_icons/home-user_25.png" class="nav-picture" alt="">
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
    <main id="main14">
        <aside class="contact-info-pillar">
            <section class="logo-container">
                <img src="website_icons/xpg-image3 copy.png" class="company-logo" alt="">
            </section>
            <h4 style="text-align: left; margin-left: 50px; color: rgb(157, 255, 250); text-decoration: overline;">Contact Us</h4><br>
            <!--Contact Container--->
            <ul class="social-contact">
                <li><a href="#"><img src="website_icons/phone-icon-.png" class="caller-icon" alt=""></a></li>
                <li><a href="#"><img src="website_icons/instagram-image_icon.png" class="caller-icon" alt=""></a></li>
                <li><a href="#"><img src="website_icons/Facebook_f_logo_(2021).svg.png" class="caller-icon" alt=""></a></li>
                <li><a href="#"><img src="website_icons/ios-email-icon-27.jpg" class="caller-icon" alt=""></a></li>
                <li><a href="#"><img src="website_icons/whatsapp.png" class="caller-icon" alt=""></a></li>
            </ul>
            <ul class="media-contacts">
                <li><p class="info">+1(876)-456-8001/ 582-5493</p></li>
                <li><p class="info">Instagram: @xpg_syndicates13</p></li>
                <li><p class="info">Facebook: xpggamecenter21 </p></li>
                <li><p class="info">Email: xpgplaycenter@gmail.com</p></li>
                <li><p class="info">WhatsApp: 582-5493 (XPG LIVE)</p></li>
            </ul>
            <section class="description">
                <p class="know">The XPG Hub wants to hear your comments. We’d like to know what you think about our website.  Visit or social media pages.</p>
            </section>
        </aside>
        <section class="coloring-header">
            <h3 style="text-align: right; padding: 15px; font-family: calibri; font-size: 42px; margin-right: 50px;">Contact Us</h3>
        </section>
        <section class="contact-info-cont">
            <section class="card4">
                <form for="" class="xpg-contact">
                    <section class="contact-info">
                        <section class="contact-panel">
                        <?php if(!empty($success)){
                                ?>
                                <small class="confirm"><?php echo $success; ?></small>
                                <?php
                                header("Location: contact_xpg-source-code.php?successful!");
                            }
                            ?>
                        <label class="problem-label">Have a problem with our site?</label><br>
                            <label class="problem-label">Your Name</label>
                            <input type="text" placeholder="Your name" class="suggest-input" required name="Username">
                            <!--<input type="submit" value="Report">-->
                        </section>
                        <section class="contact-panel">
                            <label class="problem-label">Your Email</label>
                            <input type="email" placeholder="Email here..." class="suggest-input" required name="email">
                            <!--<input type="submit" value="Report">-->
                        </section>
                        <section class="comment-submit">
                            <label class="problem-label">Message Us</label>
                            <textarea name="Comments" rows="1" placeholder="let us know how we can help..." class="add-comment" required></textarea>
                            <button type="submit" name="submit"class="send-comment">Submit</button>
                        </section>
                    </section>
                </form>
            </section>
        </section>
        <footer class="footer0">
            <p>Copyrights © 2023 All rights reserved. Developed by XPGSYNDICATES</p>
        </footer>
    </main>
    <script>
        //to toggle navbar//
        var toggle_btn = document.querySelector("#toggle-btn")
        var sidebar = document.querySelector("aside")
        var main_content = document.querySelector(".main-content")
        toggle_btn.addEventListener("click", ()=>{
            sidebar.classList.toggle("active-nav")
            main_content.classList.toggle("active-cont")
        })

        document.onclick = function(e){
            if(!toggle_btn.contains(e.target) && !sidebar.contains(e.target)){
                sidebar.classList.remove("active-nav");
                main_content.classList.remove("active-cont");
            }
        }
    </script>
    <script src="Myscript.js"></script>
</body>
</html>