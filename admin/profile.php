<?php
$enrollment = $_GET['enrollment'];

require_once 'php/DBConnect.php';
$db = new DBConnect();
$studentPersonalInfo = $db->selectStudentPersonalInfoViaEnrollment($enrollment);
$studentBasicInfo = $db->selectStudentBasicInfoViaEnrollment($enrollment);
$studentAcadInfo = $db->selectStudentAcadInfoViaEnrollment($enrollment);

$title="Student Profile";
include 'layout/_header.php';
?>

<?php include 'layout/_top_nav.php'; ?>

<div class="container">
    <div class="row">
        <div class="page-header" id="page_header">
            Student's Complete Profile
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>Student's Basic Info</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                            <?php foreach($studentBasicInfo as $s): ?>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td><?= $s['first_name']; ?> <?= $s['last_name']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td><a href="mailto:<?= $s['email']; ?>"><?= $s['email'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Enrollment</strong></td>
                                <td><?= $s['enrollment']; ?> </td>
                            </tr>
                            <tr>
                                <td><strong>Branch</strong></td>
                                <td><?= $s['stream']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Semester</strong></td>
                                <td><?= $s['semester']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3>Student's Personal Info</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                            <?php foreach($studentPersonalInfo as $s): ?>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td><?= $s['first_name']; ?> <?= $s['last_name']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Father's Name</strong></td>
                                <td><?= $s['father_name']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>D.O.B</strong></td>
                                <td><?= $s['dob']; ?> </td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td><a href="mailto:<?= $s['email']; ?>"><?= $s['email'] ?></a></td>
                            </tr>
                            <tr>
                                <td><strong>Gender</strong></td>
                                <td><?= $s['gender']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Mobile</strong></td>
                                <td><?= $s['mobile']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td><?= $s['address']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3>Student's Academic Info</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                            <?php foreach($studentAcadInfo as $s): ?>
                            <tr>
                                <td><strong>Enrollment</strong></td>
                                <td><?= $s['enrollment']; ?> </td>
                            </tr>
                            <tr>
                                <td><strong>Total Back Logs</strong></td>
                                <td><?= $s['t_back_logs']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Current Back Log</strong></td>
                                <td><?= $s['c_back_log']; ?> </td>
                            </tr>
                            <tr>
                                <td><strong>CGPA</strong></td>
                                <td><?= $s['cgpa']; ?></td>
                            </tr>
                            
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/_footer.php'; ?>
