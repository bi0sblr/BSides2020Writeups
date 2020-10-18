<?php
session_start();

if(!isset($_SESSION['loggedin'])){
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel='stylesheet' href='common.css'>
</head>
<body class="loggedin">
  <nav class="navtop">
    <div>
      <h1>Art Gallery</h1>
      <a href="home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
  </nav>
  <div class="content">
    <h2>Cart</h2>
    <div>
      <p>welcome back, <?=$_SESSION['name']?> !</p>
      <table>
        <tr>
          <td>Username:</td>
          <td><?=$_SESSION['name']?></td>
        </tr>
<!--        <tr>
          <td>Email:</td>
          <td><?=$email?></td>
        </tr>-->
      </table>    
    </div>
  </div>
</body>
</html>
