<?php
$message = null;
if(isset($_POST['sendBtn'])){
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $email = $_POST['email'];
    
    require_once 'php/DBConnect.php';
    $db = new DBConnect();
    $flag = $db->insertStudentQuery($name,$email, $subject, $message);
    if($flag){
        $message = "Thanks For Contacting. We will get back to u shortly.";
    }else{
        $message = "There was some problem submitting the query.";
    }
}
$title = "Contact";
$setContactActive = "active";
include 'layout/_header.php';
?>

<?php include 'layout/_top_nav.php'; ?>

<div class="container">
    <div class="row">
        <div class="page-header" id="page_header">
            Contact Form
        </div>
        <div class="col-md-6">
            <?php if(isset($message)): ?>           
            <div class="alert-info" id="message">
                <?= $message; ?>
            </div>           
            <?php endif; ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="contact-form">
                        <form class="form-horizontal" method="post" action="contact.php">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject" class="col-sm-2 control-label">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Cause for Contact">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message" class="col-sm-2 control-label">Message</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="8" name="message" placeholder="Reason For Contact"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default" name="sendBtn">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <section class="pull-right jumbotron">
                <p>If you have any queries regarding anything related to the placement and company just feel free to contact here.
            </section>
        </div>
    </div>
</div>

<?php include 'layout/_footer.php'; ?>

