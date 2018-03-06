
<?php
$host="localhost"; //yout host name
$username="root";  //yout user name
$password="root";      // your password
$db_name="Library";  // your database name
$con=mysqli_connect("$host", "$username", "$password", "$db_name")or die("cannot connect"); //mysql connection
//mysql_select_db("$db_name")or die("can not select DB"); //select your database

$FirstName = $_POST['FirstName'];
$LastName=$_POST['LastName'];
$email=$_POST['email'];
$ssn = $_POST['ssn'];
$address=$_POST['address'];
$city = $_POST['city'];
$state=$_POST['state'];
$contact = $_POST['contact'];
//echo $location;
include('add_borrower.html');

if(empty($FirstName) || empty($LastName) || empty($email) || empty($ssn))
{
	
	echo "fields are empty".'<br>';
	header("Location:add_borrower.html");
}
else{
		$ssn_query = "select * from borrowers where SSN like "."'$ssn'"."";
		$ssn_result = mysqli_query($con, $ssn_query);
		$total_rows = mysqli_num_rows($ssn_result);
		if (mysqli_num_rows($ssn_result) == 0)
		{
        	//generate card_id
			//find total number of existing borrowers
			$query = "select * from borrowers";
			$result = mysqli_query($con, $query);
			$total_rows = mysqli_num_rows($result);
			
			$unformattedNumber=$total_rows+1;
			$formattedNumber = sprintf('%06d', $unformattedNumber);
			$Card_id="ID".$formattedNumber;
			$query1 = "INSERT INTO borrowers (Card_id,SSN, First_name, Last_name, Email, Address, City, State, phone) VALUES ('$Card_id', '$ssn','$FirstName', '$LastName', '$email' ,  '$address', '$city', '$state','$contact')";
			//echo ($query1);	
			mysqli_query($con, $query1) or die('Query "' . $query1 . '" failed: ' . mysql_error());
	// name, email and address are fields of your fields; info your table. $name, $email and $address are values collected from the form
			
			mysqli_close($con);
			echo "borrower is added successfully in the database".'<br>';
			echo "card id of $FirstName $LastName is $Card_id";
   		} 
		else
		{
			$row = mysqli_fetch_assoc($ssn_result);
			echo "Sorry, we cannot add the borrower.";
			echo $row['First_name']." ".$row['Last_name']." with SSN ".$row['SSN']." and card_id ".$row['Card_id']." already exists.";
		}
}

?>

