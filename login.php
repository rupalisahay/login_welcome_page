<?php

	$username = "";
	$password = "";
	session_start();

	if ($_SERVER["REQUEST_METHOD"]=="POST") 
	{
		$username = $_POST["username"];
		$password = $_POST["password"];

		if (strlen($username) > 0 and strlen($password) > 0) 
		{
			$connection = mysqli_connect("localhost", "root", "", "PW5");

			if (mysqli_connect_errno()) 
			{
				echo "Failed to connect to MySQL".mysqli_connect_errno();
			}


			$result = "SELECT * from users where username ='".$username."' and password = '".$password."'";

			if($answer = mysqli_query($connection, $result))
			{
				if(mysqli_num_rows($answer)==1)
				{
					$_SESSION["username"] = $username;
					header("Location: welcome.php");
					exit();
				}
			}
		}
		else
		{
			header("Location: login.html");
			exit();
		}
	}

?>