
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
                                <li><a href="#">Assignments</a></li>
                                <li class="active">View Assignments</li>
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
                            <strong class="card-title"><h2 align="center">All New Assignments for (<?php echo $levelName;?>)</h2><i style="margin-left:300px;color:red;">Note: To submit an assignment, kindly click on the submit with check icon!, and to download, click on the download/download icon</i></strong>
                        </div>
                        <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Lecturer</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Score Obtainable</th>
                                        <th>Pass Mark</th>
                                        <th>Deadline Date</th>
                                        <th>Level</th>
                                        <th>Course Code </th>
                                        <th>Course Title</th>  
                                        <th>Status</th>        
                                        <th>Assignment</th>
                                        <th>Submit</th>
                                        <th>Date Given</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                        <?php
                $ret=mysqli_query($con,"SELECT tblassignments.staffId,tblstaff.firstName,tblstaff.lastName,tblassignments.Id, tblassignments.title,tblassignments.description,tblassignments.scoreObtainable,
                tblassignments.passMark,tblassignments.deadLineDate,tblassignments.assignment,tblassignments.dateCreated,
                tbllevel.levelName,tblcourse.courseTitle,tblcourse.courseCode
                from tblassignments
                INNER JOIN tbllevel ON tbllevel.Id = tblassignments.levelId
                INNER JOIN tblstaff ON tblstaff.staffId = tblassignments.staffId
                INNER JOIN tblcourse ON tblcourse.Id = tblassignments.courseId
                where tbllevel.Id = '$levelId'");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {
                     //query to find submitted assignments
                     $assignmentId = $row['Id'];
                     $statusOfAssignment = "";
                     $querys = mysqli_query($con,"select * from tblassignmentsubmitted where assignmentId='$assignmentId' and matricNo = '$matricNo' and levelId ='$levelId'");
                     $rrw = mysqli_fetch_array($querys);
                     $count = mysqli_num_rows($querys);

                     if($count == 1){
                        $statusOfAssignment = "Submitted";
                     }
                     else{
                        $statusOfAssignment = "Not Submitted";
                     }
                                    ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['firstName']." ".$row['lastName'];?></td>
                <td><?php  echo $row['title'];?></td>
                <td><?php  echo $row['description'];?></td>
                <td><?php  echo $row['scoreObtainable'];?></td>
                <td><?php  echo $row['passMark'];?></td>
                <td><?php  echo $row['deadLineDate'];?></td>
                <td><?php  echo $row['levelName'];?></td>
                <td><?php  echo $row['courseCode'];?></td>
                <td><?php  echo $row['courseTitle'];?></td> 
                <td><?php  echo $statusOfAssignment;?></td>   
                <td><a href='../lecturer/download.php?file=<?php echo urlencode($row['assignment']);?>' title="Download Assignment"><i class="fa fa-download fa-1x">&nbsp;&nbsp;Download</i></a></td>
                <td><a href='submitAssignment.php?assignmentId=<?php echo $row['Id'];?>' title="Submit Assignment"><i class="fa fa-check fa-1x">Submit</i></a></td>
                <td><?php  echo $row['dateCreated'];?></td>
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
