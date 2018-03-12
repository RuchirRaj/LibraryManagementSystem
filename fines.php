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
		<h2>People with fine </h2>
		<br />
	    <!--	<p><small>Management System</small></p>-->
		
 
<?php
$db_name = 'Library';
$con = mysqli_connect('localhost', 'root', 'root', "$db_name") or die(mysql_error());
$data_query =  "select loan_id as fines_loan_id, datediff(current_date(), bl.Due_date) as due_days from book_loans as bl where datediff(current_date(), bl.Due_date)>0 and Date_in is NULL";
$data_result = mysqli_query($con, $data_query) or die('Query "' . $data_query . '" failed: ' . mysqli_error($con));

if (mysqli_num_rows($data_result) != 0)
{	
	for ( $i = 0 ; $i < mysqli_num_rows($data_result) ; $i++ )
	{
		$row = mysqli_fetch_assoc($data_result);
		$check_fine_query = "select * from fines where loan_id = '".$row['fines_loan_id']."'";
		$check_fine_result = mysqli_query($con, $check_fine_query) or die ('Query "'.$check_fine_query.'" failed: '.mysqli_error($con));
		$fine_amt = $row['due_days']*0.25;
		if (mysqli_num_rows($check_fine_result)==0){
			
			$insert_fine_query = "insert into fines(Loan_id, fine_amt, paid) values(".$row['fines_loan_id'].", ".$fine_amt.", False)";
			$insert_fine_result = mysqli_query($con, $insert_fine_query) or die('Query "' . $insert_fine_query . '" failed: ' . mysqli_error($con));
		}
		else{
			$fine_amt = $row['due_days']*0.25;
			$update_fine_query = "update fines set Fine_amt=".$fine_amt." where paid=FALSE";
			$update_fine_result = mysqli_query($con, $update_fine_query) or die('Query "' . $update_fine_query . '" failed: ' . mysqli_error($con));
		}
	}	
}
$update_query =  "select f.loan_id as fines_loan_id, datediff(bl.Date_in, bl.Due_date) as late_days from book_loans as bl, fines as f where f.loan_id=bl.loan_id and datediff(bl.Date_in, bl.Due_date)>0 and f.Paid = False";
$update_result = mysqli_query($con, $update_query) or die('Query "' . $update_query . '" failed: ' . mysqli_error($con));
if (mysqli_num_rows($update_result) != 0)
{	
	for ( $i = 0 ; $i < mysqli_num_rows($update_result) ; $i++ )
	{
		$row = mysqli_fetch_assoc($update_result);
		$fine_amt = $row['late_days']*0.25;
		$update_fine_query = "update fines set Fine_amt=".$fine_amt." where paid=FALSE";
		$update_fine_result = mysqli_query($con, $update_fine_query) or die('Query "' . $update_fine_query . '" failed: ' . mysqli_error($con));
	}
}	



$show_fine_query = "select bl.Card_id, b.First_name, b.Last_name, sum(f.fine_amt) as fine from book_loans as bl, fines as f, Borrowers as b where bl.Loan_id=f.Loan_id and f.paid=False and bl.Card_id=b.Card_id and bl.Date_in is not NULL group by bl.Card_id";
$show_fine_result = mysqli_query($con, $show_fine_query) or die('Query "' . $show_fine_query . '" failed: ' . mysqli_error($con));
#------------------------------------------------------------------------------------------------------------
if (mysqli_num_rows($show_fine_result) == 0)
{
	echo "No fines are due<br>";
} 
else
{
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
		echo "<tr>"."<td align='center'>".'Card_id'."</td>"."<td>".$row['Card_id'] ."</td> "."</tr>";
		echo "<tr>"."<td align='center'>".'Name'."</td>"."<td>".$row['First_name'] ." ".$row['Last_name']."</td> "."</tr>";
		
//echo "<td><a href=\"add_borrower.php?id=" . $rows['id'] . "\">Borrow</a></td>";

		echo "<tr>"."<td align='center'>".'Fine amount'."</td>"."<td>".$row['fine'] ."</td> "."</tr>";
		echo "<tr>"."<td align='center'>".'Pay Fine'."</td>"."<td><a href=view_borrower.php?cardId=".$row['Card_id'].">View details"."</a>"."</td> "."</tr>";
	
		echo "</table>".'<br>';
		
	}
}
echo "Page has been refreshed";
	
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