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
if(isset($_GET['cardId'], $_GET['isbn']))
{
	$Card_id=$_GET['cardId'];
	$ISBN = $_GET['isbn'];
	echo ($Card_id);
	echo ($ISBN);
	if(empty($Card_id))
	{
		echo "Card_id field is empty";
	}
	elseif(empty($ISBN))
	{
		echo "ISBN field is empty";
	}
	else
	{
		$db_name = 'Library';
		$con = mysqli_connect('localhost', 'root', 'root', "$db_name") or die(mysql_error());
		// $db = mysql_select_db('Library', $con);
//		$query = "select bl.ISBN, b.Title, bl.Date_out, bl.Due_date from book_loans as bl join book as b where bl.isbn=b.isbn and card_id='".$Card_id."' and date_in is null";
		$query = "update book_loans set date_in=current_date() where card_id='".$Card_id."' and isbn='".$ISBN."' and date_in is NULL";
		//echo($ISBN);
		//echo ($query);

   		$result = mysqli_query($con, $query) or die('Query "' . $query . '" failed: ' . mysqli_error($con));
		mysqli_close($con);
		echo "book has been checked in successfully in the database".'<br>';

		// $avail_query = "select count(*) as count from book_loans where ISBN='".$ISBN."' and Date_in is null";
				
		// $avail_result = mysqli_query($con, $avail_query);
		// $avail_row = mysqli_fetch_assoc($avail_result);
		
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