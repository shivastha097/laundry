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
						<div class="col-12 text-center">
							<h3 style="padding-bottom: 8px;">Add New User</h3>
						</div>
						<div class="col-md-10 contents">
							<form method="post" action="userValidation.php" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Profile Picture</label>
											<input class="form-control" type="file" name="profileImage">
											<span class="error">
								            	<?php 
				            		            	if (isset($_GET) && !empty($_GET)) {
				            		            		echo $_GET['profileImage'];
				            		            	}
				            	            	?>
											</span>
										</div>
									</div>
								</div>
								<div class="row">
								    <div class="col-md-6">
								        <div class="form-group">
								            <label>First Name</label>
								            <input type="text" class="form-control" placeholder="First Name" name="firstName">
								            <span class="error">
				            	            	<?php 
				            		            	if (isset($_GET) && !empty($_GET)) {
				            		            		echo $_GET['fname'];
				            		            	}
				            	             	?>								             	
								             </span>
								        </div>
								    </div>
								    <div class="col-md-6">
								        <div class="form-group">
								            <label>Last Name</label>
								            <input type="text" class="form-control" placeholder="Last Name" name="lastName">
								            <span class="error">
								            	<?php 
				            		            	if (isset($_GET) && !empty($_GET)) {
				            		            		echo $_GET['lname'];
				            		            	}
				            	             	?>	
				            	            </span>								        
								        </div>
								    </div>
								</div>
							    <div class="row">
							        <div class="col-md-12">
							            <div class="form-group">
							                <label for="exampleInputEmail1">Email address</label>
							                <input type="email" class="form-control" placeholder="Email" name="email">
							                <span class="error">
            					            	<?php 
            	            		            	if (isset($_GET) && !empty($_GET)) {
            	            		            		echo $_GET['email'];
            	            		            	}
            	            	             	?>	
							                </span>
							            </div>
							        </div>
							    </div>
								<div class="row">
									
								    <div class="col-md-6">
								        <div class="form-group">
								            <label>Password</label>
								            <input type="password" class="form-control" placeholder="Password" name="password">
								        </div>
								    </div>
								    <div class="col-md-6">
								        <div class="form-group">
								            <label>Confirm Password</label>
								            <input type="password" class="form-control" placeholder="Re-type Password" name="confirmPassword">
								            <span class="error">
								            	<?php 
				            		            	if (isset($_GET) && !empty($_GET)) {
				            		            		echo $_GET['password'];
				            		            	}
				            	            	?>	
				            	     		</span>
								        </div>
								    </div>
								</div>
							    
							    <div class="row">
							        <div class="col-md-12">
							            <div class="form-group">
							                <label>Address</label>
							                <input type="text" class="form-control" placeholder="Address" name="address">
							                <span class="error">
							                	<?php 
				            		            	if (isset($_GET) && !empty($_GET)) {
				            		            		echo $_GET['address'];
				            		            	}
				            	             	?>	
							                </span>
							        	</div>
							        </div>
							    </div>
							    <div class="row">
							    	<div class="col-md-12">
							    		<div class="form-group">
							    			<label for="">Status</label>
							    			<div class="form-check pl-50">
							    			  <input class="form-check-input" type="radio" name="status" id="statusActive" value="Active" checked>
							    			  <label class="form-check-label" for="statusActive">
							    			    Active
							    			  </label>
							    			</div>
							    			<div class="form-check pl-50">
							    			  <input class="form-check-input" type="radio" name="status" id="statusDeactive" value="Deactive">
							    			  <label class="form-check-label" for="statusDeactive">
							    			    Deactive
							    			  </label>
							    			</div>
							    		</div>
							    	</div>
							    </div>

							    <button type="submit" class="btn btn-info btn-fill">Add User</button>
							    <div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
			</div>

		
			<?php include_once('footer.php') ?>
