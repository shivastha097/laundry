<?php
	
	session_start();
	$uemail = $_SESSION['email'];
	if ($_SESSION['loggedIn'] != 1) {
			header('location:login.php');
			exit;
		}

?>

<?php include_once('header.php') ?>
	
	<div class="wrapper">
		<?php include_once('sidebar.php') ?>

		<div class="main-panel">
			<?php include_once('navbar.php') ?>

			<div class="content">
				
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<h2>USERS</h2>
						</div>

						<?php
							if (isset($_GET) && !empty($_GET)) {
								if (!empty($_GET['error'])) {
									echo "<div class='alert alert-danger d-block'>";
        		            			echo $_GET['error'];
        		            		echo "</div>";
								}
								elseif (!empty($_GET['success'])) {
									echo "<div class='alert alert-success d-block'>";
        		            			echo $_GET['success'];
        		            		echo "</div>";
								}
							}

						?>
						<div class="col-12 float-right">
							<a href="addUser.php"><button class="btn btn-primary btn-pri">Add New User</button></a>		
						</div>
						<div class="col-md-12">


							<?php
								require_once('database-config.php');
								$sql = "SELECT * FROM user WHERE NOT email='$uemail'";
								if ($result = $mysqli->query($sql)) {
								 	if ($result -> num_rows > 0 )  {
								 		echo "<div class='content table-responsive table-full-width'>";
									 		echo "<table class='table table-hover table-striped'>";
										 		echo "<thead>";
										 			echo "<tr>";
										 				echo "<th>ID</th>";
										 				echo "<th>Name</th>";
										 				echo "<th>Created Date</th>";
										 				echo "<th>Profile Picture</th>";
										 				echo "<th>Email</th>";
										 				echo "<th>Address</th>";
										 				echo "<th>Status</th>";
										 				echo "<th>Action</th>";
									 				echo "</tr>";
									 			echo "</thead>";

									 			echo "<tbody>";
									 				while ($row = $result->fetch_array()) {
									 					
									 				
									 					echo "<tr>";
									 						echo "<td>".$row['id']."</td>";
									 						echo "<td>".$row['firstName']." ".$row['lastName']. "</td>";
									 						echo "<td>" . $row['createdDate'] . "</td>";
									 						echo "<td>";
									 							echo "<img width='60px'"."src=".$row['profileImage'].">" ;
									 						echo "</td>";
									 						echo "<td>".$row['email']."</td>";
									 						echo "<td>".$row['address']."</td>";
									 						echo "<td>".$row['status']."</td>";
									 						echo "<td>";
																echo" <ul class='list-unstyled action'>";
																	echo"<li>";
																		echo"<a href='user-read.php?id=". $row['id'] ."'><i class='fa fa-eye' data-toggle='tooltip' title='View Profile'></i></a>";
																	echo "</li>";
																	echo"<li>";
																		echo"<a href='user-update.php?id=". $row['id'] ."'><i class='fa fa-pencil-square-o' data-toggle='tooltip' title='Edit Profile'></i></a>";
																	echo"</li>";
																	echo "<li>";
																		echo"<a href='user-delete.php?id=". $row['id'] ."'><i class='fa fa-trash' data-toggle='tooltip' title='Delete User'></i></a>";
																	echo"</li>";
																echo"</ul>";
									 						echo"</td>";
									 					echo "</tr>";
									 				}
									 			echo "</tbody>";
									 		echo "</table>";
									 	echo "</div>";
									 	$result->free();
								 	}

                        			else{
                            			echo "<p class='lead'><em>No records were found.</em></p>";
                        			}
                    			} else{
                        			echo "Oops! something went wrong. Please try later.";
                    			}
                    
                    		// Close connection
                    		$mysqli->close(); 


							?>
						        		          
						                
						             
						        </div>
						</div>
					</div>
				</div>
			

		
			<?php include_once('footer.php') ?>
			