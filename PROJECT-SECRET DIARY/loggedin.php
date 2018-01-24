<?php
     session_start();
	 
	 $diaryContent="";
	 if(array_key_exists("id", $_COOKIE))
	 {
		 $_SESSION['id']=$_COOKIE['id'];
	 }
	 if(array_key_exists("id", $_SESSION))
	 {
		 
		 $link = mysqli_connect("localhost", "root", "", "aditya");
        
        if (mysqli_connect_error()) 
		{
            die ("Database Connection Error");
        }
		
		$query="SELECT `diary`  FROM `users` WHERE id=".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
		
		$row=mysqli_fetch_array(mysqli_query($link, $query));
		
		$diaryContent=$row['diary'];
	 }
	 else header("Location:11-first_project.php");
     include("header.php");
?>	 
      <nav class="navbar navbar-light bg-light navbar-fixed-top justify-content-between">
		  <a class="navbar-brand"><h3>Secret Diary</h3></a>
		  <div class="form-inline">
			<a href='index.php?logout=1'><button class="btn btn-success my-2 my-sm-0" type="submit">Log Out</button></a>
		  </div>
	 </nav>
	 <div class="container-fluid">
	 
	      <textarea id="diary" class="form-control"><?php echo $diaryContent; ?></textarea>
	 <div>
<?php
	 include("footer.php");
?>