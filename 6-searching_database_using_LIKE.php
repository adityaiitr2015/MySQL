<?php
    $link=mysqli_connect("localhost", "root", "", "adi");
	
	if(mysqli_connect_error())
	{
		echo "Error in connection";
	}
	  
	
	$query="SELECT * FROM users WHERE email LIKE '%@iitr.com'";
	
	if(mysqli_query($link,$query))
	{
		$result=mysqli_query($link,$query); 
		while($row=mysqli_fetch_array($result))
		{
			//echo "<p>Your email is ".$row['email']." & your password is ".$row['password']."</p>";
			print_r($row);
		}
	}
	
?>