<?php
    session_start();
	
	/*$_SESSION['username']='adi';
	echo $_SESSION['username'];  */
	
	if($_SESSION['email']=="")
	{
		header("location: 7-mini_project_sign_up_form.php");
	}
	else echo "you are now logged in";

?> 