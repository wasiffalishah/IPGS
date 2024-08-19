<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'])==0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        // Collecting POST data
        $stuname = $_POST['stuname'];
        $stuemail = $_POST['stuemail'];
        $stuclass = $_POST['stuclass'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $stuid = $_POST['stuid'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $connum = $_POST['connum'];
        $altconnum = $_POST['altconnum'];
        $altconnum1 = !empty($_POST['altconnum1']) ? $_POST['altconnum1'] : null;
        $altconnum2 = !empty($_POST['altconnum2']) ? $_POST['altconnum2'] : null;
        $altconnum3 = !empty($_POST['altconnum3']) ? $_POST['altconnum3'] : null;
        $altconnum4 = !empty($_POST['altconnum4']) ? $_POST['altconnum4'] : null;
        $altconnum5 = !empty($_POST['altconnum5']) ? $_POST['altconnum5'] : null;
        $altconnum6 = !empty($_POST['altconnum6']) ? $_POST['altconnum6'] : null;
        $altconnum7 = !empty($_POST['altconnum7']) ? $_POST['altconnum7'] : null;
        $altconnum8 = !empty($_POST['altconnum8']) ? $_POST['altconnum8'] : null;
        $altconnum9 = !empty($_POST['altconnum9']) ? $_POST['altconnum9'] : null;
        $altconnum10 = !empty($_POST['altconnum10']) ? $_POST['altconnum10'] : null;
        $altconnum11 = !empty($_POST['altconnum11']) ? $_POST['altconnum11'] : null;
        $altconnum12 = !empty($_POST['altconnum12']) ? $_POST['altconnum12'] : null;
        $address = $_POST['address'];
        $eid = $_GET['editid'];

        // SQL Update Query
        $sql = "UPDATE tblstudent SET 
            StudentName = :stuname,
            StudentEmail = :stuemail,
            StudentClass = :stuclass,
            Gender = :gender,
            DOB = :dob,
            StuID = :stuid,
            FatherName = :fname,
            MotherName = :mname,
            ContactNumber = :connum,
            AltenateNumber = :altconnum,
            Jan = :altconnum1,
            Feb = :altconnum2,
            Mar = :altconnum3,
            Apr = :altconnum4,
            Jun = :altconnum5,
            Jul = :altconnum6,
            Aug = :altconnum7,
            Sep = :altconnum8,
            May = :altconnum9,
            Oct = :altconnum10,
            Nov = :altconnum11,
            Dece = :altconnum12,
            Address = :address 
            WHERE ID = :eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':stuname', $stuname, PDO::PARAM_STR);
        $query->bindParam(':stuemail', $stuemail, PDO::PARAM_STR);
        $query->bindParam(':stuclass', $stuclass, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':stuid', $stuid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mname', $mname, PDO::PARAM_STR);
        $query->bindParam(':connum', $connum, PDO::PARAM_STR);
        $query->bindParam(':altconnum', $altconnum, PDO::PARAM_STR);
        $query->bindParam(':altconnum1', $altconnum1, PDO::PARAM_STR);
        $query->bindParam(':altconnum2', $altconnum2, PDO::PARAM_STR);
        $query->bindParam(':altconnum3', $altconnum3, PDO::PARAM_STR);
        $query->bindParam(':altconnum4', $altconnum4, PDO::PARAM_STR);
        $query->bindParam(':altconnum5', $altconnum5, PDO::PARAM_STR);
        $query->bindParam(':altconnum6', $altconnum6, PDO::PARAM_STR);
        $query->bindParam(':altconnum7', $altconnum7, PDO::PARAM_STR);
        $query->bindParam(':altconnum8', $altconnum8, PDO::PARAM_STR);
        $query->bindParam(':altconnum9', $altconnum9, PDO::PARAM_STR);
        $query->bindParam(':altconnum10', $altconnum10, PDO::PARAM_STR);
        $query->bindParam(':altconnum11', $altconnum11, PDO::PARAM_STR);
        $query->bindParam(':altconnum12', $altconnum12, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Student has been updated")</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Update Students</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include_once('includes/header.php'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include_once('includes/sidebar.php'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Update Students </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Update Students</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Update Students</h4>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <?php
                                        $eid = $_GET['editid'];
                                        $sql = "SELECT tblstudent.StudentName, tblstudent.StudentEmail, tblstudent.StudentClass, tblstudent.Gender, tblstudent.DOB, tblstudent.StuID, tblstudent.FatherName, tblstudent.MotherName, tblstudent.ContactNumber, tblstudent.AltenateNumber, tblstudent.Jan, tblstudent.Feb,tblstudent.Mar,tblstudent.Apr,tblstudent.Jun,tblstudent.Jul,tblstudent.Aug,tblstudent.Sep,tblstudent.May,tblstudent.Oct,tblstudent.Nov,tblstudent.Dece, tblstudent.Address, tblstudent.UserName, tblstudent.Password, tblstudent.Image, tblstudent.DateofAdmission, tblclass.ClassName, tblclass.Section FROM tblstudent JOIN tblclass ON tblclass.ID = tblstudent.StudentClass WHERE tblstudent.ID = :eid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) {
                                                // Debugging output
                                                echo "<pre>";
                                                print_r($row);
                                                echo "</pre>";
                                        ?>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Student Name</label>
                                                    <input type="text" name="stuname" value="<?php echo htmlentities($row->StudentName); ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Student Email</label>
                                                    <input type="text" name="stuemail" value="<?php echo htmlentities($row->StudentEmail); ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail3">Student Class</label>
                                                    <select name="stuclass" class="form-control" required>
                                                        <option value="<?php echo htmlentities($row->StudentClass); ?>"><?php echo htmlentities($row->ClassName); ?> <?php echo htmlentities($row->Section); ?></option>
                                                        <?php
                                                        $sql2 = "SELECT * FROM tblclass";
                                                        $query2 = $dbh->prepare($sql2);
                                                        $query2->execute();
                                                        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                        foreach ($result2 as $row1) {
                                                        ?>
                                                            <option value="<?php echo htmlentities($row1->ClassName); ?><?php echo htmlentities($row1->Section); ?>"><?php echo htmlentities($row1->ClassName); ?> <?php echo htmlentities($row1->Section); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Gender</label>
                                                    <select name="gender" class="form-control" required>
                                                        <option value="<?php echo htmlentities($row->Gender); ?>"><?php echo htmlentities($row->Gender); ?></option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Date of Birth</label>
                                                    <input type="date" name="dob" value="<?php echo htmlentities($row->DOB); ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Student ID</label>
                                                    <input type="text" name="stuid" value="<?php echo htmlentities($row->StuID); ?>" class="form-control" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Student Photo</label>
                                                    <img src="images/<?php echo htmlentities($row->Image); ?>" width="100" height="100"><a href="changeimage.php?editid=<?php echo $row->ID; ?>"> &nbsp; Edit Image</a>
                                                </div>
                                                <h3>Parents/Guardian's details</h3>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Father's Name</label>
                                                    <input type="text" name="fname" value="<?php echo htmlentities($row->FatherName); ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Mother's Name</label>
                                                    <input type="text" name="mname" value="<?php echo htmlentities($row->MotherName); ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Contact Number</label>
                                                    <input type="text" name="connum" value="<?php echo htmlentities($row->ContactNumber); ?>" class="form-control" required maxlength="10" pattern="[0-9]+">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Alternate Contact Number</label>
                                                    <input type="text" name="altconnum" value="<?php echo htmlentities($row->AltenateNumber); ?>" class="form-control" required maxlength="10" pattern="[0-9]+">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Address</label>
                                                    <textarea name="address" class="form-control" required><?php echo htmlentities($row->Address); ?></textarea>
                                                </div>
                                                <h3>Fees Collections</h3>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">January</label>
                                                    <input type="text" name="altconnum1" value="<?php echo htmlentities($row->Jan); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Feburary</label>
                                                    <input type="text" name="altconnum2" value="<?php echo htmlentities($row->Feb); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">March</label>
                                                    <input type="text" name="altconnum3" value="<?php echo htmlentities($row->Mar); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">April</label>
                                                    <input type="text" name="altconnum4" value="<?php echo htmlentities($row->Apr); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">May</label>
                                                    <input type="text" name="altconnum9" value="<?php echo htmlentities($row->May); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">June</label>
                                                    <input type="text" name="altconnum5" value="<?php echo htmlentities($row->Jun); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">July</label>
                                                    <input type="text" name="altconnum6" value="<?php echo htmlentities($row->Jul); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">August</label>
                                                    <input type="text" name="altconnum7" value="<?php echo htmlentities($row->Aug); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">September</label>
                                                    <input type="text" name="altconnum8" value="<?php echo htmlentities($row->Sep); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">October</label>
                                                    <input type="text" name="altconnum10" value="<?php echo htmlentities($row->Oct); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">November</label>
                                                    <input type="text" name="altconnum11" value="<?php echo htmlentities($row->Nov); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">December</label>
                                                    <input type="text" name="altconnum12" value="<?php echo htmlentities($row->Dece); ?>" class="form-control" >
                                                </div>
                                                
                                                <h3>Login details</h3>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">User Name</label>
                                                    <input type="text" name="uname" value="<?php echo htmlentities($row->UserName); ?>" class="form-control" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Password</label>
                                                    <input type="password" name="password" value="<?php echo htmlentities($row->Password); ?>" class="form-control" readonly>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include_once('includes/footer.php'); ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
</body>
</html>
<?php } ?>
