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
    $sql = "SELECT * FROM message WHERE id = $id";
    
    if($result = $mysqli->query($sql)){

        if ($result -> num_rows == 1 ){
            while ($row = $result->fetch_array()){
                $id = $row['id'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $email = $row['email'];
                $phone = $row['phone'];
                $pickupDate = $row['pickupDate'];
                $pickupTime = $row['pickupTime'];
                $address = $row['address'];
                $city = $row['city'];
                $garmentType = $row['garmentType'];
                $serviceType = $row['serviceType'];
                $description = $row['description'];
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
                        <div class="col-md-12">
                            <div class="page-header">
                                <h3>View Record</h3>
                            </div>
                            <div class="details table">
                                <table class="table table-striped table-hover table-bordered pb-5">
                                  <tr>
                                    <th scope="row">Message ID</th>
                                    <td><?php echo $id; ?></td>
                                  </tr>
                                  <tr>
                                    <th>Name</th>
                                    <td><?php echo $firstName." ".$lastName ; ?></td>
                                  </tr>
                                  <tr>
                                    <th>Email</th>
                                    <td><?php echo $email; ?></td>
                                  </tr>
                                  <tr>
                                    <th>Phone</th>
                                    <td><?php echo $phone ?></td>
                                  </tr>
                                  <tr>
                                    <th>Pickup Date</th>
                                    <td><?php echo $pickupDate ?></td>
                                  </tr>
                                  <tr>
                                    <th>Pickup Time</th>
                                    <td><?php echo $pickupTime ?></td>
                                  </tr>
                                  <tr>
                                    <th>Address</th>
                                    <td><?php echo $address; ?></td>
                                  </tr>
                                  <tr>
                                    <th>City</th>
                                    <td><?php echo $city ?></td>
                                  </tr>
                                  <tr>
                                    <th>Garment Type</th>
                                    <td><?php echo $garmentType ?></td>
                                  </tr>
                                  <tr>
                                    <th>Service Type</th>
                                    <td><?php echo $serviceType ?></td>
                                  </tr>
                                  <tr>
                                    <th>Description</th>
                                    <td><?php echo $description ?></td>
                                  </tr>
                                </table>
                               <p><a href="message.php" class="btn btn-primary">Back</a></p>
                           </div> 
                           
                        </div>
                    </div>
                </div>
            </div>

        
            <?php include_once('footer.php') ?>



