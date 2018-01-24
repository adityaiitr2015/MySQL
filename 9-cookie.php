<?php

    setcookie("id", "1233556", time()+60*60*24);
	echo "The id number is ".$_COOKIE['id'];
 
?>