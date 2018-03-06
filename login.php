<?php

session_start();
//header("Content-type:image/png");
include("db_open.php");
if(isset($_POST['uname']) && isset($_POST['pword']))
{
	$a=$_POST['uname'];
	$b=$_POST['pword'];

	
	if(empty($a)  || empty($b))
	{
		echo "Fields are empty";
	}
	else
	{
		if($a!="" && $b!="")
		{
			$host="localhost"; //yout host name
			$username="root";  //yout user name
			$password="root";      // your password
			$db_name="Library";  // your database name
			$con=mysqli_connect("$host", "$username", "$password", "$db_name")or die("cannot connect"); //mysql connection
			//mysql_select_db("$db_name")or die("can not select DB"); //select your database
			$qry=mysqli_query($con, "select Username, Password from employee where Username='$a' && password='$b'");
			$num=mysqli_num_rows($qry);
			if($num==0)
			{
				include('index.html');
				echo '<strong>Incorrect User ID or Password.</strong>';
			}
			else
			{
					header("Location:home.html");
	
			}
		}
		else
		{
			include('index.html');
			echo 'Sorry incorrect username and password';
		}

	}
}

?>
