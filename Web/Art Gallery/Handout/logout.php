<?php
include "backlogin.php";

if(isset($_SESSION['loggedin'])){
	session_start();
	unset($_SESSION['loggedin']);
	session_destroy();		
	header('Location: index.html');
}else{
	header('Location: index.html');
}
?>
