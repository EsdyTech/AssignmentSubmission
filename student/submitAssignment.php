
<?php

include('../includes/dbconnection.php');
include('../includes/session.php');
error_reporting(0);

if(isset($_GET['assignmentId'])){

    $_SESSION['assignmentId'] = $_GET['assignmentId'];
    
    $query = mysqli_query($con,"select * from tblassignments where Id='$_SESSION[assignmentId]'");
    $rowi = mysqli_fetch_array($query);

    $courseId = $rowi['courseId'];
    $llevelId = $rowi['levelId'];
    $staffId = $rowi['staffId'];
    $scoreObtainable = $rowi['scoreObtainable'];

    }
    
    else{
    
    echo "<script type = \"text/javascript\">
        window.location = (\"submitAssignment.php\")
        </script>"; 
    }

    
if(isset($_POST['submit'])){


 $alertStyle ="";
 $statusMsg="";

$description=$_POST['description'];
$dateSubmitted = date("Y-m-d");

$deadlineDate = $rowi['deadLineDate'];
$todaysDate = date("Y-m-d");

//file uplaod
$assignmentTmpPath = $_FILES['assignmentFile']['tmp_name'];
$assignmentfileName = $_FILES['assignmentFile']['name'];
$assignmentfileSize = $_FILES['assignmentFile']['size'];
$assignmentfileType = $_FILES['assignmentFile']['type'];
$assignmentfileNameCmps = explode(".", $assignmentfileName);
$assignmentfileExtension = strtolower(end($assignmentfileNameCmps));

//gives the fileupoladed a unique Identifier
$assignmentnewFileName = md5(time().$assignmentfileName).'.'.$assignmentfileExtension;

$query=mysqli_query($con,"select * from tblassignmentsubmitted where assignmentId ='$_SESSION[assignmentId]'and matricNo = '$matricNo'");
$ret=mysqli_fetch_array($query);
if($ret > 0){

  $alertStyle ="alert alert-danger";
  $statusMsg="This Assignment has Already been Submitted!";

}
else if($todaysDate > $deadlineDate){

    $alertStyle ="alert alert-danger";
    $statusMsg="This Assignment has exceeded the Submission deadline date!";
}
else{

    $allowedfileExtensions = array('jpg','png','jpeg');
    if (in_array($assignmentfileExtension, $allowedfileExtensions)) {

        $alertStyle ="alert alert-danger";
        $statusMsg="The File Type is not allowed!";
    }
    else{

        //move to the folder
        $uploadFileDir = 'submittedAssignments/';
        $dest_path = $uploadFileDir.$assignmentnewFileName;
        move_uploaded_file($assignmentTmpPath, $dest_path);

        $query=mysqli_query($con,"insert into tblassignmentsubmitted(assignmentId,matricNo,levelId,courseId,description,assignmentSubmitted,staffId,scoreObtainable,scoreObtained,scoreStatus,staffNotes,dateSubmitted,isGraded,dateGraded) 
        value('$_SESSION[assignmentId]','$matricNo','$llevelId','$courseId','$description','$assignmentnewFileName','$staffId','$scoreObtainable','','$scoreStatus','','$dateSubmitted','','')");

        if ($query) {

            $alertStyle ="alert alert-success";
            $statusMsg="Assignment Submitted Successfully!";
        }
        else
        {
            $alertStyle ="alert alert-danger";
            $statusMsg="An error Occurred!";
        }
    }

}
}
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

<script>
function showCourses(str) {
if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
} else { 
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET","ajaxCallCourses2.php?lid="+str,true);
    xmlhttp.send();
}
}
</script>
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
                                <li><a href="#">Assignment</a></li>
                                <li class="active">Submit Assignment</li>
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
                        <div class="card-header">
                            <strong class="card-title"><h2 align="center">Submit Assignments</h2></strong>
                        </div>
                        <div class="card-body">
                            <!-- Credit Card -->
                            <div id="pay-invoice">
                                <div class="card-body">
                                   <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                    <form method="Post" action="" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Title</label>
                                                    <input id="" name="" type="text" class="form-control cc-exp" value="<?php echo $rowi['title']?>" Readonly data-val="true" placeholder="Title">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="x_card_code" class="control-label mb-1">Description</label>
                                                    <input id="" name="" type="text" class="form-control cc-cvc" value="<?php echo $rowi['description']?>" Readonly  placeholder="Description">
                                                    </div>
                                                </div>
                                                <div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Score Obtainable</label>
                                                    <input id="" name="" type="text" class="form-control cc-exp" value="<?php echo $rowi['scoreObtainable']?>" Readonly>
                                                </div>
                                            </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Pass Mark</label>
                                                    <input id="" name="" type="text" class="form-control cc-exp" value="<?php echo $rowi['passMark']?>" Readonly>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Deadline Date</label>
                                                    <input id="" name="" type="date" class="form-control" value="<?php echo $rowi['deadLineDate']?>" Readonly>
                                                </div>
                                            </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Assignment</label><br>
                                                    <a href='../lecturer/download.php?file=<?php echo urlencode($rowi['assignment']);?>'class="btn btn-success" title="Download Assignment">Click here to Download Assignment Given!</a>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Level</label>
                                                    <?php
                                                    $levelId = $rowi['levelId'];
                                                    $queryl = mysqli_query($con,"select * from tbllevel where Id='$llevelId'");
                                                    $rowl = mysqli_fetch_array($queryl);
                                                    ?>
                                                    <input name="" type="text" class="form-control" value="<?php echo $rowl['levelName']?>" Readonly>
                                                </div>
                                            </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Course</label>
                                                    <?php
                                                    $courseId = $rowi['courseId'];
                                                    $queryc = mysqli_query($con,"select * from tblcourse where Id='$courseId'");
                                                    $rowc = mysqli_fetch_array($queryc);
                                                    ?>
                                                    <input name="" type="text" class="form-control" value="<?php echo $rowc['courseTitle']?>" Readonly>
                                                </div>
                                        </div>
                                    </div>         
                                    <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Upload Assignment</label>
                                                    <input name="assignmentFile" type="file" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Description</label>
                                                    <input name="description" type="text" class="form-control"  placeholder="Description">
                                                </div>
                                            </div>
                                    </div>                                      
                                            <button type="submit" name="submit" class="btn btn-primary">Submit Assignment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .card -->
                </div><!--/.col-->
           

            <br><br>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title"><h2 align="center">All Assignments Submitted</h2> <i style="margin-left:500px;color:red;">Note: Once an assignment submitted has been graded, you can't delete that submitted assignment!</i></strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Lecturer</th>
                                        <th>Course Code </th>
                                        <th>Course Title</th>
                                        <th>Level</th>
                                        <th>Description of Submission</th>
                                        <th>Score Obtainable</th>
                                        <th>Score Obtained</th>
                                        <th>Status</th>
                                        <th>Lecturer Notes</th>
                                        <th>Assignment Submitted</th>
                                        <th>Date Submitted</th>
                                        <th>Status</th>
                                        <th>Date Graded</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                        <?php
                $ret=mysqli_query($con,"SELECT tblassignmentsubmitted.Id AS assignmentSubmittedId, tblassignmentsubmitted.assignmentId,tblassignmentsubmitted.levelId,
                tblassignmentsubmitted.courseId,tblassignmentsubmitted.description AS submittedDescription,tblassignmentsubmitted.assignmentSubmitted,tblassignments.staffId,tblassignments.Id, tblassignments.title,tblassignments.description,
                tblassignmentsubmitted.staffId,tblassignmentsubmitted.scoreObtained,tblassignmentsubmitted.scoreObtainable,tblassignmentsubmitted.scoreStatus,tblassignmentsubmitted.isGraded,
                tblassignmentsubmitted.staffNotes,tblassignmentsubmitted.dateSubmitted,tbllevel.levelName,tblcourse.courseTitle,tblcourse.courseCode,tblassignmentsubmitted.dateGraded,
                tblstaff.firstName, tblstaff.lastName
                from tblassignmentsubmitted
                INNER JOIN tbllevel ON tbllevel.Id = tblassignmentsubmitted.levelId
                INNER JOIN tblstaff ON tblstaff.staffId = tblassignmentsubmitted.staffId
                INNER JOIN tblassignments ON tblassignments.Id = tblassignmentsubmitted.assignmentId
                INNER JOIN tblcourse ON tblcourse.Id = tblassignmentsubmitted.courseId
                where tblassignmentsubmitted.matricNo = '$matricNo' and tblassignmentsubmitted.levelId = '$levelId'
                 and tblassignmentsubmitted.assignmentId = '$_SESSION[assignmentId]'");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {
                                    ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['firstName']." ". $row['lastName'];?></td>
                <td><?php  echo $row['courseCode'];?></td>
                <td><?php  echo $row['courseTitle'];?></td>
                <td><?php  echo $row['levelName'];?></td>
                <td><?php  echo $row['submittedDescription'];?></td>
                <td><?php  echo $row['scoreObtainable'];?></td>
                <td><?php  echo $row['scoreObtained'];?></td>
                <td <?php if($row['scoreStatus'] == "Failed"){echo "style='color:red'";} if($row['scoreStatus'] == "Passed"){ echo "style='color:green'";};?>><?php  echo $row['scoreStatus'];?></td>
                <td><?php  echo $row['staffNotes'];?></td>
                <td><a href='download.php?file=<?php echo urlencode($row['assignmentSubmitted']);?>' title="Download File"><i class="fa fa-download fa-1x">&nbsp;&nbsp;&nbsp;Download</i></a></td>
                <td><?php  echo $row['dateSubmitted'];?></td>
                <td <?php if($row['isGraded'] == 0){echo "style='color:red'";} if($row['isGraded'] == 1){ echo "style='color:green'";}?>><?php if($row['isGraded'] == 0){echo "Not Graded";} if($row['isGraded'] == 1){ echo "Graded";}?></td>
                <td><?php  echo $row['dateGraded'];?></td>
                <?php
                    if($row['isGraded'] == 0){
                ?>
                <td><a onclick="return confirm('Are you sure you want to delete?')" href="deleteAssignmentSubmitted.php?delid=<?php echo $row['assignmentSubmittedId'];?>" title="Delete Assignment"><i class="fa fa-trash fa-1x"></i></a></td>
                <?php
                }else{
                ?>
                <td></td>
                 <?php
                    }
                ?>
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
