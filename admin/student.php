<?php
require 'php/DBConnect.php';
$db = new DBConnect();
$branches = $db->getBranchNames();

$students = NULL;
if (isset($_POST['selectSubmitBtn'])) {
    $branch = $_POST['branch'];
    $lowerCGPA = $_POST['lowerLimit'];
    $upperCGPA = $_POST['upperLimit'];
    $students = $db->selectStudents($branch, $lowerCGPA, $upperCGPA);
}

$title = "Student";
$setStudentActive = "active";
include 'layout/_header.php';
?>

<?php include 'layout/_top_nav.php'; ?>

<div class="container">
    <div class="row">
        <div class="page-header" id="page_header">
            Select Students as per the criteria
        </div>
        <div class="col-md-12">
            <form class="form-inline" method="post" action="student.php">
                <ul class="nav">
                    <li class="col-sm-2">
                        Students: 
                        <select name="selector" class="form-control">
                            <option value="*">All</option>
                        </select>
                    </li>
                    <li class="col-sm-3">
                        From:
                        <select name="branch" class="form-control">
                            <?php if (isset($branches)): ?>
                                <?php foreach ($branches as $b): ?>
                                    <option value="<?= $b['id']; ?>" ><?= $b['name']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </li>
                    <li class="col-md-5">
                        CGPA 
                        Between: <input type="number" step="0.01" min="0" max="100.00" name="lowerLimit" class="form-control" size="3" placeholder="lower limit"/>
                        AND: <input type="number" step="0.01" min="0" max="100.00" name="upperLimit" class="form-control" size="3" placeholder="upper limit"/>
                    </li>
                    <li class="col-md-2">
                        <button class="btn btn-success" type="submit" name="selectSubmitBtn">Select</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>

    <?php if (isset($students)): ?>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Students Basic Info</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <th>Enrollment</th>
                            <th>Branch</th>
                            <th>Semester</th>
                            <th>CGPA</th>
                        </tr>

                        <?php foreach ($students as $s): ?>
                        <tr>
                            <td><a href="profile.php?enrollment=<?= $s['enrollment']; ?>"><?= $s['first_name']; ?> <?= $s['last_name']; ?></a></td>
                            <td><?= $s['enrollment']; ?></td>
                            <td><?= $s['branch']; ?></td>
                            <td><?= $s['semester']; ?></td>
                            <td><?= $s['cgpa']; ?></td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    
        
    <?php endif; ?>
    <?php include 'layout/_footer.php'; ?>

