<?php
if(isset($_GET['id']))
    $id = $_GET['id'];
$title = "Edit Company";
$setCompanyActive = "active";
$success = NULL;
$error = NULL;
require_once 'php/DBConnect.php';
$db = new DBConnect();
if(isset($id))
    $company = $db->selectCompanyById($id);

if (isset($_POST['submitBtn'])) {
    $id = $_POST['id'];
    $cname = $_POST['cname'];
    $caddress = $_POST['caddress'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $fax = $_POST['fax'];
    $ceo = $_POST['ceo'];

    $flag = $db->updateCompany($cname, $caddress, $email, $mobile, $fax, $ceo, $id);

    if ($flag) {
        $success = "Comapany details has been added to the database successfully!";
        $company = $db->selectCompanyById($id);
    } else {
        $error = "There was some error inserting the details in the database!";
    }
}

include 'layout/_header.php';

include 'layout/_top_nav.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <?php if (isset($success)): ?>
                    <div class="alert-success"><?= $success; ?></div>
                <?php endif; ?>

                <?php if (isset($error)): ?>
                    <div class="alert-danger"><?= $error; ?></div>
                <?php endif; ?>
                <div class="panel-heading panel-head-text">
                    Add a Company
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="editCompany.php" >
                        <input type="hidden" value="<?= $company[0]['id']; ?>" name="id" />
                        <div class="form-group">
                            <label class="col-md-2">Company Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="<?= $company[0]['c_name']; ?>" name="cname" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">Company Address</label>
                            <div class="col-md-10">
                                <textarea rows="4" class="form-control" name="caddress" required="true"><?= $company[0]['c_address']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" value="<?= $company[0]['email']; ?>" name="email" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">Contact Number</label>
                            <div class="col-md-10">
                                <input type="number" min="5" max="10000000000" value="<?= $company[0]['mobile']; ?>" class="form-control" name="mobile" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">Fax</label>
                            <div class="col-md-10">
                                <input type="number" min="5" max="10000000000" value="<?= $company[0]['fax']; ?>" class="form-control" name="fax" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">CEO</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="ceo" value="<?= $company[0]['ceo']; ?>" placeholder="Name of The Chief Executing Officer" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2"></label>
                            <div class="col-md-10">
                                <button class="btn btn-success btn-lg" name="submitBtn" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/_footer.php'; ?>

