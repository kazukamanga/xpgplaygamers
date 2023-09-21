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
<body id="body2">
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
    <main>
        <section class="page-fixation">
            <section class="behind-img">
                <h3 style="text-align: right; padding: 15px; font-family: calibri; font-size: 42px; margin-right: 50px;">Find Friends</h3>
            </section>
            <section class="transparent-effect">
                <section class="centerpoint">
                    <form class="search-xpg"><!---Search friends bar-->
                        <input type="search" name="search" id="friend-seeker" placeholder="Find friends..." class="find-friends" onkeyup="global()">
                        <button type="button" class="search-btn" title="search"><img src="/website_icons/search-icon-vector-6093076.png" alt="" width="30px" height="30px"></button>
                    </form>
                    <section class="graphics">
                    <?php 
                        //Retrieve logged in user image from databse
                        $userID = $_SESSION['user'];
                        $conn = mysqli_connect("localhost", "root", "", "profileuploader");
                        $sql = "SELECT user_image FROM xpgusers WHERE Username = '$userID';";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            if($images = mysqli_fetch_assoc($result)){
                                ?>
                                <img class="profile-img" src="/Uploader/<?=$images['user_image']?>" height="50px" width="55px" alt="">
                                <?php
                            }
                        }
                        $conn->close();
                        ?>
                    <section class="userprofile"><p id="p7"><b><?php echo $_SESSION['user']; ?></b></p></section>
                    <p id="p8">Not apart of a squad</p>
                    </section>
                </section>
                <!--Friend list menu----------------------------------------------------------------->
                <section id="to-flex-content">
                    <section class="international">
                        <button type="button" class="play-connect">CLOSE FRIENDS</button>
                        <button type="button" class="play-connect">FIND FRIENDS</button>
                    </section>
                    <section class="friend-list" id="user-directory">
                        <?php
                        $json_data = file_get_contents("XPG-Userstorage.json");
                        $database = json_decode($json_data, true);
                        if(count($database) != 0){
                            foreach($database as $data){
                            //Retrieve logged in user image from databse
                            $userid = $_SESSION['user'];
                            $conn = mysqli_connect("localhost", "root", "", "profileuploader");
                            $sqlImg = "SELECT user_image FROM xpgusers WHERE Username = '$userid';";
                            $resultImg = mysqli_query($conn, $sqlImg);
                            if(mysqli_num_rows($result) > 0){
                                if($images = mysqli_fetch_assoc($resultImg)){
                                    ?>
                                    <section class="card9">
                                        <section class="filephoto">
                                            <img class="profile-img" src="/Uploader/<?=$images['user_image']?>" alt="">
                                        </section>
                                        <section class="chat-toggler" title="Open chat">
                                            <a onclick="document.getElementById('messenger').style.display='block'"><img src="website_icons/chat-alt-solid.png" width="40px" height="40px" class="chatbar" alt=""></a>
                                        </section>
                                        <section class="default-text">
                                            <h5 style="margin: 5px 5px 5px 20px;"><?php echo $data['Username']?></h5>
                                            <p id="p1" style="margin: 1px 1px 1px 20px;">Hey there! I'm using XPG. Let's game!</p>
                                        </section>
                                    </section>    
                                    <?php  
                                }
                            }
                            $conn->close();
                            }
                        }else {
                            echo "Nothing found";
                        }
                        ?>
                    </section>    
                    <!--Creating chat box-->
                    <section class="chatbox" id="messenger">
                        <section class="pro-chatter">
                            <section class="chat-header">
                                <img src="website_icons/profile.png" width="45px" height="45px" class="friend-picture" alt="">
                                <section class="message-profile">
                                    <h4 class="page">XPG CHATBOT (Beta)</h4>
                                    <p class="msg-status">online</p>
                                </section>
                                <i class="report-chat-toggle"><img src="/website_icons/more-action_dots.png" alt=""></i>
                                <ul class="report-chat-menu">
                                    <li><a href="#">Report</a></li>
                                    <li><a href="#">Block</a></li>
                                </ul>
                                <span onclick="document.getElementById('messenger').style.display='none'" class="close-msg" title="close">&times;</span>
                            </section>
                            <h4 class="Zero-messages">No messages yet</h4>
                            <section class="message-content">
                                <!--<section class="message-row">
                                    <img src="Images/Tekken-8_Jin.jpg" class="user-img" width="50px" height="50px" alt="">
                                    <span class="textmsg messager">
                                        <p id="p13">Hey there, i am chatting!</p><span class="message-time">11:50 PM</span>
                                    </span>
                                </section>
                                <section class="message-row">
                                    <span class="textmsg msg-received">
                                        <p id="p13">Hey there, i am chatting away!</p><span class="message-time">11:50 PM</span>
                                    </span>
                                    <img src="website_icons/profile.png" class="user-img" width="50px" height="50px" alt="">
                                </section>
                                <section class="message-row">
                                    <img src="Images/Tekken-8_Jin.jpg" class="user-img" width="50px" height="50px" alt="">
                                    <span class="textmsg messager">
                                        <p id="p13">Hey there, i am chatting!</p><span class="message-time">11:50 PM</span>
                                    </span>
                                </section>-->
                            </section>
                            <form action="#" class="message-sent">
                                <textarea rows="1" placeholder="type here..." class="input-message"></textarea>
                                <button type="submit" class="send-msg"><img src="website_icons/1034262.png" class="msg-icon" alt="" title="send message"></button><!--send message button will go here-->
                            </form>
                        </section>
                    </section>
                    <footer id="footer3">
                        <p>Copyrights © 2023 All rights reserved. Developed by XPGSYNDICATES</p>
                    </footer>
                </section>
            </section>
        </section>
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

        const global = () =>{
            const friend_seeker = document.getElementById("friend-seeker").value.toUpperCase();
            const userprofile = document.getElementById("user-directory")
            const friend = document.querySelectorAll(".card9")
            const friendname = document.getElementsByTagName("h5")

            for(var i=0; i < friendname.length; i++){
                let match = friend[i].getElementsByTagName('h5')[0];
                if(match){
                    let textvalue = match.textContent || match.innerHTML

                    if(textvalue.toUpperCase().indexOf(friend_seeker) >-1 ){//if input is greater than -1 show results
                        friend[i].style.display = "";
                    }else{
                        friend[i].style.display = "none";
                    }
                }
            }
        }
        
        //toggle chat box (100%)//
        const reportToggle = document.querySelector(".report-chat-toggle")
        const reportMessage = document.querySelector(".report-chat-menu")

        reportToggle.addEventListener("click", function () {
            reportMessage.classList.toggle("shower")
        })

        //CHATBOX MESSAGES--------//
        const panelChatting = document.querySelector(".message-content")
        const zeroMessages = document.querySelector(".Zero-messages")

        //Message input
        const textarea = document.querySelector(".input-message")
        const chatboxForm = document.querySelector(".message-sent")
        textarea.addEventListener("input", function (){
            let line = textarea.value.split("\n").length

            if(textarea.rows < 6 || line < 6){
                textarea.rows = line         //limits text input areas rows to 6
            }
            
            if(textarea.rows > 1){
                chatboxForm.style.alignItems = "flex-end";
            }else{
                chatboxForm.style.alignItems = "center";
            }
        })

        chatboxForm.addEventListener('submit', function (z) {//the following prototypes must be satisfied before message submits
            z.preventDefault()

            if(Text_validation(textarea.value)){
                messagePublisher()
                setTimeout(chatBot, 1000)  //chatBot respnd after 1sec
            }
        })
        //time format funciton
        function addZero(num){
            return num < 10? '0'+num : num
        }

        function messagePublisher(){
            const today = new Date()//add current time message was sent or received.
            let messaging = `
            <section class="message-row">
                <img src="/Uploader/<?=$images['user_image']?>" class="user-img" width="50px" height="50px" alt="">
                <span class="textmsg messager">
                    ${textarea.value.trim().replace(/\n/g, "<br>\n")}<span class="message-time">${addZero(today.getHours())}:${addZero(today.getMinutes())}</span>
                </span>
            </section>`

            panelChatting.insertAdjacentHTML("beforeend", messaging)
            chatboxForm.style.alignItems = "center";
            textarea.rows = 1
            textarea.focus()
            textarea.value = "";
            zeroMessages.style.display = "none";
            bottomDisplay()
        }   

        function chatBot(){
            const today = new Date()//add current time message was sent or received.
            let messaging = `
            <section class="message-row">
                <span class="textmsg msg-received">
                    Hello, good day. How are you? <span class="message-time">${addZero(today.getHours())}:${addZero(today.getMinutes())}</span>
                </span>
                <img src="website_icons/profile.png" class="user-img" width="50px" height="50px" alt="">
            </section>`

            panelChatting.insertAdjacentHTML("beforeend", messaging)
            bottomDisplay()
            
        }
        //function to automatically scroll to bottom when a message pops in
        function bottomDisplay(){
            panelChatting.scrollTo(0, panelChatting.scrollHeight)
        }
        //function to check if usr is sending empty text
        function Text_validation(value){
            let text = value.replace(/\n/g, '')
            text = text.replace(/\s/g, '')

            return text.length > 0
        }
    </script>
    <script src="Myscript.js"></script>
</body>
</html>
