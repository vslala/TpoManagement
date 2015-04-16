
<nav class="nav navbar-default navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="logo-left-15 pull-left">
                    <div class="h4" id="logo"><a href="home.php">Tpo Management</a></div>
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
                        ?>"><a href="home.php">Home</a></li>
                        
                        <li class="<?php
                        if (isset($setCompanyActive)) {
                            echo $setCompanyActive;
                        } else {
                            echo '';
                        }
                        ?>"><a href="company.php">Companies</a></li>
                        
                        <li class="<?php
                        if (isset($setStudentActive)) {
                            echo $setStudentActive;
                        } else {
                            echo '';
                        }
                        ?>"><a href="student.php">Students</a></li>
                        
                        <li class="<?php
                            if (isset($setContactActive)) {
                                echo $setContactActive;
                            } else {
                                echo '';
                            }
                        ?>"><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</nav>
        

