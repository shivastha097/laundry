<?php

    session_start();
    
    if ($_SESSION['loggedIn'] != 1) {
        header('location:login.php');
        exit;
    }
    

?>

<?php
// Check existence of id parameter before processing further
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    // Include config file
    $id = $_GET['id'];
    require_once "database-config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM user WHERE id = $id";
    
    if($result = $mysqli->query($sql)){

        if ($result -> num_rows == 1 ){
            while ($row = $result->fetch_array()){
                $profileImage = $row['profileImage'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $createdDate = $row['createdDate'];
                $email = $row['email'];
                $address = $row['address'];
                $status = $row['status'];
            }
        } else{
                // URL doesn't contain valid id parameter. Redirect to error page
            $err = "URL doesn't contain valid id parameter.";
            header("location:index.php?error=".urlencode($err));
            exit();
        }
    } else{
            $err = "Oops! Something went wrong. Please try again later.";
            header("location:index.php?error=".urlencode($err));
            exit();
    }

    $mysqli->close();
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
                            <div class="">
                                <h3>View Record</h3>
                            </div>
                           <div class="details">
                                <div class="form-inline">
                                   <?php echo "<img width='80px'"."src=".$profileImage.">"; ?>
                               </div>
                               <div class="form-inline">
                                   <label>Name: </label>
                                   <p class="form-control-static"><?php echo $firstName." ".$lastName ; ?></p>
                               </div>
                               <div class="form-inline">
                                   <label>Created Date: </label>
                                   <p class="form-control-static"><?php echo $createdDate; ?></p>
                               </div>
                               <div class="form-inline">
                                   <label>Email: </label>
                                   <p class="form-control-static"><?php echo $email; ?></p>
                               </div>
                               <div class="form-inline">
                                   <label>Address: </label>
                                   <p class="form-control-static"><?php echo $address; ?></p>
                               </div>
                               <div class="form-inline">
                                   <label>Status: </label>
                                   <p class="form-control-static"><?php echo $status; ?></p>
                               </div>
                               <p><a href="index.php" class="btn btn-primary">Back</a></p>
                           </div> 
                           
                        </div>
                    </div>
                </div>
            </div>

        
            <?php include_once('footer.php') ?>



