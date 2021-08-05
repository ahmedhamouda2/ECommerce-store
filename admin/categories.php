<?php

	/*
	================================================
	== categories Page
	================================================
	*/

	session_start();
	$pageTitle = 'categories';
	if (isset($_SESSION['Username'])) {
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		if ($do == 'Manage') {


		} elseif ($do == 'Add') { ?>

            <h2 class="text-center">Add New Category</h2>
            <div class="container">
                <form action="?do=Insert" method="POST">
                    <!-- start Name field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="name" class="form-control" autocomplete="off" required  placeholder="Name of category">
                        </div>
                    </div>
                    <!-- End Name field -->
                    <!-- start Description field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Description</label>
                        <div class="col-sm-10 col-md-6">
                            <textarea name="description" class="form-control" placeholder="Describe the category"></textarea>
                        </div>
                    </div>
                    <!-- end Description field -->
                    <!-- start Ordering field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Ordering</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="ordering" class="form-control" placeholder="Number to Arrange the categories">
                        </div>
                    </div>
                    <!-- end Ordering field -->
                    <!-- start Visibility field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Visibility</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="vis-yes" type="radio" name="visibility" value="0" checked>
                                <label for="vis-yes">Yes</label>
                            </div>
                            <div>
                                <input id="vis-no" type="radio" name="visibility" value="1">
                                <label for="vis-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- end Visibility field -->
                    <!-- start commenting field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Allow Commenting</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="com-yes" type="radio" name="commenting" value="0" checked>
                                <label for="com-yes">Yes</label>
                            </div>
                            <div>
                                <input id="com-no" type="radio" name="commenting" value="1">
                                <label for="com-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- end commenting field -->
                    <!-- start Ads field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Allow Ads</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="ads-yes" type="radio" name="Ads" value="0" checked>
                                <label for="ads-yes">Yes</label>
                            </div>
                            <div>
                                <input id="ads-no" type="radio" name="Ads" value="1">
                                <label for="ads-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- end Ads field -->
                    <!-- start submit -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <input type="submit" value="Add Category" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                    <!-- end submit -->
                </form>
            </div>
            
            <?php 
		} elseif ($do == 'Insert') {


		} elseif ($do == 'Edit') {


		} elseif ($do == 'Update') {


		} elseif ($do == 'Delete') {


        }

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}


?>