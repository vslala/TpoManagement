<?php 
require_once 'php/DBConnect.php';
$db = new DBConnect();
$news = $db->fetchTopFiveNews(); //Fetched top 5 news from the database

$title="Home";$setHomeActive="active";
include 'layout/_header.php'; 

$companiesLogo = ["cognizant-logo.jpg", "mahindra-logo.jpg", "unisys-logo.png", "prism-logo.gif", "infosys-logo.png"];
?>

<?php include 'layout/_top_nav.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-head-text">
                        News Updates
                    </div>
                </div>
                <div class="panel-body">
                    <?php if(isset($news)): ?>
                    <ul class="nav nav-stacked">
                        <?php foreach ($news as $n): ?>
                        <li class="news-heading">
                            <span class="help-block pull-right"><?= $n['created_at']; ?></span>
                            <?= $n['heading']; ?>
                        </li>
                        <li class="news-content"><?= $n['content']; ?></li>
                        <li class="nav-divider"></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <marquee>
                    <?php for($i=0;$i<count($companiesLogo); $i++): ?>
                    <a href="#"><img style="height: 100px;" class="img img-responsive img-thumbnail" id="company-logo" src="assets/<?= $companiesLogo[$i]; ?>" ></a>
                    <?php endfor; ?>
                </marquee>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/_footer.php'; ?>

