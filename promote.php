<?php
session_start();
include('includes/dbconnection.php');

// Check if user is logged in
if (!isset($_SESSION['sturecmsaid']) || strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
    exit;
}

// Handle class promotion
if (isset($_POST['promote'])) {
    $currentClass = $_POST['currentClass'];
    $nextClass = $_POST['nextClass'];
    $password = $_POST['password'];

    // Define the correct password
    $correctPassword = 'ipgsirfanconfirm';

    if ($password === $correctPassword) {
        try {
            // Start the transaction
            $dbh->beginTransaction();

            // Retrieve current class ID
            $sql1 = "SELECT ID FROM tblclass WHERE ClassName = :currentClass";
            $query1 = $dbh->prepare($sql1);
            $query1->bindParam(':currentClass', $currentClass, PDO::PARAM_STR);
            $query1->execute();
            $result1 = $query1->fetch(PDO::FETCH_ASSOC);
            $currentClassID = $result1['ID'];

            // Retrieve next class ID
            $sql2 = "SELECT ID FROM tblclass WHERE ClassName = :nextClass";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':nextClass', $nextClass, PDO::PARAM_STR);
            $query2->execute();
            $result2 = $query2->fetch(PDO::FETCH_ASSOC);
            $nextClassID = $result2['ID'];

            // Ensure both IDs are valid
            if ($currentClassID && $nextClassID) {
                // Update student records
                $sql3 = "UPDATE tblstudent SET StudentClass = :nextClassID WHERE StudentClass = :currentClassID";
                $query3 = $dbh->prepare($sql3);
                $query3->bindParam(':nextClassID', $nextClassID, PDO::PARAM_INT);
                $query3->bindParam(':currentClassID', $currentClassID, PDO::PARAM_INT);
                $query3->execute();

                // Commit the transaction
                $dbh->commit();

                echo "<script>alert('Students promoted from class $currentClass to class $nextClass');</script>";
                echo "<script>window.location.href = 'promote.php'</script>";
            } else {
                // Rollback the transaction if IDs are not valid
                $dbh->rollBack();
                echo "<script>alert('Invalid class IDs');</script>";
            }
        } catch (PDOException $e) {
            // Rollback the transaction in case of error
            $dbh->rollBack();
            echo "<script>alert('Failed to promote students: ".$e->getMessage()."');</script>";
        }
    } else {
        echo "<script>alert('Incorrect password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPGS | Promote Classes</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="vendors/chartist/chartist.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .hidden { display: none; }
        .button-container { margin-top: 20px; }
        .button-container button { margin-right: 10px; }


        /* Ticker styles */
        .ticker-container {
            background-color: red;
            color: white;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1000;
        }
        .ticker {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            box-sizing: border-box;
        }
        .ticker div {
            display: inline-block;
            padding-left: 100%;
            animation: ticker 30s linear infinite;
        }
        @keyframes ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }


    </style>
</head>
<body>
    <div class="container-scroller">
        <?php include_once('includes/header.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/sidebar.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Promote Classes</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Promote Classes</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Promotion Buttons -->
                                    <div class="button-container">
                                        <?php 
                                        $classes = ["Mont", "KG1", "KG2", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11"];
                                        for ($i = 0; $i < count($classes) - 1; $i++): ?>
                                            <form method="post" style="padding: 10px;">
                                                <input type="hidden" name="currentClass" value="<?php echo $classes[$i]; ?>">
                                                <input type="hidden" name="nextClass" value="<?php echo $classes[$i + 1]; ?>">
                                                <div>
                                                    <label for="password">Password:</label>
                                                    <input type="password" id="password" name="password" required="true" class="form-control" >
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="promote">Promote Class <?php echo $classes[$i]; ?> to <?php echo $classes[$i + 1]; ?></button>
                                            </form>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>
    <div class="ticker-container">
        <div class="ticker">
            <div>Warning: Students should be promoted in reverse order. First promote class 10 to 11, then class 9 to 10, and so on. First Enter Password "ipgsirfanconfirm" and then press button of class that you want to promote. (Software Made by Wasiff Ali Shah)</div>
        </div>
    </div>
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/moment/moment.min.js"></script>
    <script src="vendors/daterangepicker/daterangepicker.js"></script>
    <script src="vendors/chartist/chartist.min.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
