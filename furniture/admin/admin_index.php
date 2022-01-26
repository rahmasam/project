<?php
//session_start();
    include "check_login.php";
    include "admin_header.php";
    include "admin_navbar.php";
    include "admin_partial.php";
    include "admin_sidebar.php"
?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row grid-margin">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h1 style="text-align: center">Welcome to the Admin homepage</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
<?php include "admin_end.php" ?>;
