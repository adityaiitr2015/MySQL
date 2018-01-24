<?php
     session_start();
	 if(array_key_exists("id", $_COOKIE))
	 {
		 $_SESSION['id']=$_COOKIE['id'];
	 }
	 if(array_key_exists("id", $_SESSION))
	 {
		 echo "Congrats! You are now logged in"."<a href='index.php?logout=1'>Log Out</a>";
	 }
	 else header("Location:11-first_project.php");
     
?>