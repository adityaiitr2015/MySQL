<?php
    $link=mysqli_connect("localhost", "root", "", "adi");
	
	if(mysqli_connect_error())
	{
		echo "Error in connection";
	}
	
	$query="UPDATE `users` SET email='adi@adi.com' WHERE id=1 LIMIT 1";   //updating
	
	mysqli_query($link,$query);
	
	
	$query="UPDATE `users` SET password='q2we4tyu7' WHERE id=1 LIMIT 1";   //updating
	
	mysqli_query($link,$query);
	
	$query="DELETE FROM `users` WHERE email='adi@adi.com' LIMIT 1";   //deleting
 	mysqli_query($link,$query);
	
	$query="SELECT email,password FROM users";   //OR $query="SELECT * FROM users"; TO SECTET ALL THE CONTENT OF THE TABLE.
	
	if(mysqli_query($link,$query))
	{
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		
		echo "Your email is ".$row['email']." & your password is "."$row[password]";
	}
	
?>