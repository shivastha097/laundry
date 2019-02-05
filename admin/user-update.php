<?php

	session_start();
	
	if ($_SESSION['loggedIn'] != 1) {
		header('location:login.php');
		exit;
	}
	

?>

<?php
	require_once('database-config.php');
	if(isset($_GET['id']) && !empty(trim($_GET['id']))){

		$id = $_GET['id'];
		$usql="SELECT * FROM user  WHERE id=".$id;
		if($mysqli->query($usql)->num_rows==1){
		    $user=$mysqli->query($usql)->fetch_Assoc();
	
		// Functions to filter user inputs
			function filterName($field){
			    // Sanitize user name
			    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
			    
			    // Validate user name
			    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
			        return $field;
			    } else{
			        return FALSE;
			    }
			}    
			function filterEmail($field){
			    // Sanitize e-mail address
			    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
			    
			    // Validate e-mail address
			    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
			        return $field;
			    } else{
			        return FALSE;
			    }
			}
			function filterString($field){
			    // Sanitize string
			    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
			    if(!empty($field)){
			        return $field;
			    } else{
			        return FALSE;
			    }
			}
			 
			// Define variables and initialize with empty values
			$firstNameErr = $lastNameErr = $profileImageErr = $emailErr = $addressErr = $statusErr = "";
			$firstName = $lastName = $profileImage = $email = $address = $status = "";	 
			// Processing form data when form is submitted
			if($_SERVER["REQUEST_METHOD"] == "POST"){
			 
 		    	if(isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0){
 		    	        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
 		    	        $imageName = $_FILES["profileImage"]["name"];
 		    	        $filetype = $_FILES["profileImage"]["type"];
 		    	        $filesize = $_FILES["profileImage"]["size"];
 		    	    
 		    	        // Verify file extension
 		    	        $ext = pathinfo($imageName, PATHINFO_EXTENSION);
 		    	        if(!array_key_exists($ext, $allowed)){
 		    	        	$profileImageErr="Please select a valid file format.";
 		    	        }
 		    	    
 		    	        // Verify file size - 5MB maximum
 		    	        $maxsize = 5 * 1024 * 1024;
 		    	        if($filesize > $maxsize){
 		    	        	$profileImageErr = "File size is larger than the allowed limit.";
 		    	        }

 		    	        // Verify MYME type of the file
 		    	        if(in_array($filetype, $allowed)){

 		    	        	unlink($user['profileImage']);
 		    	            
 		    	            move_uploaded_file($_FILES["profileImage"]["tmp_name"], "uploads/items/" . $_FILES["profileImage"]["name"]);
 		    	                // echo "Your file was uploaded successfully.";
 		    	            $profileImage = "uploads/items/".$_FILES["profileImage"]["name"];
 		    	            
 	    		        } else{

 	    		            $profileImageErr = "There was a problem uploading your file. Please try again."; 
 	    		        }
 		    	}
 	    	    else{
 	    	       	$profileImage = $user['profileImage'];
 	    	    }
			    // Validate user name
			    if(empty($_POST["firstName"])){
			        $firstNameErr = "Please enter first name.";
			    } else{
			        $firstName = filterName($_POST["firstName"]);
			        if($firstName == FALSE){
			            $firstNameErr = "Please enter a valid name.";
			        }
			    }
			    if(empty($_POST["lastName"])){
			        $lastNameErr = "Please enter last name.";
			    } else{
			        $lastName = filterName($_POST["lastName"]);
			        if($lastName == FALSE){
			            $lastNameErr = "Please enter a valid name.";
			        }
			    }
			    
			    // Validate email address
			    if(empty($_POST["email"])){
			        $emailErr = "Please enter email address.";     
			    } else{
			        $email = filterEmail($_POST["email"]);
			        if($email == FALSE){
			            $emailErr = "Please enter a valid email address.";
			        }
			    }
			    
			    if(empty($_POST['address'])){
			        $addressErr = "Please enter address.";     
			    } else{
			        $address = filterString($_POST['address']);
			        if($address == FALSE){
			            $addressErr = "Please enter a valid address.";
			        }
			    }

			    if(empty($_POST['status'])){
			        $statusErr = "Please select status";
			    }else{
			    	$status = $_POST['status'];
			    }
			    
			    
			

			if (empty($firstNameErr || $lastNameErr || $emailErr || $addressErr || $statusErr)) {
				
				$profileImage = $mysqli->real_escape_string($profileImage);
				$first_name = $mysqli->real_escape_string($firstName);
				$last_name = $mysqli->real_escape_string($lastName);
				$Email = $mysqli->real_escape_string($email);
				$Address = $mysqli->real_escape_string($address);
				$Status = $mysqli->real_escape_string($status);
				 
				// Attempt insert query execution
				$sql = "UPDATE user SET profileImage='$profileImage', firstName='$first_name', lastName='$last_name', email='$Email', address='$Address', status='$Status' WHERE id=$id";

				if($mysqli->query($sql) == true){
				    $msg = "Records updated successfully.";
				    header('location:index.php?success='.urlencode($msg));
				} else{
				    $msg = "Oops! something went wrong. Please try again later.";
				    header('location:index.php?error='.urlencode($msg));
				}
				 
				// Close connection
				$mysqli->close();
			}
		}

	}else{
		$msg='User not found.';
		header('location:index.php?error='.urlencode($msg));
	}
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
							<h3 style="padding-bottom: 8px;">Update User Profile</h3>
						</div>
						<div class="col-md-10 contents">
							<form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])."?id=".$user['id']; ?>" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-12 text-center">
										<img src="<?=$user['profileImage'] ?>" alt="" width="100px">
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Profile Picture</label>
											<input class="form-control" type="file" name="profileImage">
											<span class="error"><?php echo $profileImageErr; ?></span>
										</div>
									</div>
									
								</div>
								<div class="row">
								    <div class="col-md-6">
								        <div class="form-group">
								            <label>First Name</label>
								            <input type="text" class="form-control" placeholder="First Name" name="firstName" value="<?=$user['firstName']; ?>">
								            <span class="error"><?php echo $firstNameErr; ?></span>
								        </div>
								    </div>
								    <div class="col-md-6">
								        <div class="form-group">
								            <label>Last Name</label>
								            <input type="text" class="form-control" placeholder="Last Name" name="lastName" value="<?=$user['lastName']; ?>">
											<span class="error"><?php echo $lastNameErr; ?></span>				
										</div>
								    </div>
								</div>
							    <div class="row">
							        <div class="col-md-12">
							            <div class="form-group">
							                <label for="exampleInputEmail1">Email address</label>
							                <input type="email" class="form-control" placeholder="Email" name="email" value="<?=$user['email']; ?>">
											<span class="error"><?php echo $emailErr; ?></span>				
										</div>
							        </div>
							    </div>
							    
							    <div class="row">
							        <div class="col-md-12">
							            <div class="form-group">
							                <label>Address</label>
							                <input type="text" class="form-control" placeholder="Address" name="address" value="<?=$user['address']; ?>">
							                <span class="error"><?php echo $addressErr; ?></span>
							          	</div>
							        </div>
							    </div>
							    <div class="row">
							    	<div class="col-md-12">
							    		<div class="form-group">
							    			<label for="">Status</label>
							    			
							    			<div class="form-check pl-50">
							    			  <input class="form-check-input" type="radio" name="status" id="statusActive" value="Active" <?php echo $user['status']=='Active'?'checked':''?>>
							    			  <label class="form-check-label" for="statusActive">
							    			    Active
							    			  </label>
							    			</div>
							    			<div class="form-check pl-50">
							    			  <input class="form-check-input" type="radio" name="status" id="statusDeactive" value="Deactive" <?php echo $user['status']=='Deactive'?'checked':''?>>
							    			  <label class="form-check-label" for="statusDeactive">
							    			    Deactive
							    			  </label>
							    			</div>
							    			<span class="error"><?php echo $statusErr; ?></span>
							    		</div>
							    	</div>
							    </div>
							    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
							    <button type="submit" class="btn btn-info btn-fill">Update</button>
							    <a href="index.php" class="btn btn-info btn-fill">Cancel</a>
							    <div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
			</div>

		
			<?php include_once('footer.php') ?>
