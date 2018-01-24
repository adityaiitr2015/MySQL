<?php

    session_start();

    $error = "";    

    if (array_key_exists("logout", $_GET))		
	{ 
		session_destroy();
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";  
        
    } 
	else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) 
	{
        
        header("Location: loggedin.php");
        
    }

    if (array_key_exists("submit", $_POST)) 
	{
		session_start();
        $link = mysqli_connect("localhost", "root", "", "aditya");
        
        if (mysqli_connect_error()) 
		{
            die ("Database Connection Error");
        }
         
        if (!$_POST['email']) 
		{
            $error .= "An email address is required<br>";
        } 
        
        if (!$_POST['password'])
		{
            $error .= "A password is required<br>";
        } 
        
        if ($error != "") 
		{
            $error = "<p>There were error(s) in your form:</p>".$error;
        } 
		else 
		{ 
            if ($_POST['signUp'] == '1') 
			{
				$query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) > 0) 
				{

                    $error = "That email address is taken.";

                } 
				else 
				{

                    $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

                    if (!mysqli_query($link, $query)) 
					{
                        $error = "<p>Could not sign you up - please try again later.</p>";
                    } 
					else 
					{
                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

                        mysqli_query($link, $query);

                        $_SESSION['id'] = mysqli_insert_id($link);

                        if ($_POST['stayLoggedIn'] == '1') 
						{
                            setcookie("id", mysqli_insert_id($link), time() + 60*60*24*365);
                        } 

                        header("Location: loggedin.php");
                    }

                } 
                
            } 
			else 
			{
                    $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                    $result = mysqli_query($link, $query);
                
                    $row = mysqli_fetch_array($result);
                
                    if (isset($row)) 
					{ 
                        $hashedPassword = md5(md5($row['id']).$_POST['password']);
                        
                        if ($hashedPassword == $row['password']) 
						{
                            $_SESSION['id'] = $row['id'];
                            
                            if ($_POST['stayLoggedIn'] == '1') 
							{
                                setcookie("id", $row['id'], time() + 60*60*24*365);
                            } 

                            header("Location: loggedin.php");
                                
                        } 
						else 
						{
                            $error = "That email/password combination could not be found.";
                        }
                    } 
					else 
					{
                        $error = "That email/password combination could not be found.";
                    } 
             }
        }
    }
?>

<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Secret Diary</title>
	
	<style type="text/css">
	      
	     .container
		 {
			 text-align:center; 
			 width:500px;
			 margin-top:140px;
		 }
		 #error
		 {
			 width:400px;
			 height:100px;
			 margin:0 auto;
			 font-size:80%;
			 margin-top:10px;
			 margin-bottom:10px;
		 }
		 #logInForm
		 {
			 display:none;
		 }
	</style>
  </head>
  <body background="bg.jpg">
    <div class="container">
		<h1>Secret Diary</h1>
		<p> <strong> Store your thoughts permanently and securely.</strong></p>
		    <?php 
			    if($error!="")
				{
					echo '<div class="alert alert-danger" role="alert" id="error">'.$error.'</div>';
				}
			?>
		<form method="post" id="signUpForm">
		
		    <div>
			    <p> Interested? Sign up to explore more of it</p>
			</div>
            <div class="form-group">
			    <input type="email" class="form-control" name="email" placeholder="Your Email">
			</div>
			
			<div class="form-group">
			    <input type="password" class="form-control" name="password" placeholder="Password">
			</div>
			
			<div class="form-check">
			    <input type="checkbox" class="form-check-label" name="stayLoggedIn" value=1>Stay logged in.
			</div>
			
			<input type="hidden" name="signUp" value="1">
				
			<input type="submit" class="btn btn-success" name="submit" value="Sign Up!">
			
			<p><a id="showLogIn" href="#logInForm"><strong>Log In</strong></a></p>

		</form>

		<form method="post" id="logInForm">
            <p>Login using your email and password.
			<div class="form-group">
			    <input type="email" class="form-control" name="email" placeholder="Your Email">
			</div>
			
			<div class="form-group">
			    <input type="password" class="form-control" name="password" placeholder="Password">
			</div>
			
			<div class="form-check">
			    <input type="checkbox" class="form-check-label" name="stayLoggedIn" value=1>Stay logged in.
			</div>
			
			<input type="hidden" name="signUp" value="0">
				
			<input type="submit" class="btn btn-success" name="submit" value="Log In!">
			<p><a id="showSignUp" href="#signUpForm"><strong>Sign Up</strong></a></p>

		</form>
	</div>
	
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     
	 <script type="text/javascript">
	      $("#showLogIn").click(function()
		  {
			  $("#signUpForm").hide();
			  $("#logInForm").show();
		  });
		  
		  $("#showSignUp").click(function()
		  {
			  $("#signUpForm").show();
			  $("#logInForm").hide();
		  });
	 </script>
	 
	 
  </body>
</html>

