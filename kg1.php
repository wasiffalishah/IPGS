<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
} else {
  // Code for deletion
  if(isset($_GET['delid'])) {
    $rid=intval($_GET['delid']);
    $sql="delete from tblstudent where ID=:rid";
    $query=$dbh->prepare($sql);
    $query->bindParam(':rid',$rid,PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Data deleted');</script>"; 
    echo "<script>window.location.href = 'manage-students.php'</script>";     
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>KG1 Class | IPGS</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- End layout styles -->
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">KG1 Class</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Student Data of KG1 Class</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                      <h4 align="center">Student Data for KG1 Class</h4>
                    </div>
                    <div class="table-responsive border rounded p-1">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="font-weight-bold">S.No</th>
                            <th class="font-weight-bold">ID</th>
                            <th class="font-weight-bold">Class</th>
                            <th class="font-weight-bold">Name</th>
                            <th class="font-weight-bold">F' Name</th>
                            <th class="font-weight-bold">Number</th>
                            <th class="font-weight-bold">Jan</th>
                            <th class="font-weight-bold">Feb</th>
                            <th class="font-weight-bold">Mar</th>
                            <th class="font-weight-bold">Apr</th>
                            <th class="font-weight-bold">May</th>
                            <th class="font-weight-bold">Jun</th>
                            <th class="font-weight-bold">Jul</th>
                            <th class="font-weight-bold">Aug</th>
                            <th class="font-weight-bold">Sep</th>
                            <th class="font-weight-bold">Oct</th>
                            <th class="font-weight-bold">Nov</th>
                            <th class="font-weight-bold">Dec</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (isset($_GET['pageno'])) {
                            $pageno = $_GET['pageno'];
                          } else {
                            $pageno = 1;
                          }
                          // Formula for pagination
                          $no_of_records_per_page = 5;
                          $offset = ($pageno-1) * $no_of_records_per_page;
                          $ret = "SELECT StudentName FROM tblstudent";
                          $query1 = $dbh -> prepare($ret);
                          $query1->execute();
                          $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                          $total_rows=$query1->rowCount();
                          $total_pages = ceil($total_rows / $no_of_records_per_page);
                          $sql="SELECT tblstudent.StuID, tblstudent.StudentName as sname, tblstudent.StudentName, tblstudent.FatherName, tblstudent.ContactNumber, tblstudent.Jan, tblstudent.Feb, tblstudent.Mar, tblstudent.Apr, tblstudent.May, tblstudent.Jun, tblstudent.Jul, tblstudent.Aug, tblstudent.Sep, tblstudent.Oct, tblstudent.Nov, tblstudent.Dece, tblclass.ClassName, tblclass.Section from tblstudent join tblclass on tblclass.ID=tblstudent.StudentClass WHERE tblclass.ClassName = 'kg1' LIMIT $offset, $no_of_records_per_page";
                          $query = $dbh -> prepare($sql);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $cnt=1;
                          if($query->rowCount() > 0) {
                            foreach($results as $row) { ?>   
                            <tr>
                              <td><?php echo htmlentities($cnt);?></td>
                              <td><?php echo htmlentities($row->StuID);?></td>
                              <td><?php echo htmlentities($row->ClassName);?> <?php echo htmlentities($row->Section);?></td>
                              <td><?php echo htmlentities($row->StudentName);?></td>
                              <td><?php echo htmlentities($row->FatherName);?></td>
                              <td><?php echo htmlentities($row->ContactNumber);?></td>
                              <td><?php echo htmlentities($row->Jan);?></td>
                              <td><?php echo htmlentities($row->Feb);?></td>
                              <td><?php echo htmlentities($row->Mar);?></td>
                              <td><?php echo htmlentities($row->Apr);?></td>
                              <td><?php echo htmlentities($row->May);?></td>
                              <td><?php echo htmlentities($row->Jun);?></td>
                              <td><?php echo htmlentities($row->Jul);?></td>
                              <td><?php echo htmlentities($row->Aug);?></td>
                              <td><?php echo htmlentities($row->Sep);?></td>
                              <td><?php echo htmlentities($row->Oct);?></td>
                              <td><?php echo htmlentities($row->Nov);?></td>
                              <td><?php echo htmlentities($row->Dece);?></td>
                            </tr>
                            <?php 
                            $cnt=$cnt+1;
                            } 
                          } else { ?>
                            <tr>
                              <td colspan="19"> No record found for this class</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div align="left">
                      <ul class="pagination" >
                        <li><a href="?pageno=1"><strong>First</strong></a></li>
                        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                          <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong style="padding-left: 10px">Prev</strong></a>
                        </li>
                        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                          <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong style="padding-left: 10px">Next</strong></a>
                        </li>
                        <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include_once('includes/footer.php');?>
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
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
<?php } ?>
