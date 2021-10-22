
<?php

include('../includes/dbconnection.php');
include('../includes/session.php');
error_reporting(0);

if(isset($_POST['submit'])){

 $alertStyle ="";
  $statusMsg="";

$title=$_POST['title'];
$description=$_POST['description'];
$scoreObtainable=$_POST['scoreObtainable'];
$passMark=$_POST['passMark'];
$deadLineDate=$_POST['deadLineDate'];
$levelId=$_POST['levelId'];
$courseId=$_POST['courseId'];
$dateCreated = date("Y-m-d");

//file uplaod
$assignmentTmpPath = $_FILES['assignmentFile']['tmp_name'];
$assignmentfileName = $_FILES['assignmentFile']['name'];
$assignmentfileSize = $_FILES['assignmentFile']['size'];
$assignmentfileType = $_FILES['assignmentFile']['type'];
$assignmentfileNameCmps = explode(".", $assignmentfileName);
$assignmentfileExtension = strtolower(end($assignmentfileNameCmps));

//gives the fileupoladed a unique Identifier
$assignmentnewFileName = md5(time().$assignmentfileName).'.'.$assignmentfileExtension;


$query=mysqli_query($con,"select * from tblassignments where title ='$title'and levelId = '$levelId' and courseId ='$courseId'");
$ret=mysqli_fetch_array($query);
if($ret > 0){

  $alertStyle ="alert alert-danger";
  $statusMsg="This Assignment with title ".$title." Already exists!";

}
else{

    $allowedfileExtensions = array('jpg','png','jpeg');
    if (in_array($assignmentfileExtension, $allowedfileExtensions)) {

        $alertStyle ="alert alert-danger";
        $statusMsg="The File Type is not allowed!";
    }
    else{

        //move to the folder
        $uploadFileDir = 'assignments/';
        $dest_path = $uploadFileDir.$assignmentnewFileName;
        move_uploaded_file($assignmentTmpPath, $dest_path);

        $query=mysqli_query($con,"insert into tblassignments(staffId,title,description,scoreObtainable,passMark,deadLineDate,assignment,levelId,courseId,dateCreated) 
        value('$staffId','$title','$description','$scoreObtainable','$passMark','$deadLineDate','$assignmentnewFileName','$levelId','$courseId','$dateCreated')");

        if ($query) {

            $alertStyle ="alert alert-success";
            $statusMsg="Assignment Scheduled Successfully!";
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

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
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
                                <li><a href="#">Assignments</a></li>
                                <li class="active">Schedule Assignments</li>
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
                            <strong class="card-title"><h2 align="center">Schedule/Give Assignments</h2></strong>
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
                                                    <input id="" name="title" type="text" class="form-control cc-exp" value="" Required data-val="true" placeholder="Title">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="x_card_code" class="control-label mb-1">Description</label>
                                                    <input id="" name="description" type="text" class="form-control cc-cvc" value="" Required  placeholder="Description">
                                                    </div>
                                                </div>
                                                <div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Score Obtainable</label>
                                                    <input id="" name="scoreObtainable" type="text" class="form-control cc-exp" onkeypress="return isNumber(event)" value="" Required placeholder="Score Obtainable">
                                                </div>
                                            </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Pass Mark</label>
                                                    <input id="" name="passMark" type="text" class="form-control cc-exp" onkeypress="return isNumber(event)" value="" Required placeholder="Pass Mark">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Deadline Date</label>
                                                    <input id="" name="deadLineDate" type="date" class="form-control" value="" Required placeholder="Score Obtainable">
                                                </div>
                                            </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Assignment</label>
                                                    <input name="assignmentFile" type="file" class="form-control" value="" Required placeholder="Pass Mark">
                                                </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                <label for="x_card_code" class="control-label mb-1">Level</label>
                                                <?php 
                                                $query=mysqli_query($con,"select * from tbllevel ORDER BY levelName ASC");                        
                                                $count = mysqli_num_rows($query);
                                                if($count > 0){                       
                                                    echo ' <select required name="levelId" onchange="showCourses(this.value)" class="custom-select form-control">';
                                                    echo'<option value="">--Select Level--</option>';
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    echo'<option value="'.$row['Id'].'" >'.$row['levelName'].'</option>';
                                                        }
                                                            echo '</select>';
                                                        }
                                                ?>                                                                 
                                                 </div>
                                            </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                                <?php
                                                    echo"<div id='txtHint'></div>";
                                                  ?>                                                      
                                             </div>
                                        </div>
                                    </div>
                                    
                                            <button type="submit" name="submit" class="btn btn-primary">Save and Schedule</button>
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
                            <strong class="card-title"><h2 align="center">All Scheduled/Given Assignments</h2></strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>StaffId</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Score Obtainable</th>
                                        <th>Pass Mark</th>
                                        <th>Deadline Date</th>
                                        <th>Level</th>
                                        <th>Course Code </th>
                                        <th>Course Title</th>                                        
                                        <th>Assignment</th>
                                        <th>Date Created</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                        <?php
                $ret=mysqli_query($con,"SELECT tblassignments.staffId,tblassignments.Id, tblassignments.title,tblassignments.description,tblassignments.scoreObtainable,
                tblassignments.passMark,tblassignments.deadLineDate,tblassignments.assignment,tblassignments.dateCreated,
                tbllevel.levelName,tblcourse.courseTitle,tblcourse.courseCode
                from tblassignments
                INNER JOIN tbllevel ON tbllevel.Id = tblassignments.levelId
                INNER JOIN tblcourse ON tblcourse.Id = tblassignments.courseId");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {
                                    ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['staffId'];?></td>
                <td><?php  echo $row['title'];?></td>
                <td><?php  echo $row['description'];?></td>
                <td><?php  echo $row['scoreObtainable'];?></td>
                <td><?php  echo $row['passMark'];?></td>
                <td><?php  echo $row['deadLineDate'];?></td>
                <td><?php  echo $row['levelName'];?></td>
                <td><?php  echo $row['courseCode'];?></td>
                <td><?php  echo $row['courseTitle'];?></td>                
                <td><a href='download.php?file=<?php echo urlencode($row['assignment']);?>' title="Download File"><i class="fa fa-download fa-1x">&nbsp;&nbsp;&nbsp;Download</i></a></td>
                <td><?php  echo $row['dateCreated'];?></td>
                <td><a href="editScheduledAssignment.php?editId=<?php echo $row['Id'];?>" title="Edit Assignment"><i class="fa fa-edit fa-1x"></i></a></td>
                <td><a onclick="return confirm('Are you sure you want to delete?')" href="deleteScheduledAssignment.php?delid=<?php echo $row['Id'];?>" title="Delete Assignment"><i class="fa fa-trash fa-1x"></i></a></td>
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
