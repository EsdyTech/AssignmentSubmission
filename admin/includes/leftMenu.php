
<?php
$staffId = $_SESSION['staffId'];
$query = mysqli_query($con,"select * from tbladmin where staffId='$staffId'");
$row = mysqli_fetch_array($query);
$staffFullName = $row['firstName'].' '.$row['lastName'];
?>
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">ADMIN &nbsp;&nbsp;&nbsp;<?php echo $staffFullName;?></li>
                      <!-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-group"></i>Lecturer</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="createStaff.php">Add New Lecturer</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewStaff.php">View Lecturer</a></li>
                        </ul>
                    </li> -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-group"></i>Student</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="createStudent.php">Add New Student</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewStudent.php">View Student</a></li>
                        </ul>
                    </li>
                     <!-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Assign Department</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="assignAdmin.php">Assign Admin</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewAssignedAdmin.php">Assigned Admin</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewUnAssignedAdmin.php">Unassigned Admin</a></li>
                            <li><i class="fa fa-plus"></i><a href="assignStaff.php">Assign Lecturer</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewAssignedStaff.php">Assigned Lecturer</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewUnAssignedStaff.php">Unassigned Lecturer</a></li>
                        </ul>
                    </li>                  -->
                    <!-- <li class="menu-title">Department</li>/.menu-title -->
                    <!-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-home"></i>Departments</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="createDepartment.php">Add New Department</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewDepartment.php">View Department</a></li>
                        </ul>
                    </li> -->

                     <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Courses</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="createCourses.php">Add New Course</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewCourses.php">View Courses</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-group"></i>Lecturer</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="createStaff.php">Add New Lecturer</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewStaff.php">View Lecturer</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-home"></i>Faculty</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="createFaculty.php">Add New Faculty</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewFaculty.php">View Faculty</a></li>
                        </ul>
                    </li>
                    <!-- <li class="menu-title">Department</li>/.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-home"></i>Departments</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="createDepartment.php">Add New Department</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewDepartment.php">View Department</a></li>
                        </ul>
                    </li>

                    <!-- <li class="menu-title">Attendance</li>/.menu-title -->
                    <!-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-calendar"></i>Attendance</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-calendar"></i><a href="todayCourseAttendanceRecord.php">Today Attendance</a></li> -->
                            <!-- <li><i class="fa fa-calendar"></i><a href="todaysAttendanceRecord.php">Today's Attendance</a></li> -->
                            <!-- <li><i class="fa fa-calendar"></i><a href="courseAttendanceRecord.php">Course Attendance</a></li>
                            <li><i class="fa fa-calendar"></i><a href="studentAttendanceRecord.php">Student Attendance</a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="menu-title">Profile</li>/.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Profile</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="changePassword.php">Change Password</a></li>
                            <li><i class="menu-icon fa fa-user"></i><a href="updateProfile.php">Update Profile</a></li>
                            </li>
                        </ul>
                         <li>
                        <a href="logout.php"> <i class="menu-icon fa fa-close"></i>Logout </a>
                    </li>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>