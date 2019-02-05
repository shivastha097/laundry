<?php

    session_start();
    
    if ($_SESSION['loggedIn'] != 1) {
        header('location:login.php');
        exit;
    }
    

?>


<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "database-config.php";
    $id =  trim($_POST["id"]);
    // Prepare a delete statement
    $sql = "DELETE FROM user WHERE id = $id";
    
    if($mysqli->query($sql)==true){
        // Records deleted successfully. Redirect to landing page
        $err = "Record deleted successfully.";
        header("location:index.php?success=".urlencode($err));
        exit();
    } else{
        $err = "Oops! Something went wrong. Please try again later.";
        header('location:index.php?error='.urlencode($err));
    }

    
    // Close connection
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
                        <div class="col-md-12 text-center">
                            <div class="page-header" style="border-bottom: 0">
                                <h3>Delete Record</h3>
                            </div>
                            <div class="col-md-10 contents">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div>
                                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                                        <p>Are you sure you want to delete this record?</p><br>
                                        <p>
                                            <input type="submit" value="Yes" class="btn btn-danger">
                                            <a href="index.php" class="btn btn-default">No</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>        
        </div>
    <?php include_once('footer.php') ?>