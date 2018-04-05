<?php
	session_start();
	if (isset($_SESSION["username"])) 
	{
		$username = $_SESSION["username"];

		$connection = mysqli_connect("localhost", "root", "", "PW5");

		if (mysqli_connect_errno()) 
		{
				echo "Failed to connect to MySQL".mysqli_connect_errno();
		}

		$my_name = "SELECT * FROM users WHERE username ='".$username."';";
		$name_ans = mysqli_query($connection, $my_name);

		$row=mysqli_fetch_array($name_ans);
		echo "<br>Welcome to this page <b>". $row["fullname"] ."!</b><br>";
		echo "<img src = '".$row['avatar']."' width='150' height='150'>"."<br><br><br>";

		
		$my_books = "SELECT * FROM `favoritebooks`, `books` WHERE username = '".$username."' and favoritebooks.bookid = books.bookid";
		$books_ans = mysqli_query($connection, $my_books);
		
		echo "Your favorite book is/are: <br>";

		while ($row=mysqli_fetch_array($books_ans)) 
		{
    		echo "* ".$row['title']." by ".$row['author']."<br>";
		}
		
	}
	else
	{
		header("Location: login.html");
		exit();
	}
?>