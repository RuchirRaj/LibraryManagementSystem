<?php

session_start();
//header("Content-type:image/png");
include('view_borrower.php');

if(isset($_GET['LoanID']))
{
	$loan_id=$_GET['LoanID'];

	
	if(empty($loan_id))
	{
		echo "Loan id are empty";
	}
	else
	{
		$host="localhost"; //yout host name
		$username="root";  //yout user name
		$password="root";      // your password
		$db_name="Library";  // your database name
		$con=mysqli_connect("$host", "$username", "$password", "$db_name")or die("cannot connect"); //mysql connection
		//mysql_select_db("$db_name")or die("can not select DB"); //select your database
		$query = "update fines set paid=True where loan_id=$loan_id";
		$result=mysqli_query($con, $query) or die('Query "' . $query . '" failed: ' . mysqli_error($con));
		mysqli_close($con);
		echo "Fine has been paid successfully";

	}
}

?>
