<?php require('login-to_xpg.php')?>
<?php 
    if(isset($_POST['submit'])){
        $user = new LoggedinUser($_POST['Email'], $Username = $_POST['Username'], $_POST['Password']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>www.xpgplayhub.com</title>
<link type="image/x-icoN" rel="icon" href="../website_icons/xpg-image copy.png" width="20px" height="10px">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/game_style.css">
</head>
<header class="header0" style="position: fixed;"><section class="display"><img src="/website_icons/xpg-image3.png" class="header-Logo"><h2 style="margin: 0; font-weight: 600; font-size:19px; text-align: left;">PLAY<br>HUB</h2></section></header>
<body>
    <main class="expanding">
        <section class="login-back">
            <!--Loginf form-->
                <section class="aligned-center">
                    <form class="logbox" action="" method="post" autocomplete="on"><small class="invalid"><?php echo @$user->incorrect ?></small><br>
                        <span class="login-register"><p>Haven't Signed Up yet? <a href="/index.php" class="register-link">Register</a></p></span>    
                        <section class="login-box">
                            <header id="header5" style="padding: 20px 0 10px 0; font-size: 20px;">
                                <h2 style="color: rgb(255, 255, 255);"><b>Login to XPG</b></h2>
                            </header>
                            <span class="icon"></span>
                            <input type="email" class="get-into-xpg" placeholder="Email" name="Email" required>
                            <!--<small class="invalid"></small>--><br>
                            <span class="icon"></span>
                            <input type="text" class="get-into-xpg" placeholder="Username" name="Username" required>
                            <!--<small class="invalid"></small>--><br>
                            <input type="password" class="get-into-xpg" placeholder="Password" name="Password" pattern="(?=.*\d)(?=.*[a-z)](?=.*[A-Z]).{8}"required>
                            <small class="invalid"><?php echo @$user->wrong?></small><br>
                            <button type="submit" class="login-btn" name="submit">Login</button><br>
                            <section class="log-bottom">
                                <label><input type="checkbox" aria-checked="checked">Never Forget</label>
                                <span><a class="forget" href="#">Forget Password?</a></span>
                            </section>
                        </section>
                    </form>
                </section>
            <!--<footer id="footer2">
                <p>Copyrights © 2023 All rights reserved. Developed by XPGSYNDICATES</p>
            </footer>-->
        </section>
    </main>
    <script src="Myscript.js"></script>
</body>
</html>