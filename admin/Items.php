<?php

	/*
	================================================
	== Items Page
	================================================
	*/

	session_start();
	$pageTitle = 'Items';
	if (isset($_SESSION['Username'])) {
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		if ($do == 'Manage') {

            echo 'Welcome to Items page';

		} elseif ($do == 'Add') { ?>

            <h2 class="text-center">Add New Item</h2>
            <div class="container">
                <form action="?do=Insert" method="POST">
                    <!-- start Name field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="name" class="form-control" autocomplete="off" required  placeholder="Name of Item">
                        </div>
                    </div>
                    <!-- End Name field -->
                    <!-- start Description field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Description</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="description" class="form-control" autocomplete="off" required  placeholder="Describe the Item">
                        </div>
                    </div>
                    <!-- End Description field -->
                    <!-- start price field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Price</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="price" class="form-control" autocomplete="off" required  placeholder="Price the Item">
                        </div>
                    </div>
                    <!-- End price field -->
                    <!-- start country field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Country</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="country" class="form-control" autocomplete="off" required  placeholder="Country of Made">
                        </div>
                    </div>
                    <!-- End country field -->
                    <!-- start status field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Status</label>
                        <div class="col-sm-10 col-md-6">
                            <select class="form-control" name="status">
                                <option value="0">...</option>
                                <option value="1">New</option>
                                <option value="2">Like New</option>
                                <option value="3">Used</option>
                                <option value="4">Very Old</option>
                            </select>
                        </div>
                    </div>
                    <!-- End status field -->
                    <!-- start submit -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <input type="submit" value="Add Item" class="btn btn-primary btn-sm">
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


		} elseif ($do == 'Approve') {


		}

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}


?>