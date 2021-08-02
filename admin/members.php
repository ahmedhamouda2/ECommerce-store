<?php

/*
	================================================
	== Manage Members Page
	== You Can Add | Edit | Delete Members From Here
	================================================
	*/

session_start();
$pageTitle = 'Members';
if (isset($_SESSION['Username'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    // start manage page
    if ($do == 'Manage') {
        // manage page
    } elseif ($do == 'Edit') {  // Edit page 
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']): 0;
        echo $userid;
?>

        <h2 class="text-center">Edit Member</h2>
        <div class="container">
                <form>
                    <!-- start username field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Username</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="username" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <!-- End username field -->
                    <!-- start password field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Password</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="password" name="password" class="form-control" autocomplete="new-password">
                        </div>
                    </div>
                    <!-- end password field -->
                    <!-- start Email field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Email</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                    <!-- end Email field -->
                    <!-- start fullname field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Full Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="fullname" class="form-control">
                        </div>
                    </div>
                    <!-- end fullname field -->
                    <!-- start submit -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <input type="submit" value="save" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                    <!-- end submit -->
                </form>
            </form>
        </div>

<?php  } elseif ($do == 'Insert') {
        // Insert page
    } else {
    }

    include $tpl . 'footer.php';
} else {
    header('location:index.php');
    exit();
}
