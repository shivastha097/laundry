<?php

	session_start();
	
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
							<h2>MESSAGES</h2>
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
						<div class="col-12">
							<?php
								require_once('database-config.php');
								$sql = "SELECT * FROM message";
								if ($result = $mysqli->query($sql)) {
								 	if ($result -> num_rows > 0 )  {
								 		echo "<div class='content table-responsive table-full-width'>";
									 		echo "<table class='table table-hover table-striped'>";
										 		echo "<thead>";
										 			echo "<tr>";
										 				echo "<th>ID</th>";
										 				echo "<th>Name</th>";
										 				echo "<th>Email</th>";
										 				echo "<th>Phone</th>";
										 				echo "<th>Pickup Date</th>";
										 				echo "<th>Pickup Time</th>";
										 				echo "<th>Address</th>";
										 				echo "<th>Action</th>";
									 				echo "</tr>";
									 			echo "</thead>";

									 			echo "<tbody>";
									 				while ($row = $result->fetch_array()) {
									 					echo "<tr>";
									 						echo "<td>".$row['id']."</td>";
									 						echo "<td>".$row['firstName']." ".$row['lastName']. "</td>";
									 						echo "<td>".$row['email']."</td>";
									 						echo "<td>".$row['phone']."</td>";
									 						echo "<td>".$row['pickupDate']."</td>";
									 						echo "<td>".$row['pickupTime']."</td>";
									 						echo "<td>".$row['address']."</td>";
									 						echo "<td>";
																echo" <ul class='list-unstyled action'>";
																	echo"<li>";
																		echo"<a href='message-read.php?id=". $row['id'] ."'><i class='fa fa-eye' data-toggle='tooltip' title='View Message'></i></a>";
																	echo "</li>";
																	echo "<li>";
																		echo"<a href='message-delete.php?id=". $row['id'] ."'><i class='fa fa-trash' data-toggle='tooltip' title='Delete Message'></i></a>";
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
                        			echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    			}
                    
                    		// Close connection
                    		$mysqli->close(); 


							?>
						</div>
					</div>
				</div>
			</div>

		
			<?php include_once('footer.php') ?>
