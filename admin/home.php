<?php
require_once 'php/DBConnect.php';
$db = new DBConnect();
$queries = $db->getStudentQueries();

$title = "Home";
$setHomeActive = "active";
include 'layout/_header.php';
?>

<?php include 'layout/_top_nav.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="page_header">
                        News Update
                    </div>
                    <div class="panel-body">
                        <div class="news-form">
                            <form method="post" class="form-vertical" action="home.php">
                                <div class="form-group">
                                    <input type="text" name="heading" class="form-control" placeholder="News Heading" />
                                </div>
                                <div class="form-group">
                                    <textarea rows="6" name="content" class="form-control" placeholder="Your News" ></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary" name="newsSubmitBtn">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="page_header">
                        Student's Queries
                    </div>
                    <div class="panel-body">
                        <div class="queries">
                            <ul class="nav nav-stacked">

                                <?php if (isset($queries)): ?>
                                    <?php foreach ($queries as $q): ?>
                                        <li id="query">
                                            <ul class="nav nav-stacked">
                                                <li><span class="glyphicon glyphicon-time time"><?= $q['created_at']; ?></span></li>
                                                <li><span class="glyphicon glyphicon-user subject"><?= $q['subject']; ?> </span> </li>
                                                <li>
                                                    <div class="pull-left content"><?= $q['message']; ?></div>
                                                    <div class="form-group-sm pull-right">
                                                        <a href="mailto:<?= $q['email']; ?>?subject=In Response to the query: <?= $q['subject']; ?>" class="btn btn-success btn-sm">Reply</a>
                                                        <a href="php/ignore.php?id=<?= $q['id']; ?>" class="btn btn-danger btn-sm">Ignore</a>
                                                    </div>
                                                </li>
                                            </ul>



                                        </li>  
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- reply modal -->
    <div class="modal fade" id="reply_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reply</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<?php include 'layout/_footer.php'; ?>

