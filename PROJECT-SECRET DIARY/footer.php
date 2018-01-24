 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery.min.js"></script>
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
		  
		  $('#diary').bind('input propertychange', function()
		  {
			  $.ajax
			  ({
				  method: "POST",
				  url: "update.php",
				  data: { content: $("#diary").val()}
			  })
	      });
	 </script>
	 
	 
  </body>
</html>