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
		<form method="post" action="borrow_book.php">
					<div>
						<p>
						  <input type="text" id="card_id" name="card_id" value="" size="50" />    
						  <input type="submit" id="submit1" name="submit1" value="submit" />
						</p>
					</div>
				</form> 
<?php
//require 'db_open.php';
if(isset($_GET["isbn"]))
{
	$ISBN = $_GET["isbn"];   
	session_start();
	$_SESSION['ISBN']=$ISBN;
}
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