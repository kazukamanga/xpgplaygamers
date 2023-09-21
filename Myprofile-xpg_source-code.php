<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header("location: login.php"); exit();
    }

    if(isset($_GET['logout'])){
        unset($_SESSION['user']);
        header("location: login.php"); exit();
    }

?>
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
</head>
<div class="sticky">
<header class="header0" style="position: fixed;"><section class="display"><img src="/website_icons/xpg-image3.png" class="header-Logo"><h2 style="margin: 0; font-weight: 600; font-size:19px; text-align: left;">PLAY<br>HUB</h2></section>
    <section class="displayer"><a href="? logout" class="head-btn">Log Out</a><span class="navbar-toggler" id="toggle-btn"><img src="website_icons/navbar2.png" class="Navbar-icon"alt="" title="Menu"></span></section>
</header>
</div>
<body id="bodypart">
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
    <main class="main2">
        <section class="fix-items">
            <aside class="Myprofile">
                <section class="card5">
                <?php
            //profile page
                $jsonString = file_get_contents('XPG-Userstorage.json');
                $userID = json_decode($jsonString, true);
                $loggedInUsername = $_SESSION['user'];//user information stroed in session variable if successfully authenticated
                $loggedInUser = null;
                //logged in user is identified using username from database to load correct info
                foreach ($userID as $user){
                    if($user['Username'] === $loggedInUsername){
                        $loggedInUser = $user;
                    break;
                    }
                }
                if($loggedInUser){
                    ?>
                    <section class="profile-header">
                        <?php 
                        //Retrieve logged in user image from databse
                        $userid = $_SESSION['user'];
                        $conn = mysqli_connect("localhost", "root", "", "profileuploader");
                        $query = "SELECT user_image FROM xpgusers WHERE Username = '$userid';";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0){
                            if($images = mysqli_fetch_assoc($result)){
                            ?>
                            <img src="/Uploader/<?=$images['user_image']?>" alt="Profile Image" class="profile-photo">
                            <?php 
                            }
                        }
                        $conn->close();
                        ?>
                        <form action="user-handler.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="profileimg">
                            <button type="submit" name="submit" class="uploading" title="Upload Image"><img src="/website_icons/seeker.png" width="40px" height="40px" alt=""></button>
                        </form>
                        <section class="profile-name"><h5><b><?php echo $_SESSION['user']; ?></b></h5></section>
                    </section>
                    <form class="user-details" action="" method="post">
                        <section class="icon-save">
                            <label for="Username" class="profile-label">Edit Username</label>
                            <input type="text" placeholder="<?php echo $loggedInUser['Username']; ?>" class="edit-input">
                            <img src="website_icons/User-profile.png" class="save-edits" height="20px" width="20px" alt="">
                        </section>
                        <section class="icon-save">
                            <label for="Email" class="profile-label">Change Email</label>
                            <input type="email" placeholder="<?php echo $loggedInUser['Email']; ?>" class="edit-input">
                            <img src="website_icons/ios-email-icon-28.jpg" class="save-edits" height="20px" width="20px" alt="">
                        </section>
                        <section class="icon-save">
                            <label class="profile-label">Add Phone</label>
                            <input type="tel" class="edit-input" placeholder="+123-456-7899">
                            <img src="website_icons/phone-icon-.png" class="save-edits" height="20px" width="20px" alt="">
                        </section>                            
                        <section class="icon-save">
                            <label for="Password" class="profile-label">Change Password</label>
                            <input type="text" class="edit-input">
                            <img src="website_icons/reply-icon-12.png" class="save-edits" height="20px" width="20px" alt="">
                        </section>
                        <section class="icon-save">
                            <label class="profile-label">Add Bio<textarea rows="1" placeholder="Hey there! Im on XPG..." class="biography"></textarea></label>
                        </section>
                        <section>
                            <label class="profile-label">Change Account Langauge</label>
                            <select id="Langauge" class="language">
                                <option value="Standard">English</option>
                                <option value="Spanish">Espanol</option>
                                <option value="French">French</option>
                                <option value="Japanese">Japanese</option>
                                <option value="Korean">Korean</option>
                                <option value="Arabic">Arabic</option>
                            </select>
                        </section>
                        <button type="submit" title="save changes" class="saver">Save Changes<img src="website_icons/reply-icon-12.png" height="20px" width="20px" alt=""></button>
                    </form>
                    <?php
                    }else{
                        echo "User not found!";
                    }
                ?>  
                </section> 
            </aside>
            <section class="watch-vidoes">
                <section class="head-confinement"><h3 style="text-align: right; padding: 15px; font-family: calibri; font-size: 40px; margin-right: 50px;"><b>MY PROFILE</b></h3></section>
                <section class="video-game-header">
                    <h4>Watch New Releases</h4>
                </section>
                <section class="theatre">
                    <video poster="/Images/Assassin's-mirage.jpg" class="motion-pictures" type="mp4" loop controls autoplay muted><source src="entertainment/ASSASSIN'S CREED MIRAGE Official Cinematic Trailer (2023) 4K.mp4"></video>
                    <ul class="video-gallery">
                        <li onclick="videoslider('entertainment/TEKKEN 8 – Kazuya Gameplay Trailer_Full-HD_60fps.mp4')"><video poster="/Images/tekken-8-kazuya-trailer-insider-gaming.png" class="My-vidoes"><source src="entertainment/TEKKEN 8 – Kazuya Gameplay Trailer_Full-HD_60fps.mp4"></li>
                        <li onclick="videoslider('entertainment/TEKKEN 8 — Jin Kazama Gameplay Trailer_HD.mp4')"><video poster="/Images/Jin-trailer_images.jpg" class="My-vidoes"><source src="entertainment/TEKKEN 8 — Jin Kazama Gameplay Trailer_HD.mp4"></li>
                        <li onclick="videoslider('entertainment/TEKKEN 8 — Marshall Law Gameplay Trailer_HD_60fps.mp4')"><video poster="/Images/tekken-law.jpg" class="My-vidoes"><source src="entertainment/TEKKEN 8 — Marshall Law Gameplay Trailer_HD_60fps.mp4"></li>
                        <li onclick="videoslider('entertainment/Tekken 8 - Jun Kazama Gameplay Trailer _ PS5 Games_Full-HD_60fps.mp4')"><video poster="/Images/jun-kazama.jpg" class="My-vidoes"><source src="entertainment/Tekken 8 - Jun Kazama Gameplay Trailer _ PS5 Games_Full-HD_60fps.mp4"></li>
                        <li onclick="videoslider('entertainment/TEKKEN 8 — Lars Alexandersson Gameplay Trailer_HD_60fps.mp4')"><video poster="/Images/lars-alexanderson.jpg" class="My-vidoes"><source src="entertainment/TEKKEN 8 — Lars Alexandersson Gameplay Trailer_HD_60fps.mp4"></li>
                        <li onclick="videoslider('entertainment/TEKKEN 8 – Lili Reveal & Gameplay Trailer_HD_60fps.mp4')"><video poster="/Images/Tekken_lili-revealed.jpg" class="My-vidoes"><source src="entertainment/TEKKEN 8 – Lili Reveal & Gameplay Trailer_HD_60fps.mp4"></li>
                        <li onclick="videoslider('entertainment/Naruto x Boruto Ultimate Ninja Storm Connections - Jigen, Kawaki & Karma Bor_HD_60fps.mp4')"><video poster="/Images/naruto-connections.jpg" class="My-vidoes"><source src="entertainment/Naruto x Boruto Ultimate Ninja Storm Connections - Jigen, Kawaki & Karma Bor_HD_60fps.mp4"></li>
                    </ul>
                </section>
                <br>
                <section class="entertain-header">
                    <h4>Things you might like to watch</h4>
                </section>
                <section class="entertainemnt">
                    <video class="video-center" loop controls><source src="entertainment/Last Stand _ Boruto_ Naruto Next Generations.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/Ada Wong RE4 Red Dress - Resident Evil 4 Remake_HD_60fps.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/FAST X _ Final Trailer.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/Harley Quinn and Nightwing chemistry goes hard _ Gotham Knights.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/Sasuke vs Kinshiki _ Boruto_ Naruto Next Generations.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/Every Saitama punches  _ One punch man - Season1_HIGH.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/Naruto FanMoive MinatoVS Obito.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/Jin Kazama vs. Hwoarang _ Tekken- Bloodline _ Clip _ Netflix Anime_HIGH.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/Brotherhood Final Fantasy XV - Episode 1_ _Before The Storm_.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/Baryon Mode Naruto vs Isshiki _ Full Fight HD.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/Nina Williams vs. Ling Xiaoyu _ Tekken- Bloodline _ Clip _ Netflix Anime_HIGH.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/NSUNS4 2023-02-18 22-37-51 (2).mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/Marvel Studios’ Guardians of the Galaxy Vol. 3 _ Official Trailer.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/GIRLS vs BOYS New Costume SUMMER GAMEPLAY - Naruto uLTIMATE Ninja STORM 4K!H_HD.mp4"></video>
                    <video class="video-center" loop controls><source src="entertainment/TEKKEN 8 Combos __ Alpha Test Gameplay_HD_60fps.mp4"></video>
                    <video poster="/Images/naruto-connections.jpg" class="video-center" loop controls><source src="entertainment/Naruto x Boruto Ultimate Ninja Storm Connections - Announcement Trailer _ PS5 & PS4 Games.mp4"></video>                    
                </section>
                <footer id="grad2">
            <p>Copyrights © 2023 All rights reserved. Developed by XPGSYNDICATES</p>
            </footer>
            </section>
        </section>
    </main>
    <script type="text/javascript">
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

        //function to get side navigation video slider(100%)
        function videoslider(links){
            document.querySelector(".motion-pictures").src = links;
        }
    </script>
    <script src="Myscript.js"></script>
</body>
</html>
