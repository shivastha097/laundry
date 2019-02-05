<?php

	session_start();
	
	if ($_SESSION['loggedIn'] != 1) {
		header('location:login.php');
		exit;
	}
	

?>

<?php
	require_once('database-config.php');

	$itemName = $itemImage = $price = $status = "";
	$itemNameErr = $itemImageErr = $priceErr = $statusErr = "";

	function filterName($field){
	    // Sanitize user name
	    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
	    
	    // Validate user name
	    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z ]*$/")))){
	        return $field;
	    } else{
	        return FALSE;
	    }
	}
	function filterPrice($field){
		$field = filter_var(trim($field), FILTER_SANITIZE_NUMBER_INT);

		if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){
			return $field;
		}
		else{
			return false;
		}
	}

	if(isset($_GET['id']) && !empty(trim($_GET['id']))){

		
		$id = $_GET['id'];
		$usql="SELECT * FROM price_list  WHERE id=".$id;
		if($mysqli->query($usql)->num_rows==1){
		    $price_list=$mysqli->query($usql)->fetch_Assoc();
	
			if($_SERVER["REQUEST_METHOD"] == "POST"){
			 
			    if(empty($_POST['itemName'])){
			    	    $itemNameErr = "Please enter item name.";     
			    	} else{
			    	    $itemName = filterName($_POST['itemName']);
			    	    if($itemName == FALSE){
			    	        $itemNameErr = "Please enter a valid item name.";
			    	    }
			    	}


			    	if(isset($_FILES['itemImage']) && $_FILES['itemImage']['error'] == 0){
			    	        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			    	        $imageName = $_FILES["itemImage"]["name"];
			    	        $filetype = $_FILES["itemImage"]["type"];
			    	        $filesize = $_FILES["itemImage"]["size"];
			    	    
			    	        // Verify file extension
			    	        $ext = pathinfo($imageName, PATHINFO_EXTENSION);
			    	        if(!array_key_exists($ext, $allowed)){
			    	        	$itemImageErr="Please select a valid file format.";
			    	        }
			    	    
			    	        // Verify file size - 5MB maximum
			    	        $maxsize = 5 * 1024 * 1024;
			    	        if($filesize > $maxsize){
			    	        	$itemImageErr = "File size is larger than the allowed limit.";
			    	        }

			    	        // Verify MYME type of the file
			    	        if(in_array($filetype, $allowed)){

			    	        	unlink($price_list['image']);
			    	            
			    	            move_uploaded_file($_FILES["itemImage"]["tmp_name"], "uploads/items/" . $_FILES["itemImage"]["name"]);
			    	                // echo "Your file was uploaded successfully.";
			    	            $itemImage = "uploads/items/".$_FILES["itemImage"]["name"];
			    	            
		    		        } else{

		    		            $itemImageErr = "There was a problem uploading your file. Please try again."; 
		    		        }
			    	    }
		    	    else{
		    	       	$itemImage = $price_list['image'];
		    	    }

			    	if(empty($_POST['price'])){
			    	    $priceErr = "Please enter item's price.";     
			    	} else{
			    	    $price = "Rs.".filterPrice($_POST['price'])."/piece";
			    	    if($price == FALSE){
			    	        $priceErr = "Please enter a valid amount.";
			    	    }
			    	}
			    	if (empty($_POST['status'])) {
			    		$statusErr = "Please select the status.";
			    	} else{
			    		$status = trim($_POST['status']);
			    	}

			if (empty($itemNameErr || $itemImageErr || $priceErr)) {
				
				$itemName = $mysqli->real_escape_string($itemName);
				$itemImage = $mysqli->real_escape_string($itemImage);
				$price = $mysqli->real_escape_string($price);
				$status = $mysqli->real_escape_string($status);
				 
				// Attempt insert query execution
				$sql = "UPDATE price_list SET item='$itemName', image='$itemImage', price='$price', status='$status' WHERE id=$id";

				if($mysqli->query($sql) == true){
				    $msg = "Records updated successfully.";
				    header('location:price-list.php?success='.urlencode($msg));
				} else{
				    $msg = "Oops! something went wrong. Please try again later.";
				    header('location:price-list.php?error='.urlencode($msg));
				}
				 
				// Close connection
				$mysqli->close();
			}
		}

	}else{
		$msg='User not found.';
		header('location:price-list.php?error='.urlencode($msg));
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
							<h3 style="padding-bottom: 8px;">Update Item Information</h3>
						</div>
						<div class="col-md-10 contents">
							<form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])."?id=".$price_list['id']; ?>" enctype="multipart/form-data">
								    <div class="row">
								    	<div class="col-md-12 text-center">
								    		<img src="<?=$price_list['image']?>" alt="" width="100px">
								    	</div>
								        <div class="col-md-12">
								            <div class="form-group">
								                <label for="inputItemName">Name</label>
								                <input type="text" class="form-control" placeholder="Item name" name="itemName" value="<?=$price_list['item']; ?>">
												<span class="error"><?php echo $itemNameErr; ?></span>		
											</div>
								        </div>
								    </div>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputImage">Image</label>
											<input id="inputImage" class="form-control" type="file" name="itemImage" 
											value="<?=$price_list['image']; ?>">
											
											<span class="error"><?php echo $itemImageErr; ?></span>
										</div>
									</div>
								</div>
								<div class="row">
								    <div class="col-md-12">
								        <div class="form-group">
								            <label>Price (per piece in Rs.)</label>
								            <input type="text" class="form-control" placeholder="30" name="price" value="<?=$price_list['price']; ?>">
								            <span class="error"><?php echo $priceErr; ?></span>
								        </div>
								    </div>
								</div>
							    <div class="row">
							    	<div class="col-md-12">
							    		<div class="form-group">
							    			<label for="">Status</label>
							    			<div class="form-check pl-50">
							    			  <input class="form-check-input" type="radio" name="status" id="statusActive" value="Active" <?php echo $price_list['status']=='Active'?'checked':'' ?>>
							    			  <label class="form-check-label" for="statusActive">
							    			    Active
							    			  </label>
							    			</div>
							    			<div class="form-check pl-50">
							    			  <input class="form-check-input" type="radio" name="status" id="statusInactive" value="Inactive" <?php echo $price_list['status']=='Inactive'?'checked':''; ?>>
							    			  <label class="form-check-label" for="statusInactive">
							    			    Inactive
							    			  </label>
							    			</div>
							    			<span class="error"><?php echo $statusErr; ?></span>
							    		</div>
							    	</div>
							    </div>
							    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
							    <button type="submit" class="btn btn-info btn-fill">Update</button>
							    <a href="price-list.php" class="btn btn-info btn-fill">Cancel</a>
							    <div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
			</div>

		
			<?php include_once('footer.php') ?>
