<?php
    session_start();
   if(array_key_exists('content', $_POST))
   {
	    $link = mysqli_connect("localhost", "root", "", "aditya");
        
        if (mysqli_connect_error()) 
		{
            die ("Database Connection Error");
        }
	   $query="UPDATE `users` SET diary='".mysqli_real_escape_string($link,$_POST['content'])."' WHERE id=".mysqli_real_escape_string($link,$_SESSION['id'])." LIMIT 1";
	   
	   mysqli_query($link, $query);
   }

?>