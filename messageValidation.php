<?php

	require_once('admin/database-config.php');

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

	function isDate($field) {
	    
	    $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
	    if (!preg_match($pattern, $field)) 
	    	return false;
	    return true;
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
	$firstNameErr = $lastNameErr = $emailErr = $phoneErr = $pickupDateErr = $pickupTimeErr = $addressErr = $cityErr  = $garmentTypeErr = $serviceTypeErr = "";
	$firstName = $lastName = $email = $phone = $pickupDate = $pickupTime = $address = $city = $garmentType = $serviceType = $description = "";	 
	// Processing form data when form is submitted
	if(!empty($_POST)){
	 
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

	    /*if (empty($_POST['pickupDate'])) {
	    	$pickupDateErr = "Please enter pickup date.";
	    } else{
	    	if (!isDate($_POST['pickupDate'])) {
	    		$pickupDateErr = "Please enter valid date : dd/mm/yyyy";
	    	}
	    	else{
	    		$pickupDate = $_POST['pickupDate'];
	    	}
		}*/
	        
	    // if (empty($_POST['phone'])) {
	    // 	$phoneErr = "Please enter your phone number."	    
	    // } else{
	    // 	$phone = trim($_POST['phone']);
	    // }
	    
	    if(empty($_POST['address'])){
	        $addressErr = "Please enter address.";     
	    } else{
	        $address = filterString($_POST['address']);
	        if($address == FALSE){
	            $addressErr = "Please enter a valid address.";
	        }
	    }

	    if(empty($_POST['city'])){
	        $cityErr = "Please enter city.";     
	    } else{
	        $city = filterName($_POST['city']);
	        if($city == FALSE){
	            $addressErr = "Please enter a valid city.";
	        }
	    }

	    if(empty($_POST['garmentType'])){
	        $garmentTypeErr = "Please select type of garment";
	    }else{
	    	$garmentType = implode(", ", $_POST['garmentType']);
	    }

	    if(empty($_POST['serviceType'])){
	        $serviceTypeErr = "Please select type of service.";
	    }else{
	    	$serviceType = $_POST['serviceType'];
	    }

	    if (!empty($_POST['description'])) {
	    	$description = trim($_POST['description']);
	    }
	    
	    
	    
	}

	if (!empty($firstNameErr || $lastNameErr || $emailErr || $phoneErr || $pickupDateErr || $pickupTimeErr || $addressErr || $cityErr  || $garmentTypeErr || $serviceTypeErr)) {
		
		$error['fname']=$firstNameErr;
		$error['lname']=$lastNameErr;
		$error['email']=$emailErr;
		$error['phone']=$phoneErr;
		$error['pickupDate'] = $pickupDateErr;
		$error['pickupTime'] = $pickupTimeErr;
		$error['address']=$addressErr;
		$error['city'] = $cityErr;
		$error['garmentType']=$garmentTypeErr;
		$error['serviceType'] = $serviceTypeErr;
		header('location:index.php?'.http_build_query($error));
		die();
	} else{
		$fistName = $mysqli->real_escape_string($firstName);
		$lastName = $mysqli->real_escape_string($lastName);
		$email = $mysqli->real_escape_string($email);
		$phone = $mysqli->real_escape_string($_POST['phone']);
		$pickupDate = $mysqli->real_escape_string($_POST['pickupDate']);
		$pickupTime = $mysqli->real_escape_string($_POST['pickupTime']);
		$address = $mysqli->real_escape_string($address);
		$city = $mysqli->real_escape_string($city);
		$garmentType = $mysqli->real_escape_string($garmentType);
		$serviceType = $mysqli->real_escape_string($serviceType);
		$description = $mysqli->real_escape_string($description);
		 
		// Attempt insert query execution
		$sql = "INSERT INTO message (firstName, lastName, email, phone, pickupDate, pickupTime, address, city, garmentType, serviceType, description) VALUES ('$firstName', '$lastName', '$email', '$phone', '$pickupDate', '$pickupTime', '$address', '$city', '$garmentType', '$serviceType' , '$description' )";
		if($mysqli->query($sql) === true){
		    echo json_encode(['message'=>'Order succssfully placed...','istrue'=>true]);
		    die();
		} else{
		    echo json_encode(['error'=>'Something went wrong. Please try later','istrue'=>true]);
		    die();
		}

		 
		// Close connection
		$mysqli->close();	
	}


		
		
	
	
?>