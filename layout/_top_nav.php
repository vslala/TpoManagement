
<nav class="nav navbar-default navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="logo-left-15 pull-left">
                    <div class="h4" id="logo"><a href="index.php">Tpo Management</a></div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-4">
                <div class="pull-right">
                    <ul class="nav nav-pills">
                        <li class="<?php
                        if (isset($setHomeActive)) {
                            echo $setHomeActive;
                        } else {
                            echo '';
                        }
                        ?>"><a href="index.php">Home</a></li>
                        <li class="<?php
                        if (isset($setAboutActive)) {
                            echo $setAboutActive;
                        } else {
                            echo '';
                        }
                        ?>"><a href="about.php">About</a></li>
                        <li class="<?php
                        if (isset($setRegisterActive)) {
                            echo $setRegisterActive;
                        } else {
                            echo '';
                        }
                        ?>"><a href="register.php">Register</a></li>
                        <li class="<?php
                            if (isset($setContactActive)) {
                                echo $setContactActive;
                            } else {
                                echo '';
                            }
                        ?>"><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</nav>
        

