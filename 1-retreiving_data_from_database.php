<?php
    $link=mysqli_connect("localhost", "root", "", "adi");
	
	if(mysqli_connect_error())
	{
		echo "Error in connection";
	}
	
	$query="SELECT email,password FROM users";   //OR $query="SELECT * FROM users"; TO SECTET ALL THE CONTENT OF THE TABLE.
	
	if(mysqli_query($link,$query))
	{
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		
		echo "Your email is ".$row['email']." & your password is "."$row[password]";
	}
	
?>