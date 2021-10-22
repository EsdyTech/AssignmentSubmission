
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');

  ?>

<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include 'includes/title.php';?>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="../img/favicon2.jpeg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <!-- Left Panel -->
    <?php include 'includes/leftMenu.php';?>

   <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
            <?php include 'includes/header.php';?>
        <!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Attendance</a></li>
                                    <li class="active">All Attendance Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                          
                           
                        </div> <!-- .card -->
                    </div><!--/.col-->
               
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h1 align="center">All Attendance Report</h1></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                    <th>S.NO</th>
                                    <th>Matric No</th>
                                    <th>Card ID</th>
                                    <th>Full Name</th>
                                    <th>Level</th>
                                    <th>Course</th>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                    <th>CheckInTime</th>
                                    <th>CheckOutTime</th>
                                    <th>Date Taken</th>
                                    <th>Action</th>
                                    </tr>
                                    </thead>
        <?php
 //where date(tblattendance.DateTaken) = CURDATE();
        $ret=mysqli_query($con,"SELECT tblcourse.courseId,tblcourse.courseTitle,tblattendance.cardId, tblstudent.matricNo, tblstudent.firstName,tblstudent.lastName, 
        tblstudent.otherName, tblattendance.CheckInTime,tblattendance.CheckOutTime, 
        tblattendance.DateTaken, tblfaculty.facultyName, tbldepartment.departmentName,tbllevel.levelName
        from tblattendance 
        INNER JOIN tblstudent ON tblstudent.cardId = tblattendance.cardId
        INNER JOIN tblcourse ON tblcourse.courseId = tblattendance.courseId
        INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
        INNER JOIN tbldepartment ON tbldepartment.Id = tblcourse.departmentId
        INNER JOIN tblfaculty ON tblfaculty.Id = tblcourse.facultyId
        where tblfaculty.Id = '$facultyId' and tbldepartment.Id = '$departmentId' and date(tblattendance.DateTaken) = CURDATE();");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {

        ?>
                            <tr>   
                            <td><?php echo $cnt;?></td>
                            <td><?php  echo $row['matricNo'];?></td>
                            <td><?php  echo $row['cardId'];?></td>
                            <td><?php  echo $row['firstName'].' '.$row['lastName'].' '.$row['otherName'];?></td>
                            <td><?php  echo $row['levelName'];?></td>
                            <td><?php  echo $row['courseTitle'];?></td>
                            <td><?php  echo $row['facultyName'];?></td>
                            <td><?php  echo $row['departmentName'];?></td>
                            <td><?php  echo date("h:i a", strtotime($row['CheckInTime']));?></td>
                            <?php 
                            if ($row['CheckOutTime'] != null) {
                            ?>
                            <td><?php  echo date("h:i a", strtotime($row['CheckOutTime']));?></td>
                            <?php } else{?>
                            <td></td>
                            <?php }?>
                            <td><?php  echo $row['DateTaken'];?></td>
                            <td><a href="studentDetails.php?editid=<?php echo $row['matricNo'];?>" title="View Full Details"><i class="fa fa-eye fa-1x"></i></a></td>
                            </tr>
                            <?php 
                            $cnt=$cnt+1;
                            }?>
                           
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
<!-- end of datatable -->

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

        <?php include 'includes/footer.php';?>


</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );
  </script>

</body>
</html>
