<?php
require 'php/DBConnect.php';
$db = new DBConnect();
$db->seedBranches();
$branches = $db->getBranchNames();

$message = null;
/*
 * This is when student submits basic information
 */
if (isset($_POST['basicSubmit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $enrollment = $_POST['enrollment'];
    $branch = $_POST['branch'];
    $semester = $_POST['semester'];


    $flag = $db->insertBasicInfo($firstName, $lastName, $email, $enrollment, $branch, $semester);
    if ($flag) {
        $message = "Information has been saved successfully! Please fill your personal info form.";
    } else {
        $message = "There was some error saving your details.";
    }
}
/*
 * This is when student sumits personal information
 */
if (isset($_POST['personalSubmit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $fname = $_POST['fname'];
    $dob = $_POST['dob'];
    $enrollment = $_POST['enrollment'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    require_once 'php/DBConnect.php';
    $db = new DBConnect();
    $flag = $db->insertPersonalInfo($firstName, $lastName, $fname, $dob, $enrollment, $email, $gender, $mobile, $address);
    if ($flag) {
        $message = "Information has been saved successfully! Please fill your academic info form.";
    } else {
        $message = "There was some error saving your details.";
    }
}
/*
 * This is when student submit Academic Information
 */
if (isset($_POST['acadSubmit'])) {
    $currentBackLogs = [];
    $totalBackLogs = [];
    $enrollment = $_POST['enrollment'];
    $tBackLogs = $_POST['tBackLogs'];
    $cBackLog = $_POST['cBackLog'];
    $cgpa = $_POST['cgpa'];

    /*
     * if Student doesn't enter anything or doesn't have any back
     */
    if($cBackLog == '0' || $cBackLog == null || $cBackLog == ""){
        $cBackLog = "none";
    }
    if($tBackLogs == '0' || $tBackLogs == null || $tBackLogs == ""){
        $tBackLogs = "none";
    }
    /*
     * If student has any back then these are the name of the papers.
     */
    if(isset($_POST['currentbacklogs'])){ $currentBackLogs = $_POST['currentbacklogs'];}
    if(isset($_POST['totalbacklogs'])){ $totalBackLogs = $_POST['totalbacklogs'];}
    
    // Calling the database class
    require_once 'php/DBConnect.php';
    $db = new DBConnect();
    $sId = $db->insertAcademicInfo($enrollment, $tBackLogs, $cBackLog, $cgpa);
    
    if(isset($currentBackLogs)){
        foreach($currentBackLogs as $c){
//            var_dump($c);
//            die();
            $db->insertCurrentBackNames($sId, $c);
        }
    }
    if(isset($totalBackLogs)){
        foreach($totalBackLogs as $t){
            $db->insertTotalBackNames($sId, $t);
        }
    }
    
    if ($sId) {
        $message = "Information has been saved successfully! You can now go home";
    } else {
        $message = "There was some error saving your details.";
    }
}
$title = "Register";
$setRegisterActive = "active";
include 'layout/_header.php';
?>

<?php include 'layout/_top_nav.php'; ?>

<div class="container">
    <div class="row">
        <div class="page-header" id="page_header">
            Student's Registration Form
        </div>
        <div class="col-md-6">
            <?php if (isset($message)): ?>           
                <div class="alert-info" id="message">
                    <?= $message; ?>
                </div>           
            <?php endif; ?>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#basic_info" id="basicBtn" class="tabs">Basic Info</a></li>
                <li class=""><a href="#personal_info" id="personalBtn" class="tabs">Personal Info</a></li>
                <li class=""><a href="#academic_info" id="academicBtn" class="tabs">Academic Info</a></li>
            </ul>
            <div class="" id="basic_info">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="contact-form">
                            <form class="form-horizontal" method="post" id="basic_info_form">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="firstName" id="first_name" placeholder="First Name" required="true">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="lastName" id="last_name" placeholder="Last Name" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="roll_no" class="col-sm-2 control-label">Enrollment Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="enrollment" placeholder="xxxxbranchxxxx##" class="form-control" required="true"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="branch" class="col-sm-2 control-label">Branch</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="branch">
                                            <?php if (isset($branches)): ?>
                                                <?php foreach ($branches as $b): ?>
                                                    <option value="<?= $b['id']; ?>" ><?= $b['name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="semester" class="col-sm-2 control-label">Semester</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="semester">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success" name="basicSubmit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Info Form Ends here -->

            <!-- Personal Info Form -->
            <div class="hide-toggle" id="personal_info">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="contact-form">
                            <form class="form-horizontal" method="post" id="personal_info_form">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="firstName" id="first_name" placeholder="First Name" required="true">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="lastName" id="last_name" placeholder="Last Name" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fname" class="col-sm-2 control-label">Father's Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="fname" id="email" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="roll_no" class="col-sm-2 control-label">D.O.B</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="dob" class="form-control" required="true"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="enrollment" class="col-sm-2 control-label">Enrollment Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="enrollment" class="form-control" required="true"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="branch" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" required="true"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="branch" class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline"><input type="radio" name="gender" value="male" checked="checked" />Male</label>
                                        <label class="radio-inline"><input type="radio" name="gender" value="female" />Female </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="mobile" max="10000000000" class="form-control" required="true"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" rows="6" required="true"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success" name="personalSubmit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Personal info form ends here -->

            <!-- Academic Info Form Starts here -->
            <div class="hide-toggle" id="academic_info">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="contact-form">
                            <form class="form-horizontal" method="post" id="personal_info_form">
                                <div class="form-group">
                                    <label for="enrollment" class="col-sm-2 control-label">Enrollment Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="enrollment" id="enrollment" placeholder="####xx######" required="true">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="fname" class="col-sm-2 control-label">Total Back logs (numeric)</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" min="0" name="tBackLogs" id="total_backs" placeholder="Number of Back Logs so far" required="true">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10" id="total_backs_div"></div>
                                </div>
                                <div class="form-group">
                                    <label for="roll_no" class="col-sm-2 control-label">Current Back log (numberic)</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="cBackLog" min="0" class="form-control" id="current_back" placeholder="Total Current Back Logs" required="true"/>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10" id="current_backs_div"></div>
                                </div>
                                <div class="form-group">
                                    <label for="cgpa" class="col-sm-2 control-label">CGPA </label>
                                    <div class="col-sm-10">
                                        <input type="decimal" name="cgpa" class="form-control" required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success" name="acadSubmit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Academic Info ends here -->
        </div>

        <div class="col-md-6">
            <section class="pull-right jumbotron">
                <p>All the students must register here with there correct credentials. As these will be used to select the 
                    qualified students according to the company's criteria.
            </section>
        </div>
    </div>
</div>

<?php include 'layout/_footer.php'; ?>