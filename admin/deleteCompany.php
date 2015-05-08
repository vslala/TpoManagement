<?php
$title = "Edit Company";
$setCompanyActive = "active";
$success = NULL;
$error = NULL;

require_once 'php/DBConnect.php';
$db = new DBConnect();
if (isset($_POST['yesBtn'])) {
    $id = $_POST['id'];
    if ($db->deleteCompany($id)) {
        header("Location: http://localhost/tpomanagement/admin/company.php");
        die();
    } else {
        $error = "There was some error in deleting the company from the database!!!";
    }
}
if (isset($_POST['noBtn'])) {
    header("Location: http://localhost/tpomanagement/admin/company.php");
    die();
}

if (isset($_GET['id']))
    $id = $_GET['id'];




include 'layout/_header.php';

include 'layout/_top_nav.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Are you sure you want to delete this company?
                </div>
                <div class="panel-body">
                    <form class="form-inline" method="post" action="deleteCompany.php">
                        <input type="hidden" value="<?= $id; ?>" name="id" />
                        <button class="btn btn-danger btn-lg" type="submit" name="yesBtn">
                            YES
                        </button>
                        <button type="submit" name="noBtn" class="btn btn-danger btn-lg">
                            NO
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'layout/_footer.php'; ?>
