<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Library Management System</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" /></head>
<body>
<div id="header">
	<h1><a href="#">Library Management System</a></h1>
	
</div>
<div id="content">
	<div id="colOne">
		<h2>Add the card id or name of borrower or add ISBN </h2>
		<br />
	    <!--	<p><small>Management System</small></p>-->
		<form method="post" action="view_borrower.php">
					<div>
						<p>
						  <input type="text" id="card_id" name="card_id" value="" size="50" />    
						  <input type="submit" id="submit1" name="submit1" value="submit" />
						</p>
					</div>
				</form> 
	    <!--	<p><small>Management System</small></p>-->
 
<?php
//require 'db_open.php';
//echo ($_SERVER['REQUEST_METHOD']);
// session_start();
// $ISBN = $_SESSION['ISBN'];
if (isset($_GET['cardId']))
{
	$input=$_GET['cardId'];
}
if(isset($_POST['card_id']))
{
	$input=$_POST['card_id'];
}
if(empty($input))
{
	echo "input field is empty";
}
else
{
	$db_name = 'Library';
	$con = mysqli_connect('localhost', 'root', 'root', "$db_name") or die(mysql_error());
	$wild_input = '%'.$input.'%';
	$user_query = "select b.Card_id, First_name, Last_name from borrowers as b, book_loans as bl where b.card_id=bl.Card_id and bl.date_in is null and (b.Card_id = '$input' or ISBN= '$input' or First_name like '$wild_input' or Last_name like '$wild_input')";
	$user_result = mysqli_query($con, $user_query)  or die('Query "' . $user_query . '" failed: ' . mysqli_error($con));
	$row = mysqli_fetch_assoc($user_result);

	echo "displaying details for ".$row['First_name']." ".$row['Last_name'].":\n";
	$Card_id=$row['Card_id'];
	
	if (empty($Card_id)){
		echo "card id is not valid";
	}
	else{
		$query = "select bl.ISBN, b.Title, bl.Date_out, bl.Due_date, datediff(current_date(), bl.Due_date) as lateDays from book_loans as bl join book as b where bl.isbn=b.isbn and date_in is null and card_id='".$Card_id."'";

		$result = mysqli_query($con, $query);


		if (mysqli_num_rows($result) == 0)
		{	
			echo "You have not borrowed any book.<br>";
		} 
		else
		{
			for ( $i = 0 ; $i < mysqli_num_rows($result) ; $i++ )
			{
				$row = mysqli_fetch_assoc($result);
				
				echo "<table>";
				echo "<tr style='font-weight: bold;'>";
				echo "</tr>";
				echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
			 
				echo "<tr>";
				
				echo "</table>";
				echo "<table>";
				echo "<tr style='font-weight: bold;'>";
			
				echo "</tr>";
				echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
				echo "<tr>"."<td align='center'>".'Title'."</td>"."<td>".$row['Title'] ."</td> "."</tr>";
				echo "<tr>"."<td align='center'>".'ISBN'."</td>"."<td>".$row['ISBN'] ."</td> "."</tr>";
				echo "<tr>"."<td align='center'>".'Checkout Date'."</td>"."<td>".$row['Date_out'] ."</td> "."</tr>";
				echo "<tr>"."<td align='center'>".'Due_date'."</td>"."<td>".$row['Due_date'] ."</td> "."</tr>";
				if ($row['lateDays']>0){
					echo "<tr>"."<td align='center'>".'Late days'."</td>"."<td>".$row['lateDays'] ."</td> "."</tr>";
				}
				else{
					echo "<tr>"."<td align='center'>".'Late days'."</td>"."<td>0</td> "."</tr>";
				}
				echo "<tr>"."<td align='center'>".'Check in'."</td>"."<td><a href=checkIn.php?isbn=".$row['ISBN']."&cardId=$Card_id>Check in"."</a>"."</td> "."</tr>";

				echo "</table>".'<br>';
			}
			
		}

		$show_fine_query = "select bl.Loan_id, bl.ISBN, f.fine_amt as fine from book_loans as bl, fines as f where bl.Loan_id=f.Loan_id and f.paid=False";
		$show_fine_result = mysqli_query($con, $show_fine_query) or die('Query "' . $show_fine_query . '" failed: ' . mysqli_error($con));
		#------------------------------------------------------------------------------------------------------------
		if (mysqli_num_rows($show_fine_result) == 0)
		{
			echo "No fines are due<br>";
		} 
		else
		{
			echo "Fine details";
			for ( $i = 0 ; $i < mysqli_num_rows($show_fine_result) ; $i++ )
			{
				$row = mysqli_fetch_assoc($show_fine_result);
				echo "<table>";
				echo "<tr style='font-weight: bold;'>";
				echo "</tr>";
				echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
			 
				echo "<tr>";
				echo "</table>";
				echo "<table>";
				echo "<tr style='font-weight: bold;'>";
			
				echo "</tr>";
				echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
				echo "<tr>"."<td align='center'>".'ISBN'."</td>"."<td>".$row['ISBN'] ."</td> "."</tr>";
				echo "<tr>"."<td align='center'>".'Fine'."</td>"."<td>".$row['fine'] ."</td> "."</tr>";
				
		//echo "<td><a href=\"add_borrower.php?id=" . $rows['id'] . "\">Borrow</a></td>";

				echo "<tr>"."<td align='center'>".'Pay Fine'."</td>"."<td><a href=payFine.php?LoanID=".$row['Loan_id'].">Pay Fine"."</a>"."</td> "."</tr>";
			
				echo "</table>".'<br>';
				
			}
		}
	}
}

// session_unset();
// session_destroy();
?>



		
  </div>
  <div id="colTwo">
		<ul>
			<li><a href="index.html" target="_self">logout</a>
			</li>
			<li>
				<h2>Pages</h2>
				<ul>
					<li><a href="home.html">Home</a></li>
					<li><a href="add_borrower.html">Add Borrower</a></li>
					<li><a href="view_borrower.php">View Borrower details</a></li>
				    <li><a href="fines.php">Fines</a></li>
				    <li><a href="#"></a></li>
				</ul>
			</li>
			<li>
				<h2><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional"><abbr title="eXtensible HyperText Markup Language"></abbr></a></h2>
			</li>
			<li></li>
		</ul>
  </div>
  <div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
	<p>Created by: Nidhi Vaishnav, (ntv170030), CS 6360.003, University of Texas at Dallas <a href="http://www.csstemplatesforfree.com/"><strong></strong></a></p>
</div>


</body>
</html>