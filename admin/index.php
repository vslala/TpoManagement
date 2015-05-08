<?php
session_start();
//if (isset($_SESSION['username'])) {
//    header("Location: http://localhost/tpomanagement/admin/home.php");
//}
$message = NULL;
if (isset($_POST['loginBtn'])) {
    $admin = $_POST['admin'];
    $password = $_POST['password'];

    if ($admin == "Admin") {
        if ($password == "Password") {
            $_SESSION['admin'] = $admin;
            header("Location: http://localhost/tpomanagement/admin/home.php");
        } else {
            $message = "Password is incorrect!";
        }
    } else {
        $message = "Admin name is incorrect!";
    }
}
$title="Admin Login";
include 'layout/_header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?php if(isset($message)): ?>
            <span class="alert-danger"><?= $message; ?></span>
            <?php endif; ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="h2">Admin Login</div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="index.php">
                        <div class="form-group">
                            <label class="form-label col-md-4">Admin:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="admin" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label col-md-4">Password:</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label col-md-4"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary" type="submit" name="loginBtn">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<?php include 'layout/_footer.php'; ?>