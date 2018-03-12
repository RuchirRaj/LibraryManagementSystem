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
		<h2>Add the card id of borrower </h2>
		<br />
	    <!--	<p><small>Management System</small></p>-->
 
<?php
//require 'db_open.php';
//echo ($_SERVER['REQUEST_METHOD']);
session_start();
$ISBN = $_SESSION['ISBN'];
if(isset($_POST['card_id']))
{
	$Card_id=$_POST['card_id'];

	if(empty($Card_id))
	{
		echo "Card_id field is empty";
	}
	else
	{
		$db_name = 'Library';
		$con = mysqli_connect('localhost', 'root', 'root', "$db_name") or die(mysql_error());
		// $db = mysql_select_db('Library', $con);
		$query = "select bl.ISBN, b.Title, bl.Date_out, bl.Due_date from book_loans as bl join book as b where bl.isbn=b.isbn and card_id='".$Card_id."' and date_in is null";
		//echo($ISBN);
		//echo ($query);

   		$result = mysqli_query($con, $query);

		$avail_query = "select count(*) as count from book_loans where ISBN='".$ISBN."' and Date_in is null";
				
		$avail_result = mysqli_query($con, $avail_query);
		$avail_row = mysqli_fetch_assoc($avail_result);
		
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
			echo "</table>".'<br>';
		}
		
		if (mysqli_num_rows($result) == 3)
		{	
			echo "Sorry, Request declined. You have already borrowed 3 books<br>";
		} 
		elseif($avail_row['count']!=0)
		{
			echo "Sorry, Request declined. Book is no longer available.<br>";
		}
		else
		{
			$insert_query = "insert into book_loans(ISBN, Card_id, Date_out, Due_date, Date_in) values('".$ISBN."', '".$Card_id."', current_date(), date_add(current_date(), interval 14 day), NULL)";
			$insert_result = mysqli_query($con, $insert_query) or die('Card id is not valid');
			mysqli_close($con);
			echo "Book with $ISBN is checked out successfully with card id $Card_id".'<br>';
		}
  		
	}
}
session_unset();
session_destroy();
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
				    <li><a href="fines.php">Refresh Fines</a></li>
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