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
      <a href="cart.php"><i class="fas fa-shopping-cart"></i>Cart</a>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
  </nav>
  <div class="content">
    <h2>Home</h2>
    <form action="./home.php" method="POST">
      <label for="filters">Filters: </label>
      <select id='filters' name='filters' size=>
        <option value=1 selected>id</option>
        <option value=2>name</option>
        <option value=3>price</option>
      </selectt>
      <input type="submit" value="filter">
    </form>
    <div class='table'>
    <table class='table'>
      <tr>
        <th>Name</th>
        <th>Product</th>
        <th>Price</th>
      </tr>
    <?php
      include('./config.php');
      session_start();
      if(mysqli_connect_errno()){
	die("Connection failed\n\r err:".mysqli_connect_error());
      }
      if($_POST['filters']){
	$order = $_POST['filters'];
	$blacklist = "/admin|&|and| |-|by|mid|ascii|0x|0b|else|union|char|%00|\'|\"|having|insert|drop|delete|case|sql|benchmark/i";
	if(preg_match($blacklist, $order)){ 
	  exit("<tr><td>ofcourse they're blocked</td></tr>");
        }
        $res = mysqli_query($conn,"select id,name,price from products where exclusive=0 order by ".$_POST['filters'].";");
      }else{
        $res = mysqli_query($conn,"select id,name,price from products where exclusive=0 order by 1;");
      }
      if($res){
        while($row = mysqli_fetch_array($res)){
          $id = $row['id'];
	  $name = $row['name'];
	  $price = $row['price'];

	  //echo '<table><tr><th>Name</th><th>Product</th><th>Price</th></tr>';
	  echo '<tr>';
          echo '<td>'.$name.'</td>';
          echo'<td><img src="./images/'.$id.'.jpg" width="100" height="100"></td>';
	  echo'<td>'.$price.'</td>';
          echo'</tr>';
        }
      }else{echo "Oops something gone wrong!!";}
    $res->free();
    ?>
    </table>
    </div>
  </div>
</body>
</html>
