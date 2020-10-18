<?php

include('./config.php');
session_start();
if(mysqli_connect_errno()){
	die("Connection failed\n\r err:".mysqli_connect_error());
}
  
if(!isset($_POST['username'],$_POST['password'])){
	die('enter the credentials please!!');
}

if($stmt=$conn->prepare('select id, password from accounts')){
	$stmt->bind_param('s',$_POST['username']);
	$stmt->execute();
	$stmt->store_result();

	if($stmt->num_rows > 0){
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		//for now changing to normal check, change to password_verify if needed
		if($_POST['password'] === $password){
			session_regenerate_id();
			$_SESSION['loggedin']=TRUE;
			$_SESSION['name']=$_POST['username'];
			$_SESSION['id']=$id;
			//echo "welcome ".$_SESSION['name']."!! <br> Take a look around";
			header('Location: home.php');
		}else{
			echo "Incorrect username or password or both!!";
		}
	}else{
		echo 'Incorrect username!!';
	}

	$stmt->close();
}
?>
