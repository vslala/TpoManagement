<?php
require 'php/DBConnect.php';
$db = new DBConnect();
$db->seedBranches();
$branches = $db->getBranchNames();

$message = null;
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
if (isset($_POST['acadSubmit'])) {
    $currentBackLogs = [];
    $totalBackLogs = [];
    $enrollment = $_POST['enrollment'];
    $tBackLogs = $_POST['tBackLogs'];
    $cBackLog = $_POST['cBackLog'];
    $cgpa = $_POST['cgpa'];
    require_once 'php/DBConnect.php';
    $db = new DBConnect();
    $flag = $db->insertAcademicInfo($enrollment, $tBackLogs, $cBackLog, $cgpa);
    if ($flag) {
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
                <li class="active"><a href="#basic_info" id="basicBtn">Basic Info</a></li>
                <li class=""><a href="#personal_info" id="personalBtn">Personal Info</a></li>
                <li class=""><a href="#academic_info" id="academicBtn">Academic Info</a></li>
            </ul>
            <div class="" id="basic_info">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="contact-form">
                            <form class="form-horizontal" method="post" id="basic_info_form">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="firstName" id="first_name" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="lastName" id="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="roll_no" class="col-sm-2 control-label">Enrollment Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="enrollment" placeholder="xxxxbranchxxxx##" class="form-control" />
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
                                        <button type="submit" class="btn btn-default" name="basicSubmit">Send</button>
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
                                        <input type="text" class="form-control" name="firstName" id="first_name" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="lastName" id="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fname" class="col-sm-2 control-label">Father's Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="fname" id="email" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="roll_no" class="col-sm-2 control-label">D.O.B</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="dob" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="enrollment" class="col-sm-2 control-label">Enrollment Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="enrollment" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="branch" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" />
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
                                        <input type="number" name="mobile" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" rows="6"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default" name="personalSubmit">Send</button>
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
                                        <input type="text" class="form-control" name="enrollment" id="enrollment" placeholder="####xx######">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="fname" class="col-sm-2 control-label">Total Back logs</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tBackLogs" id="total_backs" placeholder="Number of Back Logs so far">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10" id="total_backs_div"></div>
                                </div>
                                <div class="form-group">
                                    <label for="roll_no" class="col-sm-2 control-label">Current Back log</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cBackLog" class="form-control" id="current_back" placeholder="Total Current Back Logs"/>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10" id="current_backs_div"></div>
                                </div>
                                <div class="form-group">
                                    <label for="cgpa" class="col-sm-2 control-label">CGPA </label>
                                    <div class="col-sm-10">
                                        <input type="decimal" name="cgpa" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default" name="acadSubmit">Send</button>
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