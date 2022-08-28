<?php
require ('../steamauth/steamauth.php');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>SyberRust Server</title>
</head>
<body>
    <div class="navbar">
        <div class="left">
            <a href=""><img class="logo" src="../assets/img/logo2.png" width="45px" height="45px" alt=""></a>
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
                <li><a class="login"  href="../login.php?login">Login</a></li>
            </ul>
            <?php
        }else {
            if (empty($_SESSION['steam_uptodate']) or empty($_SESSION['steam_personaname'])) {
                require '../steamauth/SteamConfig.php';
                $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamauth['apikey']."&steamids=".$_SESSION['steamid']); 
                $content = json_decode($url, true);
        ?>
            <ul>
                <img class="pp" src="<?php echo $_SESSION['steam_avatar'] = $content['response']['players'][0]['avatar'];?>" width="40px" height="40px" alt="">
                <li><?php echo $_SESSION['steam_personaname'] = $content['response']['players'][0]['personaname'];?></li>
                <li>Notifications</li>
                <li><a href="http://localhost/rust/logout.php">Logout</a></li>
            </ul>
            <?php
            }
        }
            ?>
        </div>
    </div>
    <?php
    $json_url = "https://rust-servers.net/api/?object=servers&element=detail&key=D89Yz3DZYNO0GlmFom4crqVbsj89Xbjowu";
	$json_string = file_get_contents($json_url);
	$parsed_json = json_decode($json_string,true);
	if(empty($parsed_json)){
		$s1_name = "Server Offline";
		$s1_status = "Offline";
		$s1_button = "class='btn btn-outline-danger btn-lg disabled'><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Offline</a>&nbsp;";
        $s1_connect_button = "<button type='button' class='btn btn-outline-danger btn-lg disabled'><i class='fa fa-exclamation-circle'></i> Offline</button>";
        $s1_cur = "0"; $s1_max = "0";
        $s1_img = "img/serverlogo_1024.webp";
    }else{
		$s1_name	= $parsed_json['name'];
		if($s1_name == "" OR empty($s1_name)){$s1_name = "Server Offline";};
		$s1_status	= $parsed_json['is_online'];
			if($s1_status == "1"){$s1_status = "Online";
			$s1_button = "class='btn btn-outline-success btn-lg'><i class='fa fa-play-circle' aria-hidden='true'></i> Connect</a> ";
			$s1_connect_button = "<button data-bs-toggle='modal' data-bs-target='#ServerConnect1' type='button' class='btn btn-outline-success btn-lg'><i class='fab fa-steam-symbol'></i> Connect</button>";
		}
            else{$s1_status = "Offline";
            $s1_button = "class='btn btn-outline-danger btn-lg disabled'><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Offline</a>&nbsp;";
            $s1_connect_button = "<button type='button' class='btn btn-outline-danger btn-lg disabled'><i class='fa fa-exclamation-circle'></i> Offline</button>";
        };
		$s1_cur		= $parsed_json['players'];
		if($s1_cur == "" OR empty($s1_cur)){$s1_cur = "0";};
		$s1_max		= $parsed_json['maxplayers'];
		if($s1_max == "" OR empty($s1_max)){$s1_max = "0";};
		$s1_url		= $parsed_json['url'];
		//Remove PHP Notice in logs
		
		$s1_ip		= $parsed_json['address'];
		$s1_port	= $parsed_json['port'];
    }
    ?>
    <div style="text-align: center;" class="container">
        <div class="servertab" >
            <img style="margin-top: 20px;<?php if($s1_status == 'Offline') {
                echo 'border-bottom: 3px solid red; border-top: 3px solid red';
            }elseif($s1_status == 'Online') {
                echo 'border-bottom: 3px solid green; border-top: 3px solid green';
            }
                ?>" src="../assets/img/main.png" width="200" height="200" alt="">
            <h4><?php echo $s1_name;?></h4><br>
            <h4 style="margin-bottom: 15px;" ><?php echo $s1_cur;?>/<?php echo $s1_max;?></h4>
            
            <a class="<?php if($s1_status == 'Offline') {
                echo 'clicktologinred';
            }elseif ($s1_status == 'Online') {
                echo 'clicktologin';
            }?>" href="<?php if($s1_status == 'Offline') {
                echo '..';
            }elseif ($s1_status == 'Online') {
                echo 'steam://connect/146.19.57.153:28015';
            }?>">Click to connect</a>
        </div>
    </div>
 
</body>
</html>