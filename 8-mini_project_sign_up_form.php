<?php
    session_start();
	
    if(array_key_exists('email',$_POST))
	{ 
        $link=mysqli_connect("localhost", "root", "", "adi");
	
		if(mysqli_connect_error())
		{
			echo "Error in connection";
		}
		
		if($_POST['email']=='')
		{
			echo "<p>email address is required</p>";
		}
		else if($_POST['password']=='')
		{
			echo "<p>Password is required</p>";
		}
		else
		{
			$query="SELECT `id` FROM `users` WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."' ";
						
			$result=mysqli_query($link,$query);
			
			if(mysqli_num_rows($result) > 0)
			{
				echo "<p>this email address is already registered.</p>";
			}
			else
			{
				$query="INSERT INTO `users` (email,password) VALUES('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
				if(mysqli_query($link,$query))
				{
					$_SESSION['email']=$_POST['email'];
					header("Location:7-session.php");
				}
				else 
					echo "There was an error in signing you up. Please try again after some time.";
			}
		}
	}
?>

<form method="post">
    email<input name="email" type="email">
	password<input name="password" type="text">
	<input type="submit" value="Go!">
</form>