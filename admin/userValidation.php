<?php


	require_once('database-config.php');


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
	$firstNameErr = $lastNameErr = $profileImageErr = $emailErr = $passwordErr = $addressErr = $statusErr = "";
	$firstName = $lastName = $profileImage = $email = $password = $address = $status = "";	 
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
		            // Check whether file exists before uploading it
		            if(file_exists("upload/" . $_FILES["profileImage"]["name"])){
		                echo $_FILES["profileImage"]["name"] . " is already exists.";
		            } else{
		               move_uploaded_file($_FILES["profileImage"]["tmp_name"], "uploads/" . $_FILES["profileImage"]["name"]);
		                // echo "Your file was uploaded successfully.";
		               $profileImage = "uploads/".$_FILES["profileImage"]["name"];
		            //} 
			        }
			        } else{

			            echo "Error: There was a problem uploading your file. Please try again."; 
			        }
		    	}

		     else{
		        echo "Error: " . $_FILES["profileImage"]["error"];
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

	    if (empty($_POST['password']) || empty($_POST['confirmPassword'])) {
	    	$passwordErr = "Please enter password.";
	    } elseif ($_POST['password'] !== $_POST['confirmPassword'] ) {
	    	$passwordErr = "Please re-type password.";
	    } else{
	    	$password = md5(filterString(trim($_POST['password'])));
	    }

	    
	    // Validate user comment
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
	    
	    
	}

	if (!empty($profileImageErr || $firstNameErr || $lastNameErr || $emailErr || $passwordErr || $addressErr || $statusErr)) {
		$error['profileImage']=$profileImageErr;
		$error['fname']=$firstNameErr;
		$error['lname']=$lastNameErr;
		$error['email']=$emailErr;
		$error['password']=$passwordErr;
		$error['address']=$addressErr;
		$error['status']=$statusErr;
		header('location:addUser.php?'.http_build_query($error));
		die();
	}

	else{
		$fistName = $mysqli->real_escape_string($firstName);
		$lastName = $mysqli->real_escape_string($lastName);
		$profileImage = $mysqli->real_escape_string($profileImage);
		$email = $mysqli->real_escape_string($email);
		$password = $mysqli->real_escape_string($password);
		$address = $mysqli->real_escape_string($address);
		$status = $mysqli->real_escape_string($status);
		 
		// Attempt insert query execution
		$sql = "INSERT INTO user (firstName, lastName, profileImage, email, password, address, status) VALUES ('$firstName', '$lastName', '$profileImage', '$email', '$password', '$address', '$status')";
		if($mysqli->query($sql) === true){
		    $msg = "Records inserted successfully.";
		    header('location:index.php?success='.urlencode($msg));
		    die();
		} else{
		    $msg ="Oops! something went wrong. Please try later.";
		    header('location:index.php?error='.urlencode($msg));
		}
		 
		// Close connection
		$mysqli->close();
		
	}
?>