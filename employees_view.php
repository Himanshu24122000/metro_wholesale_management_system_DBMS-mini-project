<?php
require_once 'dbconfig.php';
if(isset($_GET['delete_id']))
	{
		
		// it will delete an actual record from db
		$stmt_delete = $DB_con->prepare('DELETE FROM employees WHERE eid =:eid');
		$stmt_delete->bindParam(':eid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location:employees_view.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Customers List</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="background">
		<div id="page">
			<div id="header">
				<div id="logo">
					<a href="index.html"><img src="images/metrologo.png" alt="LOGO" height="112" width="250"></a>
				</div>
				<div id="navigation">
					<ul>
						
						<li>
							<a href="employees_add.php"> Add </a>
						</li>

						<li  class="selected">
							<a href="employees_view.php">View & delete</a>
						</li>

						<li>
							<a href="index.html">Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="contents">
				<div class="box">
					<div>
						<div class="body">
							<h1>Employee Details</h1>
							<ul id="rooms">
							<?php
							$stmt = $DB_con->prepare('SELECT * FROM employees ORDER BY eid DESC');
							$stmt->execute();	
							if($stmt->rowCount() > 0) {
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))		{
								extract($row);
							?>
								<li>
									<img src="images/custpic.png.jpg" alt="Img" height="287" width="287">									
									<h2><a href="#"> ID:  <?php echo $row['eid']; ?></a></h2>
									
									<h2><a href="#"> Name:  <?php echo $row['ename']; ?></a></h2>
									
									<span class="rate" style="width:auto;"> &nbsp;Contact: <?php echo $row['emno']; ?> &nbsp;</span>

									<a href="?delete_id=<?php echo $row['eid']; ?>" title="click for delete this employee" onclick="return confirm('sure to delete ?')"> Delete</a>
								</li>
							<?php } } ?>
							
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">

			<p>
				© 2020 by Product Sales Management System. All Rights Reserved
			</p>
		</div>
	</div>
</body>
</html>