<?php
require ('steamauth/steamauth.php');
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Rust Serveri</title>
</head>

<body>
    <div class="navbar">
        <div class="left">
            <a href=""><img class="logo" src="assets/img/logo2.png" width="45px" height="45px" alt=""></a>
            <ul>
                <li>Home</li>
                <li>VIP</li>
                <li>Support</li>
                <li>Servers</li>
                <li>Discord</li>
            </ul>
        </div>
        <div class="profile-nav">

        <?php
        if(!isset($_SESSION['steamid'])) {
            ?>
            
            <ul>
                <li><a class="login"  href="login.php?login">Login</a></li>
            </ul>
            <?php
        }else {
            if (empty($_SESSION['steam_uptodate']) or empty($_SESSION['steam_personaname'])) {
                require 'steamauth/SteamConfig.php';
                $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamauth['apikey']."&steamids=".$_SESSION['steamid']); 
                $content = json_decode($url, true);
        ?>
            <ul>
                <img class="pp" src="<?php echo $_SESSION['steam_avatar'] = $content['response']['players'][0]['avatar'];?>" width="40px" height="40px" alt="">
                <li><?php echo $_SESSION['steam_personaname'] = $content['response']['players'][0]['personaname'];?></li>
                <li>Notifications</li>
                <li><a href="http://localhost/logout.php">Logout</a></li>
            </ul>
            <?php
            }
        }
            ?>
        </div>
    </div>
    <div class="container">
        <div class="notif">
            <h3><a href="steam://connect/146.19.57.153:28015">Click</a> to join the server</h3>
        </div>
        <div class="merkez">
            <img src="assets/img/main.png" width="30%" alt="">
            <div class="buttons">
            <button><a href="servers">Servers</a></button>
            <button>Discord</button>
            <button>Vıp Store</button><br>
            <button>Rules</button>
            <button>Support</button>
            <button>Ban Appeal</button>
        </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-left">
            Terms of services Privacy Policy
        </div>
        <div class="footer-right">Copyright © 2022 Syber</div>
    </div>
</body>

</html>