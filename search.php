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
		<h2>Search book By ISBN, Title or Author </h2>
		<br />
	    <!--	<p><small>Management System</small></p>-->
		<form method="post" action="search.php">
					<div>
						<p>
						  <input type="text" id="search" name="search" value="" size="50" />    
						  <input type="submit" id="submit1" name="submit1" value="Search" />
						</p>
					</div>
				</form> 
		<?php
//require 'db_open.php';

if(isset($_POST['search']))
{
	$search=$_POST['search'];

	if(empty($search))
	{
		echo "Search field is empty";
	}
	else
	{
		$db_name = 'Library';
		$con = mysqli_connect('localhost', 'root', 'root', "$db_name") or die(mysql_error());
		// $db = mysql_select_db('Library', $con);
		$WildSearch='%'.$search.'%';
		//echo($search);
		$query = "select b.ISBN, b.title, group_concat(a.Author_name) as author_name, b.cover, b.pages from book as b, book_authors as ba, authors as a Where b.ISBN=ba.ISBN and ba.Author_id=a.Author_id and 
(a.Author_name like "."'$WildSearch'"." or b.isbn="."'$search'"." or b.Title like "."'$WildSearch'".") GROUP BY b.ISBN";

//		echo ($query);
		
		
		
   		// $query = "SELECT id,alt,img_name,name,artist,discription,weight,components,date,month,year,status FROM artifects WHERE name='$search'";
   		// $result = mysqli_query($con, $query) or die('Error, query failed');
   		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) == 0)
		{
        	echo "Database is empty <br>";
   		} 
		else
		{
      		for ( $i = 0 ; $i < mysqli_num_rows($result) ; $i++ )
			{
       			$row = mysqli_fetch_assoc($result);
				$avail_query = "select count(*) as count from book_loans where ISBN='".$row['ISBN']."' and Date_in is null";
				
				$avail_result = mysqli_query($con, $avail_query);
				$avail_row = mysqli_fetch_assoc($avail_result);
				echo "<table>";
			 	echo "<tr style='font-weight: bold;'>";
				echo "</tr>";
			 	echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
       		 
			 	echo "<tr>";
			 	//echo "<td align='center'>".'<img src="getImage.php?ISBN=' . $row['ISBN'] . '" Title="' . $row['Title'] . '" Author_name="' . $row['Author_name']  .'"/>  ' . "\n"."</td>"."</tr>";
			 // echo '<img src="getImage.php?id=' . $row['id'] . '" alt="' . $row['alt'] . '" title="' . $row['name']  .'"/>  ' . "\n";

			 	echo "</table>";
			  	echo "<table>";
			 	echo "<tr style='font-weight: bold;'>";
			
			 	echo "</tr>";
			 	echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
			 	echo "<tr>"."<td align='center'>".'Title'."</td>"."<td>".$row['title'] ."</td> "."</tr>";
    //echo "<td><a href=\"add_borrower.php?id=" . $rows['id'] . "\">Borrow</a></td>";

			 	echo "<tr>"."<td align='center'>".'ISBN'."</td>"."<td>".$row['ISBN'] ."</td> "."</tr>";
			 	echo "<tr>"."<td align='center'>".'Author name'."</td>"."<td>".$row['author_name'] ."</td> "."</tr>";
			 	echo "<tr>"."<td align='center'>".'cover'."</td>"."<td>".$row['cover'] ."</td> "."</tr>";
			 	echo "<tr>"."<td align='center'>".'pages'."</td>"."<td>".$row['pages']."</td> "."</tr>";
				if ($avail_row['count']==0)
				{
					echo "<tr>"."<td align='center'>".'Availability'."</td>"."<td><a href=addCardID.php?isbn=".$row['ISBN'].">Check out"."</a>"."</td> "."</tr>";
				}
				else{
					echo "<tr>"."<td align='center'>".'Availability'."</td>"."<td>unavailable"."</td> "."</tr>";
				}
			 	echo "</table>".'<br>';
      		}
  		}
	}
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
					<li><a href="view_borrower.html">View Borrower details</a></li>
				    <li><a href="fines.html">Fines</a></li>
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