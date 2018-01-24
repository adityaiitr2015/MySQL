<?php
    $link=mysqli_connect("localhost", "root", "", "adi");
	
	if(mysqli_connect_error())
	{
		echo "Error in connection";
	}
	
	$query="INSERT INTO users (email,password) VALUES('adi@rocks.com','asdfgtrwqq123')";
	
	 mysqli_query($link,$query);
	
?>