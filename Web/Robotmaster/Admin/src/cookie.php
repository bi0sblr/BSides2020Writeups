<?php
$flag1="BSDCTF{C00k135_ar3_b35t_pl4c3_70_ch3ck}";
$flag="OFQPGS{P00x135_ne3_o35g_cy4p3_70_pu3px}";
$arr = str_split($flag);
$cookie_name="Our_Fav_Cookie";
$Piece=0;
if(isset($_COOKIE['Our_Fav_Cookie']) && $_COOKIE['Piece'] < sizeof($arr)) {
$Piece=$_COOKIE['Piece'];
setcookie($cookie_name, hash('sha256', $arr[$Piece]), time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("Piece", $Piece+1, time() + (86400 * 30), "/"); // 86400 = 1 day
if($_COOKIE['Piece'] >=40) {
$_COOKIE['Piece']=0;
}
}
else{
setcookie("Our_Fav_Cookie", hash('sha256', $arr[$Piece]), time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("Piece", 1, time() + (86400 * 30), "/"); // 86400 = 1 day
}

?>
<html>

      <head>

          <meta charset="utf-8">

          <title> BSides Delhi </title>

      </head>

      <body>
            <body background ='robots.jpg'>

            <p style = "font-family:georgia,garamond,serif;font-size:64px;text-align:center;color:#DA5F45;font-style:italic;"> Yummyy!! </p>

            <!--Robots made our work difficult. Broke everything into pieces! :(-->

      </body>

</html>
